<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Imports\RatesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\NotificationController;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Rate::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('pulau', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('provinsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('kota_kab', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('kelurahan_kecamatan', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Filter by pulau
        if ($request->has('pulau') && !empty($request->pulau)) {
            $query->where('pulau', $request->pulau);
        }
        
        // Get distinct pulau values for the filter dropdown
        $pulauList = Rate::select('pulau')->distinct()->pluck('pulau');
        
        // Pagination
        $perPage = $request->input('per_page', 10);
        $rates = $query->orderBy('pulau')->orderBy('provinsi')->orderBy('kota_kab')->paginate($perPage);
        
        return view('admin.rates', compact('rates', 'pulauList'));
    }

    public function create()
    {
        return view('admin.rates-create');
    }

    public function store(Request $request)
    {
        if ($request->has('rates')) {
            // Multi-record creation
            $createdCount = 0;
            
            foreach ($request->rates as $rateData) {
                $validator = Validator::make($rateData, [
                    'pulau' => 'required',
                    'provinsi' => 'required',
                    'kota_kab' => 'required',
                    'kelurahan_kecamatan' => 'required',
                    'harga_satuan' => 'required|numeric',
                    'minimal_kg' => 'required|numeric',
                    'estimasi' => 'required'
                ]);

                if (!$validator->fails()) {
                    Rate::create($rateData);
                    $createdCount++;
                }
            }
            
            // Buat notifikasi untuk multi-record
            if ($createdCount > 0) {
                NotificationController::addNotification(
                    Auth::id(),
                    'Tarif Baru Ditambahkan',
                    $createdCount . ' data tarif baru telah ditambahkan',
                    'fas fa-dollar-sign',
                    'bg-green-100',
                    'text-green-500',
                    route('admin.rates')
                );
            }
            
            return redirect()->route('admin.rates')->with('success', $createdCount . ' data tarif berhasil ditambahkan');
        } else {
            // Single record creation (for API)
            $validator = Validator::make($request->all(), [
                'pulau' => 'required',
                'provinsi' => 'required',
                'kota_kab' => 'required',
                'kelurahan_kecamatan' => 'required',
                'harga_satuan' => 'required|numeric',
                'minimal_kg' => 'required|numeric',
                'estimasi' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $rate = Rate::create($request->all());
            
            // Buat notifikasi untuk single record
            NotificationController::addNotification(
                Auth::id(),
                'Tarif Baru Ditambahkan',
                'Tarif baru untuk ' . $request->kota_kab . ', ' . $request->provinsi . ' telah ditambahkan',
                'fas fa-dollar-sign',
                'bg-green-100',
                'text-green-500',
                route('admin.rates')
            );
            
            if ($request->wantsJson()) {
                return response()->json(['success' => 'Data berhasil ditambahkan']);
            }
            
            return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        $rate = Rate::findOrFail($id);
        return view('admin.rates-edit', compact('rate'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pulau' => 'required',
            'provinsi' => 'required',
            'kota_kab' => 'required',
            'kelurahan_kecamatan' => 'required',
            'harga_satuan' => 'required|numeric',
            'minimal_kg' => 'required|numeric',
            'estimasi' => 'required'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rate = Rate::find($id);
        $oldPrice = $rate->harga_satuan;
        $rate->update($request->all());
        
        // Buat notifikasi untuk perubahan tarif
        $priceChange = '';
        if ($oldPrice != $request->harga_satuan) {
            $change = $request->harga_satuan - $oldPrice;
            $priceChange = $change > 0 ? ' (naik ' . number_format($change, 0, ',', '.') . ')' : ' (turun ' . number_format(abs($change), 0, ',', '.') . ')';
        }
        
        NotificationController::addNotification(
            Auth::id(),
            'Tarif Diperbarui',
            'Tarif untuk ' . $request->kota_kab . ', ' . $request->provinsi . ' telah diperbarui menjadi Rp ' . number_format($request->harga_satuan, 0, ',', '.') . $priceChange,
            'fas fa-edit',
            'bg-blue-100',
            'text-blue-500',
            route('admin.rates')
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Data berhasil diperbarui']);
        }
        
        return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rate = Rate::findOrFail($id);
        $locationInfo = $rate->kota_kab . ', ' . $rate->provinsi;
        $rate->delete();

        // Buat notifikasi untuk penghapusan tarif
        NotificationController::addNotification(
            Auth::id(),
            'Tarif Dihapus',
            'Tarif untuk ' . $locationInfo . ' telah dihapus',
            'fas fa-trash',
            'bg-red-100',
            'text-red-500',
            route('admin.rates')
        );

        if (request()->wantsJson()) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        }
        
        return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil dihapus');
    }

    /**
     * Bulk delete selected rates.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required'
        ]);

        try {
            // Decode JSON array dari string input
            $selectedIds = json_decode($request->selected_ids);
            
            if (!is_array($selectedIds) || count($selectedIds) === 0) {
                return redirect()->route('admin.rates')
                    ->with('error', 'Tidak ada data yang dipilih untuk dihapus');
            }
            
            // Dapatkan jumlah data yang akan dihapus untuk pesan
            $totalSelected = count($selectedIds);
            
            // Hapus semua data yang dipilih
            $deletedCount = 0;
            foreach ($selectedIds as $id) {
                $rate = Rate::find($id);
                if ($rate) {
                    $rate->delete();
                    $deletedCount++;
                }
            }
            
            // Buat notifikasi untuk penghapusan massal
            NotificationController::addNotification(
                Auth::id(),
                'Penghapusan Massal Tarif',
                "$deletedCount data tarif telah dihapus melalui penghapusan massal",
                'fas fa-trash-alt',
                'bg-red-100',
                'text-red-500',
                route('admin.rates')
            );
            
            return redirect()->route('admin.rates')
                ->with('success', "Berhasil menghapus $deletedCount data tarif");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.rates')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Mengatur header kolom
        $headers = ['pulau', 'provinsi', 'kota_kabupaten', 'kelurahan_kecamatan', 'harga_satuan', 'minimal_kg', 'estimasi'];
        $col = 1;
        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($col, 1, $header);
            $col++;
        }
        
        // Contoh data
        $exampleData = [
            ['Jawa', 'Jawa Barat', 'Bandung', 'Antapani', 15000, 1, '1-2 hari'],
            ['Jawa', 'Jawa Tengah', 'Semarang', 'Pedurungan', 16000, 1, '1-2 hari'],
            ['Sumatera', 'Sumatera Utara', 'Medan', 'Medan Baru', 25000, 1, '2-3 hari']
        ];
        
        $row = 2;
        foreach ($exampleData as $rowData) {
            $col = 1;
            foreach ($rowData as $cellData) {
                $sheet->setCellValueByColumnAndRow($col, $row, $cellData);
                $col++;
            }
            $row++;
        }
        
        // Format header sebagai bold
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        
        // Auto-size kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Set latar belakang header
        $sheet->getStyle('A1:G1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E9ECEF');
            
        // Tambahkan border pada tabel
        $styleBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        
        $sheet->getStyle('A1:G' . ($row - 1))->applyFromArray($styleBorder);
        
        // Mengatur format angka pada kolom harga dan berat
        $sheet->getStyle('E2:E' . ($row - 1))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            
        $sheet->getStyle('F2:F' . ($row - 1))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        // Membuat writer untuk Excel 2007+
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        // Simpan ke output
        $fileName = 'rates_import_template.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'excel_');
        $writer->save($tempFile);
        
        return response()->download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ])->deleteFileAfterSend(true);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // max 10MB
            'duplicate_handling' => 'required|in:update,skip,duplicate'
        ]);

        try {
            // Instansiasi importer dengan mode penanganan duplikat
            $import = new RatesImport($request->duplicate_handling);
            
            // Jalankan import
            Excel::import($import, $request->file('file'));
            
            // Ambil statistik dan buat pesan sukses
            $stats = $import->getStats();
            
            // Periksa apakah ada data yang diproses
            if ($stats['added'] == 0 && isset($stats['updated']) && $stats['updated'] == 0 && isset($stats['skipped']) && $stats['skipped'] == 0) {
                return redirect()->route('admin.rates')->with('warning', 'Tidak ada data yang diimport. Pastikan file berisi data yang valid.');
            }
            
            // Buat pesan sukses berdasarkan operasi yang dilakukan
            $message = "Import berhasil: {$stats['added']} data ditambahkan";
            
            if ($request->duplicate_handling === 'update' && isset($stats['updated']) && $stats['updated'] > 0) {
                $message .= ", {$stats['updated']} data diperbarui";
            }
            
            if ($request->duplicate_handling === 'skip' && isset($stats['skipped']) && $stats['skipped'] > 0) {
                $message .= ", {$stats['skipped']} data dilewati (duplikat)";
            }
            
            // Tambahkan notifikasi untuk hasil import
            $notifTitle = 'Import Tarif Berhasil';
            $notifIcon = 'fas fa-file-import';
            $notifBg = 'bg-green-100';
            $notifColor = 'text-green-500';
            
            NotificationController::addNotification(
                Auth::id(),
                $notifTitle,
                $message,
                $notifIcon,
                $notifBg,
                $notifColor,
                route('admin.rates')
            );
            
            return redirect()->route('admin.rates')->with('success', $message);
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            $errorMessage = 'Error pada import data: ';
            foreach ($failures as $failure) {
                $errorMessage .= 'Baris ke-' . $failure->row() . ': ' . implode(', ', $failure->errors()) . '; ';
            }
            
            // Tambahkan notifikasi untuk kegagalan import karena validasi
            NotificationController::addNotification(
                Auth::id(),
                'Import Tarif Gagal',
                'Validasi gagal: ' . $errorMessage,
                'fas fa-exclamation-triangle',
                'bg-red-100',
                'text-red-500',
                route('admin.rates')
            );
            
            return redirect()->route('admin.rates')->with('error', $errorMessage);
        } catch (\Exception $e) {
            // Tambahkan notifikasi untuk kegagalan import
            NotificationController::addNotification(
                Auth::id(),
                'Import Tarif Gagal',
                'Terjadi kesalahan saat import: ' . $e->getMessage(),
                'fas fa-exclamation-triangle',
                'bg-red-100',
                'text-red-500',
                route('admin.rates')
            );
            
            return redirect()->route('admin.rates')->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }
} 