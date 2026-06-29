<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        $this->load->model('Cabai_model');
        $this->load->model('Bibit_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['statistics'] = $this->Transaksi_model->get_statistics();
        $data['total_cabai'] = count($this->Cabai_model->get_all());
        $data['total_bibit'] = count($this->Bibit_model->get_all_with_cabai());
        // 1. Tarik pakai Model Bibit lu yang asli
        $bibit_kritis = $this->Bibit_model->get_low_stock();
        
        // Tarik Cabai manual pakai query builder (karena di Cabai_model mungkin belum ada fungsinya)
        $cabai_kritis = $this->db->where('stok <=', 5)->get('cabais')->result_array();

        $stok_gabungan = [];

        // 2. Format data Bibit
        foreach ($bibit_kritis as $b) {
            $stok_gabungan[] = [
                'gambar' => $b['gambar'],
                'produk' => $b['nama_produk'], // Pake nama_produk sesuai DB lu
                'stok'   => $b['stok'],
                'link'   => base_url('admin_bibit/edit/' . $b['id'])
            ];
        }

        // 3. Format data Cabai (samain key-nya biar View ga bingung)
        foreach ($cabai_kritis as $c) {
            $stok_gabungan[] = [
                'gambar' => isset($c['gambar']) ? $c['gambar'] : '',
                'produk' => 'Cabai ' . $c['nama_varietas'], 
                'stok'   => $c['stok'],
                'link'   => base_url('admin_cabai/edit/' . $c['id'])
            ];
        }

        // 4. Urutin dari yang stoknya paling ludes (0)
        usort($stok_gabungan, function($a, $b) {
            return $a['stok'] <=> $b['stok'];
        });

        // 5. BALIKIN NAMANYA JADI 'low_stock' BIAR HTML LU KENAL!
        $data['low_stock'] = array_slice($stok_gabungan, 0, 5);
        $data['latest_transaksi'] = $this->Transaksi_model->get_latest(5);
        
        // --- TAMBAHAN UNTUK GRAFIK ---
        $grafik_data = $this->Transaksi_model->get_grafik_pendapatan();
        $tanggal = [];
        $pendapatan = [];
        
        foreach ($grafik_data as $g) {
            // Ubah format tanggal dari '2026-06-24' jadi '24 Jun' biar rapi
            $tanggal[] = date('d M', strtotime($g['tanggal']));
            $pendapatan[] = $g['pendapatan'];
        }
        
        // Bungkus jadi JSON
        $data['grafik_tanggal'] = json_encode($tanggal);
        $data['grafik_pendapatan'] = json_encode($pendapatan);
        // -----------------------------

        // --- TAMBAHAN UNTUK GRAFIK PRODUK TERLARIS (PIE CHART) ---
        $semua_produk = $this->Transaksi_model->get_produk_terlaris();
        
        $label_produk = [];
        $data_terjual = [];
        $warna_produk = [];
        $total_lainnya = 0;

        // Siapin 5 warna estetis buat potongan Pizza/Lingkaran
        $palette = [
            'rgba(45, 122, 36, 0.85)',   // 1. Hijau Tua
            'rgba(220, 53, 69, 0.85)',   // 2. Merah
            'rgba(255, 193, 7, 0.85)',   // 3. Kuning
            'rgba(23, 162, 184, 0.85)',  // 4. Biru Cyan
            'rgba(108, 117, 125, 0.85)'  // 5. Abu-abu (Khusus "Lainnya")
        ];

        $i = 0;
        foreach ($semua_produk as $p) {
            if ($i < 4) {
                // Masukin 4 produk teratas + Keterangan Jenisnya
                $jenis = ucfirst($p['tipe_produk']); // Ubah 'cabai' jadi 'Cabai'
                $label_produk[] = $p['nama_produk'] . ' (' . $jenis . ')';
                $data_terjual[] = $p['total_terjual'];
                $warna_produk[] = $palette[$i];
            } else {
                // Produk ke-5 sampai terakhir ditotal dan digabung jadi satu
                $total_lainnya += $p['total_terjual'];
            }
            $i++;
        }

        // Kalau ternyata ada produk sisa, masukin jadi potongan ke-5 (Lainnya)
        if ($total_lainnya > 0) {
            $label_produk[] = 'Lainnya';
            $data_terjual[] = $total_lainnya;
            $warna_produk[] = $palette[4]; 
        }

        $data['grafik_label_produk'] = json_encode($label_produk);
        $data['grafik_data_terjual'] = json_encode($data_terjual);
        $data['grafik_warna_produk'] = json_encode($warna_produk);
        // ---------------------------------------------
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/template/footer');
    }
}
?>