<?php

namespace App\Imports;

use App\Models\Rate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class RatesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows, WithChunkReading, WithBatchInserts
{
    use Importable;
    
    /**
     * @var string
     */
    protected $duplicateHandling;
    
    /**
     * @var array
     */
    protected $stats = [
        'added' => 0,
        'updated' => 0,
        'skipped' => 0
    ];
    
    /**
     * Constructor
     * 
     * @param string $duplicateHandling Mode penanganan data duplikat (update, skip, atau duplicate)
     */
    public function __construct(string $duplicateHandling = 'duplicate')
    {
        $this->duplicateHandling = $duplicateHandling;
    }
    
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Jika baris kosong, skip
        if (empty($row['pulau']) || empty($row['provinsi'])) {
            return null;
        }
        
        // Siapkan data untuk model
        $data = [
            'pulau'                => $row['pulau'],
            'provinsi'             => $row['provinsi'],
            'kota_kab'             => $row['kota_kabupaten'] ?? $row['kota_kab'] ?? $row['kota'] ?? null,
            'kelurahan_kecamatan'  => $row['kelurahan_kecamatan'] ?? $row['kecamatan'] ?? $row['kelurahan'] ?? null,
            'harga_satuan'         => $row['harga_satuan'] ?? $row['harga'] ?? 0,
            'minimal_kg'           => $row['minimal_kg'] ?? $row['min_kg'] ?? 1,
            'estimasi'             => $row['estimasi'] ?? $row['estimasi_waktu'] ?? '1-2 hari'
        ];
        
        // Cek apakah data sudah ada
        $existingRate = Rate::where('pulau', $data['pulau'])
            ->where('provinsi', $data['provinsi'])
            ->where('kota_kab', $data['kota_kab'])
            ->where('kelurahan_kecamatan', $data['kelurahan_kecamatan'])
            ->first();
        
        if ($existingRate) {
            // Handle data duplikat berdasarkan mode yang dipilih
            if ($this->duplicateHandling === 'update') {
                $existingRate->update([
                    'harga_satuan' => $data['harga_satuan'],
                    'minimal_kg' => $data['minimal_kg'],
                    'estimasi' => $data['estimasi'],
                ]);
                $this->stats['updated']++;
                return null; // Return null karena kita sudah update secara manual
            } elseif ($this->duplicateHandling === 'skip') {
                $this->stats['skipped']++;
                return null; // Skip data yang sudah ada
            }
            // Jika duplicate, lanjutkan seperti biasa
        }
        
        // Data baru
        $this->stats['added']++;
        return new Rate($data);
    }
    
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'pulau' => 'required',
            'provinsi' => 'required',
            '*.pulau' => 'required',
            '*.provinsi' => 'required',
            '*.harga_satuan' => 'numeric|min:0',
            '*.minimal_kg' => 'numeric|min:1'
        ];
    }
    
    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'pulau.required' => 'Kolom pulau harus diisi',
            'provinsi.required' => 'Kolom provinsi harus diisi',
            '*.pulau.required' => 'Kolom pulau harus diisi pada semua baris',
            '*.provinsi.required' => 'Kolom provinsi harus diisi pada semua baris',
            '*.harga_satuan.numeric' => 'Kolom harga satuan harus berupa angka',
            '*.harga_satuan.min' => 'Kolom harga satuan minimal 0',
            '*.minimal_kg.numeric' => 'Kolom minimal kg harus berupa angka',
            '*.minimal_kg.min' => 'Kolom minimal kg minimal 1'
        ];
    }
    
    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 100;
    }
    
    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 100;
    }
    
    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
    
    /**
     * Mendapatkan statistik import
     * 
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
} 