<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'image' => 'air-freight.jpg',
                'title' => 'Air Freight',
                'slug' => 'air-freight',
                'description' => 'Air freight, atau kargo udara, adalah metode pengiriman barang melalui transportasi udara. Ini adalah cara tercepat untuk mengangkut barang dari satu tempat ke tempat lain, terutama ketika jaraknya sangat jauh atau waktu pengiriman sangat terbatas.',
                'content' => '<h2>Air Freight - Pengiriman Udara</h2>
                
<p>Air freight, atau kargo udara, adalah metode pengiriman barang melalui transportasi udara. Ini adalah cara tercepat untuk mengangkut barang dari satu tempat ke tempat lain, terutama ketika jaraknya sangat jauh atau waktu pengiriman sangat terbatas. Proses ini melibatkan pesawat kargo yang khusus dirancang untuk mengangkut barang atau pesawat penumpang yang juga membawa kargo di bagian kargo mereka.</p>

<h3>Keuntungan Utama Air Freight</h3>

<h4>Kecepatan</h4>
<p>Pengiriman melalui udara adalah cara tercepat untuk memindahkan barang, cocok untuk barang yang membutuhkan waktu pengiriman singkat, seperti produk segar, obat-obatan, atau barang elektronik.</p>

<h4>Keamanan</h4>
<p>Pengiriman melalui udara cenderung lebih aman karena prosedur keamanan yang ketat di bandara dan risiko kerusakan yang lebih rendah dibandingkan dengan metode pengiriman lainnya.</p>

<h4>Jangkauan</h4>
<p>Pesawat dapat mencapai hampir semua lokasi di dunia yang memiliki bandara, membuatnya ideal untuk pengiriman internasional.</p>

<h4>Pencatatan & Pelacakan</h4>
<p>Air freight sering kali dilengkapi dengan sistem pelacakan yang canggih, memungkinkan pengirim dan penerima untuk memantau lokasi dan status barang secara real-time.</p>

<p>Dalam industri logistik dan transportasi, air freight sangat penting untuk pengiriman barang yang membutuhkan pengiriman cepat dan efisien, terutama dalam konteks perdagangan internasional.</p>

<h3>Layanan Air Freight Kami</h3>
<ul>
    <li>Door To Door Service</li>
    <li>Port to Port Service</li>
    <li>Door To Port Service</li>
    <li>Port To Door Services</li>
    <li>Charter Flight</li>
</ul>',
                'icon' => 'fa-plane',
                'status' => 'published',
                'featured' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Land Freight',
                'slug' => 'land-freight',
                'description' => 'Land freight adalah layanan pengiriman darat menggunakan truk, kereta api, atau van untuk mengangkut barang dalam jarak pendek hingga menengah dengan efisien dan aman.',
                'content' => '<h2>Land Freight - Pengiriman Darat</h2>
                
<p>Land freight adalah metode pengiriman barang via darat menggunakan truk, kereta api, atau van. Metode ini umum digunakan untuk pengiriman jarak pendek hingga menengah, baik domestik maupun internasional.</p>

<h3>Keuntungan Utama Land Freight</h3>

<h4>Fleksibilitas</h4>
<p>Pengiriman darat sangat fleksibel dan dapat mencapai hampir semua lokasi, termasuk area pedesaan yang mungkin tidak dapat dijangkau oleh metode pengiriman lain seperti pengiriman udara atau laut.</p>

<h4>Biaya Efektif</h4>
<p>Untuk jarak pendek hingga menengah, pengiriman darat sering kali lebih ekonomis dibandingkan dengan metode lain. Ini terutama berlaku untuk pengiriman barang dalam jumlah besar.</p>

<h4>Konektivitas</h4>
<p>Land freight dapat digunakan sebagai bagian dari sistem multimoda, di mana barang diangkut menggunakan kombinasi truk, kereta api, kapal, dan pesawat untuk mencapai tujuan akhir.</p>

<h4>Kapasitas</h4>
<p>Truk dan kereta api dapat membawa barang dalam jumlah besar dan berat, membuatnya ideal untuk berbagai jenis kargo, termasuk bahan baku, barang konsumsi, dan peralatan industri.</p>

<h4>Kecepatan Pengiriman</h4>
<p>Meskipun tidak secepat pengiriman udara, pengiriman darat dapat sangat cepat dan efisien, terutama untuk jarak pendek dan menengah.</p>

<p>Secara keseluruhan, land freight adalah komponen penting dalam rantai pasokan global, menyediakan solusi pengiriman yang fleksibel dan efisien untuk berbagai kebutuhan logistik.</p>

<h3>Layanan Land Freight Kami</h3>
<ul>
    <li>Pickup</li>
    <li>CDE (CD4)</li>
    <li>CDD (CD6)</li>
    <li>Fuso</li>
    <li>Wingsbox</li>
    <li>Refrigerated Truck</li>
</ul>',
                'icon' => 'fa-truck',
                'status' => 'published',
                'featured' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Sea Freight',
                'slug' => 'sea-freight',
                'description' => 'Sea freight, atau kargo laut, adalah metode pengiriman barang menggunakan kapal laut. Ini adalah salah satu metode pengiriman yang paling umum dan efisien untuk mengangkut barang dalam jumlah besar dan berat, terutama dalam perdagangan internasional.',
                'content' => '<h2>Sea Freight - Pengiriman Laut</h2>
                
<p>Sea freight, atau kargo laut, adalah metode pengiriman barang menggunakan kapal laut. Ini adalah salah satu metode pengiriman yang paling umum dan efisien untuk mengangkut barang dalam jumlah besar dan berat, terutama dalam perdagangan internasional.</p>

<h3>Keuntungan Utama Sea Freight</h3>

<h4>Kapasitas Besar</h4>
<p>Kapal laut dapat mengangkut volume dan berat kargo yang sangat besar, membuatnya ideal untuk pengiriman massal atau barang-barang dengan dimensi besar.</p>

<h4>Biaya Rendah</h4>
<p>Untuk jarak menengah hingga jauh, pengiriman laut biasanya menawarkan biaya per unit yang lebih rendah dibandingkan dengan metode pengiriman lainnya, terutama untuk kargo dalam jumlah besar.</p>

<h4>Efisiensi Energi</h4>
<p>Pengiriman laut memiliki jejak karbon yang lebih rendah per ton kargo dibandingkan dengan pengiriman udara, membuatnya lebih ramah lingkungan untuk pengiriman dalam jumlah besar.</p>

<h4>Cakupan Global</h4>
<p>Dengan ribuan pelabuhan di seluruh dunia, pengiriman laut dapat menjangkau hampir semua pasar global utama dan banyak lokasi yang mungkin sulit dijangkau melalui udara.</p>

<p>Sea freight adalah bagian penting dari rantai pasokan global, memainkan peran vital dalam perdagangan internasional dengan menyediakan metode pengiriman yang efisien dan ekonomis untuk berbagai jenis barang.</p>

<h3>Layanan Sea Freight Kami</h3>
<ul>
    <li>Full Container Load (FCL)</li>
    <li>Less Container Load (LCL)</li>
    <li>Break Bulk</li>
    <li>Charter LCT</li>
    <li>Barge</li>
</ul>',
                'icon' => 'fa-ship',
                'status' => 'published',
                'featured' => true,
                'sort_order' => 3
            ]
        ];
        
        foreach ($services as $serviceData) {
            // Cek apakah slug sudah ada
            $existingService = Service::where('slug', $serviceData['slug'])->first();
            
            if (!$existingService) {
                Service::create($serviceData);
            } else {
                $existingService->update($serviceData);
            }
        }
    }
} 