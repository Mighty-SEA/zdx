<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class PageContentController extends Controller
{
    /**
     * Display a listing of the page contents
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageContents = PageContent::orderBy('page_key')
            ->orderBy('section')
            ->orderBy('order')
            ->paginate(15);
        
        return view('admin.page_contents.index', compact('pageContents'));
    }

    /**
     * Show the form for creating a new page content
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page_contents.create');
    }

    /**
     * Store a newly created page content
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_key' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'extra_data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare data
        $data = $request->except('_token');
        
        // Create page content
        PageContent::create($data);

        return redirect()->route('admin.page-contents.index')
            ->with('success', 'Konten halaman berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified page content
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageContent = PageContent::findOrFail($id);
        return view('admin.page_contents.edit', compact('pageContent'));
    }

    /**
     * Update the specified page content
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pageContent = PageContent::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'extra_data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update page content
        $pageContent->update($request->except(['_token', '_method']));

        return redirect()->route('admin.page-contents.index')
            ->with('success', 'Konten halaman berhasil diperbarui.');
    }

    /**
     * Remove the specified page content
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pageContent = PageContent::findOrFail($id);
        $pageContent->delete();

        return redirect()->route('admin.page-contents.index')
            ->with('success', 'Konten halaman berhasil dihapus.');
    }

    /**
     * Show editor for home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function editHomePage()
    {
        // Gunakan pendekatan query builder standar, bukan method helper yang custom
        $heroContent = PageContent::where('page_key', 'home')
            ->where('section', 'hero')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
            
        $statsContent = PageContent::where('page_key', 'home')
            ->where('section', 'stats')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
            
        $aboutContent = PageContent::where('page_key', 'home')
            ->where('section', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
        
        if (!$heroContent) {
            $heroContent = new PageContent([
                'page_key' => 'home',
                'section' => 'hero',
                'title' => 'Solusi Pengiriman',
                'subtitle' => 'Cepat & Terpercaya',
                'content' => 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu',
                'extra_data' => json_encode([
                    'cta_tracking_text' => 'Lacak Pengiriman',
                    'cta_tarif_text' => 'Cek Tarif'
                ]),
                'is_active' => true,
                'order' => 1
            ]);
            $heroContent->save();
        }
        
        if (!$statsContent) {
            $statsContent = new PageContent([
                'page_key' => 'home',
                'section' => 'stats',
                'title' => 'Statistik Kami',
                'subtitle' => '',
                'content' => '',
                'extra_data' => json_encode([
                    'stats' => [
                        ['label' => 'Partner', 'value' => '10000+'],
                        ['label' => 'Project', 'value' => '100+'],
                        ['label' => 'Success', 'value' => '24/7'],
                        ['label' => 'Country', 'value' => '99%']
                    ]
                ]),
                'is_active' => true,
                'order' => 2
            ]);
            $statsContent->save();
        }
        
        return view('admin.page_contents.home', compact('heroContent', 'statsContent', 'aboutContent'));
    }

    /**
     * Update home page content
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateHomePage(Request $request)
    {
        // Update hero section dengan query builder standar
        $heroContent = PageContent::where('page_key', 'home')
            ->where('section', 'hero')
            ->first();
            
        if ($heroContent) {
            $heroContent->update([
                'title' => $request->input('hero_title'),
                'subtitle' => $request->input('hero_subtitle'),
                'content' => $request->input('hero_content'),
                'extra_data' => json_encode([
                    'cta_tracking_text' => $request->input('hero_cta_tracking_text'),
                    'cta_tarif_text' => $request->input('hero_cta_tarif_text')
                ])
            ]);
        }
        
        // Update stats section dengan query builder standar
        $statsContent = PageContent::where('page_key', 'home')
            ->where('section', 'stats')
            ->first();
            
        if ($statsContent) {
            $stats = [];
            for ($i = 0; $i < 4; $i++) {
                $stats[] = [
                    'label' => $request->input("stats_label_$i"),
                    'value' => $request->input("stats_value_$i")
                ];
            }
            
            $statsContent->update([
                'extra_data' => json_encode(['stats' => $stats])
            ]);
        }
        
        return redirect()->back()->with('success', 'Konten halaman beranda berhasil diperbarui.');
    }

    /**
     * Check and create database columns if needed
     */
    public function checkDatabase()
    {
        // Check if page_contents table exists
        if (Schema::hasTable('page_contents')) {
            // Get column names
            $columns = Schema::getColumnListing('page_contents');
            
            // Return column list
            return response()->json([
                'status' => 'success',
                'message' => 'Table exists',
                'columns' => $columns
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Table does not exist'
        ]);
    }

    // Tambahkan fungsi directEdit ini setelah fungsi index atau di dekat fungsi-fungsi routing lainnya
    public function directEdit()
    {
        // Tampilkan menu pemilihan halaman untuk diedit
        $pages = [
            'home' => 'Halaman Utama',
            'services' => 'Halaman Layanan',
            'about' => 'Halaman Tentang',
            'contact' => 'Halaman Kontak'
        ];
        
        // Tampilkan view pemilihan halaman
        return view('admin.page_contents.page-selector', compact('pages'));
    }
    
    /**
     * Menampilkan editor untuk halaman yang dipilih
     * 
     * @param string $page
     * @return \Illuminate\Http\Response
     */
    public function editPage($page)
    {
        // Cek halaman yang dipilih
        switch($page) {
            case 'home':
                return $this->frontendEditor();
                break;
            case 'services':
                return $this->servicesEditor();
                break;
            case 'about':
                return $this->aboutEditor();
                break;
            case 'contact':
                return $this->contactEditor();
                break;
            default:
                return redirect()->route('admin.page-contents.index')
                    ->with('error', 'Halaman tidak ditemukan');
        }
    }
    
    /**
     * Editor untuk halaman layanan
     * 
     * @return \Illuminate\Http\Response
     */
    public function servicesEditor()
    {
        // Ambil semua konten untuk halaman layanan
        $contents = PageContent::where('page_key', 'services')
            ->where('is_active', true)
            ->get()
            ->keyBy('section');
            
        // Buat konten default jika belum ada
        $sections = ['header', 'intro', 'services_list', 'testimonials'];
        
        foreach ($sections as $section) {
            if (!isset($contents[$section])) {
                $defaultContent = new PageContent([
                    'page_key' => 'services',
                    'section' => $section,
                    'is_active' => true,
                    'order' => array_search($section, $sections) + 1
                ]);
                
                // Isi default untuk setiap section
                if ($section == 'header') {
                    $defaultContent->title = 'Layanan Kami';
                    $defaultContent->subtitle = 'Solusi Logistik Terbaik';
                    $defaultContent->content = 'Kami menyediakan berbagai layanan pengiriman dan logistik untuk memenuhi kebutuhan bisnis Anda.';
                } elseif ($section == 'intro') {
                    $defaultContent->title = 'Layanan Berkualitas';
                    $defaultContent->content = 'ZDX Express menawarkan solusi pengiriman yang komprehensif untuk bisnis dan individu.';
                } elseif ($section == 'services_list') {
                    $defaultContent->title = 'Pilihan Layanan';
                    $defaultContent->extra_data = json_encode([
                        'services' => [
                            ['name' => 'Pengiriman Darat', 'description' => 'Layanan pengiriman darat ke seluruh Indonesia'],
                            ['name' => 'Pengiriman Laut', 'description' => 'Layanan pengiriman laut antar pulau'],
                            ['name' => 'Pengiriman Udara', 'description' => 'Layanan pengiriman udara cepat']
                        ]
                    ]);
                }
                
                $defaultContent->save();
                $contents[$section] = $defaultContent;
            }
        }
        
        $headerContent = $contents['header'] ?? null;
        $introContent = $contents['intro'] ?? null;
        $servicesListContent = $contents['services_list'] ?? null;
        $testimonialsContent = $contents['testimonials'] ?? null;
        
        // Set session flag for direct edit mode
        session(['direct_edit_mode' => true]);
        
        // Menampilkan view dengan editor layanan
        return view('admin.page_contents.services-editor', compact(
            'headerContent', 
            'introContent', 
            'servicesListContent', 
            'testimonialsContent'
        ));
    }
    
    /**
     * Editor untuk halaman tentang
     * 
     * @return \Illuminate\Http\Response
     */
    public function aboutEditor()
    {
        // Ambil semua konten untuk halaman tentang
        $contents = PageContent::where('page_key', 'about')
            ->where('is_active', true)
            ->get()
            ->keyBy('section');
            
        // Buat konten default jika belum ada
        $sections = ['header', 'mission', 'vision', 'history', 'team'];
        
        foreach ($sections as $section) {
            if (!isset($contents[$section])) {
                $defaultContent = new PageContent([
                    'page_key' => 'about',
                    'section' => $section,
                    'is_active' => true,
                    'order' => array_search($section, $sections) + 1
                ]);
                
                // Isi default untuk setiap section
                if ($section == 'header') {
                    $defaultContent->title = 'Tentang Kami';
                    $defaultContent->subtitle = 'Mengenal ZDX Express';
                    $defaultContent->content = 'ZDX Express adalah perusahaan logistik terpercaya yang menyediakan layanan pengiriman berkualitas.';
                } elseif ($section == 'mission') {
                    $defaultContent->title = 'Misi Kami';
                    $defaultContent->content = 'Memberikan layanan pengiriman terbaik dengan fokus pada keamanan, kecepatan, dan kepuasan pelanggan.';
                } elseif ($section == 'vision') {
                    $defaultContent->title = 'Visi Kami';
                    $defaultContent->content = 'Menjadi perusahaan logistik terdepan di Indonesia dengan jaringan terluas dan teknologi terkini.';
                } elseif ($section == 'history') {
                    $defaultContent->title = 'Sejarah Perusahaan';
                    $defaultContent->content = 'Didirikan pada tahun 2010, ZDX Express telah tumbuh menjadi salah satu penyedia layanan logistik terkemuka.';
                }
                
                $defaultContent->save();
                $contents[$section] = $defaultContent;
            }
        }
        
        $headerContent = $contents['header'] ?? null;
        $missionContent = $contents['mission'] ?? null;
        $visionContent = $contents['vision'] ?? null;
        $historyContent = $contents['history'] ?? null;
        $teamContent = $contents['team'] ?? null;
        
        // Set session flag for direct edit mode
        session(['direct_edit_mode' => true]);
        
        // Menampilkan view dengan editor tentang
        return view('admin.page_contents.about-editor', compact(
            'headerContent', 
            'missionContent', 
            'visionContent', 
            'historyContent', 
            'teamContent'
        ));
    }
    
    /**
     * Editor untuk halaman kontak
     * 
     * @return \Illuminate\Http\Response
     */
    public function contactEditor()
    {
        // Ambil semua konten untuk halaman kontak
        $contents = PageContent::where('page_key', 'contact')
            ->where('is_active', true)
            ->get()
            ->keyBy('section');
            
        // Buat konten default jika belum ada
        $sections = ['header', 'contact_info', 'form', 'map'];
        
        foreach ($sections as $section) {
            if (!isset($contents[$section])) {
                $defaultContent = new PageContent([
                    'page_key' => 'contact',
                    'section' => $section,
                    'is_active' => true,
                    'order' => array_search($section, $sections) + 1
                ]);
                
                // Isi default untuk setiap section
                if ($section == 'header') {
                    $defaultContent->title = 'Hubungi Kami';
                    $defaultContent->subtitle = 'Kami Siap Membantu';
                    $defaultContent->content = 'Silakan hubungi kami untuk informasi lebih lanjut tentang layanan kami.';
                } elseif ($section == 'contact_info') {
                    $defaultContent->title = 'Informasi Kontak';
                    $defaultContent->extra_data = json_encode([
                        'address' => 'Jl. Raya No. 123, Jakarta',
                        'phone' => '+62123456789',
                        'email' => 'info@zdxcargo.com',
                        'hours' => 'Senin - Jumat: 08:00 - 17:00'
                    ]);
                } elseif ($section == 'form') {
                    $defaultContent->title = 'Kirim Pesan';
                    $defaultContent->content = 'Isi formulir di bawah ini untuk mengirim pesan kepada kami. Kami akan merespons secepat mungkin.';
                }
                
                $defaultContent->save();
                $contents[$section] = $defaultContent;
            }
        }
        
        $headerContent = $contents['header'] ?? null;
        $contactInfoContent = $contents['contact_info'] ?? null;
        $formContent = $contents['form'] ?? null;
        $mapContent = $contents['map'] ?? null;
        
        // Set session flag for direct edit mode
        session(['direct_edit_mode' => true]);
        
        // Menampilkan view dengan editor kontak
        return view('admin.page_contents.contact-editor', compact(
            'headerContent', 
            'contactInfoContent', 
            'formContent', 
            'mapContent'
        ));
    }

    /**
     * Show interactive editor for all page contents
     * 
     * @return \Illuminate\Http\Response
     */
    public function liveEditor()
    {
        // Ambil konten untuk halaman beranda
        $heroContent = PageContent::where('page_key', 'home')
            ->where('section', 'hero')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
            
        $statsContent = PageContent::where('page_key', 'home')
            ->where('section', 'stats')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
        
        // Buat konten default jika belum ada
        if (!$heroContent) {
            $heroContent = new PageContent([
                'page_key' => 'home',
                'section' => 'hero',
                'title' => 'Solusi Pengiriman',
                'subtitle' => 'Cepat & Terpercaya',
                'content' => 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu',
                'extra_data' => json_encode([
                    'cta_tracking_text' => 'Lacak Pengiriman',
                    'cta_tarif_text' => 'Cek Tarif'
                ]),
                'is_active' => true,
                'order' => 1
            ]);
            $heroContent->save();
        }
        
        if (!$statsContent) {
            $statsContent = new PageContent([
                'page_key' => 'home',
                'section' => 'stats',
                'title' => 'Statistik Kami',
                'subtitle' => '',
                'content' => '',
                'extra_data' => json_encode([
                    'stats' => [
                        ['label' => 'Partner', 'value' => '10000+'],
                        ['label' => 'Project', 'value' => '100+'],
                        ['label' => 'Success', 'value' => '24/7'],
                        ['label' => 'Country', 'value' => '99%']
                    ]
                ]),
                'is_active' => true,
                'order' => 2
            ]);
            $statsContent->save();
        }
        
        // Menampilkan view dengan editor visual interaktif
        return view('admin.page_contents.home-editor', compact('heroContent', 'statsContent'));
    }

    /**
     * Save page content from live editor via AJAX
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveLiveContent(Request $request)
    {
        $page = $request->input('page');
        $section = $request->input('section');
        $data = $request->input('data');
        
        // Cari konten berdasarkan page dan section
        $content = PageContent::where('page_key', $page)
            ->where('section', $section)
            ->first();
        
        if (!$content) {
            // Buat baru jika tidak ditemukan
            $content = new PageContent([
                'page_key' => $page,
                'section' => $section,
                'is_active' => true,
                'order' => 0
            ]);
        }
        
        // Update data konten
        foreach ($data as $key => $value) {
            if ($key === 'extra_data') {
                // Handle data tambahan
                $content->extra_data = json_encode($value);
            } else {
                // Handle data biasa
                $content->$key = $value;
            }
        }
        
        $content->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Konten berhasil disimpan'
        ]);
    }

    /**
     * Frontend editor for home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function frontendEditor()
    {
        // Ambil semua konten untuk halaman beranda
        $contents = PageContent::where('page_key', 'home')
            ->where('is_active', true)
            ->get()
            ->keyBy('section');
            
        // Buat konten default jika belum ada
        $sections = ['hero', 'stats', 'services', 'about', 'footer'];
        
        foreach ($sections as $section) {
            if (!isset($contents[$section])) {
                $defaultContent = new PageContent([
                    'page_key' => 'home',
                    'section' => $section,
                    'is_active' => true,
                    'order' => array_search($section, $sections) + 1
                ]);
                
                // Isi default untuk setiap section
                if ($section == 'hero') {
                    $defaultContent->title = 'Solusi Pengiriman';
                    $defaultContent->subtitle = 'Cepat & Terpercaya';
                    $defaultContent->content = 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu';
                    $defaultContent->extra_data = json_encode([
                        'cta_tracking_text' => 'Lacak Pengiriman',
                        'cta_tarif_text' => 'Cek Tarif'
                    ]);
                } elseif ($section == 'stats') {
                    $defaultContent->title = 'Statistik Kami';
                    $defaultContent->extra_data = json_encode([
                        'stats' => [
                            ['label' => 'Partner', 'value' => '100+'],
                            ['label' => 'Project', 'value' => '100+'],
                            ['label' => 'Success', 'value' => '100+'],
                            ['label' => 'Country', 'value' => '100+']
                        ]
                    ]);
                } elseif ($section == 'footer') {
                    $defaultContent->title = 'ZDX Express';
                    $defaultContent->content = 'Layanan pengiriman cepat dan terpercaya';
                    $defaultContent->extra_data = json_encode([
                        'address' => 'Jl. Raya No. 123, Jakarta',
                        'phone' => '+62123456789',
                        'email' => 'info@zdxcargo.com'
                    ]);
                }
                
                $defaultContent->save();
                $contents[$section] = $defaultContent;
            }
        }
        
        $heroContent = $contents['hero'] ?? null;
        $statsContent = $contents['stats'] ?? null;
        $servicesContent = $contents['services'] ?? null;
        $aboutContent = $contents['about'] ?? null;
        $footerContent = $contents['footer'] ?? null;
        
        // Set session flag for direct edit mode
        session(['direct_edit_mode' => true]);
        
        // Menampilkan view dengan editor frontend
        return view('admin.page_contents.frontend-editor', compact(
            'heroContent', 
            'statsContent', 
            'servicesContent', 
            'aboutContent',
            'footerContent'
        ));
    }

    /**
     * Save content from frontend editor
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveFrontendContent(Request $request)
    {
        $data = $request->input('data', []);
        $success = true;
        $messages = [];
        
        // Proses setiap section
        foreach ($data as $sectionKey => $sectionData) {
            try {
                // Cari konten berdasarkan page dan section
                $content = PageContent::where('page_key', 'home')
                    ->where('section', $sectionKey)
                    ->first();
                
                if (!$content) {
                    // Buat baru jika tidak ditemukan
                    $content = new PageContent([
                        'page_key' => 'home',
                        'section' => $sectionKey,
                        'is_active' => true,
                        'order' => 0
                    ]);
                }
                
                // Update data content biasa
                if (isset($sectionData['title'])) $content->title = $sectionData['title'];
                if (isset($sectionData['subtitle'])) $content->subtitle = $sectionData['subtitle'];
                if (isset($sectionData['content'])) $content->content = $sectionData['content'];
                
                // Handle extra data
                $extraData = $content->extra_data ? json_decode($content->extra_data, true) : [];
                
                // Simpan semua field yang dikirim untuk section ini
                foreach ($sectionData as $key => $value) {
                    if (!in_array($key, ['title', 'subtitle', 'content'])) {
                        $extraData[$key] = $value;
                    }
                }
                
                // Simpan extra data
                $content->extra_data = json_encode($extraData);
                $content->save();
                
                $messages[] = "Section {$sectionKey} berhasil diperbarui.";
            } catch (\Exception $e) {
                $success = false;
                $messages[] = "Error pada section {$sectionKey}: " . $e->getMessage();
            }
        }
        
        // Setelah menyimpan, perbarui session untuk refresh halaman utama
        session()->flash('content_updated', true);
        
        return response()->json([
            'status' => $success ? 'success' : 'error',
            'message' => implode(' ', $messages)
        ]);
    }
    
    /**
     * Save content from the new frontend editor
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveFrontendEditor(Request $request)
    {
        try {
            $sections = $request->input('sections', []);
            $updatedSections = [];
            
            foreach ($sections as $sectionKey => $sectionData) {
                // Cari konten berdasarkan ID jika ada, atau berdasarkan page_key dan section
                if (!empty($sectionData['id'])) {
                    $content = PageContent::find($sectionData['id']);
                } else {
                    $content = PageContent::where('page_key', $sectionData['page_key'])
                        ->where('section', $sectionData['section'])
                        ->first();
                }
                
                // Buat baru jika tidak ditemukan
                if (!$content) {
                    $content = new PageContent();
                }
                
                // Set basic fields
                $content->page_key = $sectionData['page_key'];
                $content->section = $sectionData['section'];
                $content->title = $sectionData['title'] ?? '';
                $content->subtitle = $sectionData['subtitle'] ?? '';
                $content->content = $sectionData['content'] ?? '';
                $content->order = $sectionData['order'] ?? 0;
                $content->is_active = $sectionData['is_active'] ?? true;
                
                // Handle extra_data
                if (isset($sectionData['extra_data'])) {
                    $content->extra_data = json_encode($sectionData['extra_data']);
                }
                
                // Handle image upload jika ada
                if (isset($sectionData['image']) && $sectionData['image']->isValid()) {
                    // Hapus gambar lama jika ada
                    if ($content->image) {
                        // Hapus file lama
                        $oldImagePath = public_path('storage/' . $content->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    
                    // Upload gambar baru
                    $imagePath = $request->file("sections.{$sectionKey}.image")->store('page_contents', 'public');
                    $content->image = $imagePath;
                }
                
                // Hapus gambar jika diminta
                if (isset($sectionData['remove_image']) && $sectionData['remove_image'] && $content->image) {
                    // Hapus file
                    $imagePath = public_path('storage/' . $content->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $content->image = null;
                }
                
                $content->save();
                $updatedSections[] = $sectionKey;
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Konten berhasil disimpan',
                'updated_sections' => $updatedSections
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
