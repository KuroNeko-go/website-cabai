<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cabai_model');
        $this->load->model('Bibit_model');
    }

    public function index()
{
    $data['title'] = 'Beranda | DuaPutra';

    // 1. Ambil 4 produk dengan jumlah qty terjual paling banyak
    // MANGGIL TABEL TRANSAKSI_DETAIL SESUAI DATABASE LU
    $this->db->select('product_id, tipe_produk, SUM(qty) as total_terjual');
    $this->db->from('transaksi_detail'); // <--- INI UDAH GW GANTI JADI BENER
    $this->db->group_by(array('product_id', 'tipe_produk'));
    $this->db->order_by('total_terjual', 'DESC');
    $this->db->limit(4);
    $best_sellers_query = $this->db->get()->result_array();

    $produk_bestseller = [];

    // 2. Tarik detail produk asli dari tabel cabais atau bibits
    foreach ($best_sellers_query as $bs) {
        if ($bs['tipe_produk'] == 'cabai') {
            $p = $this->db->get_where('cabais', ['id' => $bs['product_id']])->row_array();
            if ($p) {
                $p['tipe_asli'] = 'cabai';
                $p['nama_tampil'] = $p['nama_varietas']; 
                $produk_bestseller[] = $p;
            }
        } else {
            $p = $this->db->get_where('bibits', ['id' => $bs['product_id']])->row_array();
            if ($p) {
                $p['tipe_asli'] = 'bibit';
                $p['nama_tampil'] = $p['nama_produk']; 
                $produk_bestseller[] = $p;
            }
        }
    }

    // 3. Lempar datanya ke View
    $data['best_seller'] = $produk_bestseller;

    $this->load->view('frontend/template/header', $data);
    $this->load->view('frontend/home/index', $data);
    $this->load->view('frontend/template/footer');
}
public function balas_chat() {
    $pesan = strtolower($this->input->post('pesan'));
    $konteks = $this->session->userdata('konteks_chat');
    $topik = $this->session->userdata('topik_chat');
    $balasan = "";

    // =======================================================
    // 1. CEK INGATAN BOT (STATEFUL) - Jika bot nunggu jawaban
    // =======================================================
    if ($konteks == 'tunggu_kategori') {
        // Langsung hapus ingatannya biar nggak nyangkut selamanya
        $this->session->unset_userdata('konteks_chat');
        $this->session->unset_userdata('topik_chat');

        if (strpos($pesan, 'bibit') !== false) {
            $pesan = $topik . ' bibit'; 
        } elseif (strpos($pesan, 'cabai') !== false || strpos($pesan, 'cabe') !== false) {
            $pesan = $topik . ' cabai';
        } else {
            $balasan = "Eh, Asisten bingung. 😅 Kakak harusnya balas ketik <b>Bibit</b> atau <b>Cabai</b>. Kita mulai dari awal lagi ya, Kakak mau tanya apa?";
            echo json_encode(['balasan' => $balasan]);
            return;
        }
    }

    // =======================================================
    // 2. DETEKSI INTENT (Tujuan User)
    // =======================================================
    $tanya_stok = (strpos($pesan, 'stok') !== false || strpos($pesan, 'ready') !== false);
    $tanya_harga = (strpos($pesan, 'harga') !== false || strpos($pesan, 'berapa') !== false);
    $tanya_varietas = (strpos($pesan, 'varietas') !== false || strpos($pesan, 'pedas') !== false || strpos($pesan, 'jenis') !== false);
    
    $kategori_bibit = (strpos($pesan, 'bibit') !== false);
    $kategori_cabai = (strpos($pesan, 'cabai') !== false || strpos($pesan, 'cabe') !== false);

    // =======================================================
    // 3. EKSEKUSI LOGIKA
    // =======================================================
    if ($tanya_stok || $tanya_harga || $tanya_varietas) {
        
        // JIKA KATEGORI BELUM DISEBUT (Bot nanya balik)
        if (!$kategori_bibit && !$kategori_cabai) {
            $topik_simpan = '';
            if ($tanya_stok) $topik_simpan = 'stok';
            elseif ($tanya_harga) $topik_simpan = 'harga';
            elseif ($tanya_varietas) $topik_simpan = 'varietas';

            $this->session->set_userdata('konteks_chat', 'tunggu_kategori');
            $this->session->set_userdata('topik_chat', $topik_simpan);
            
            $balasan = "Siap Kak! Tapi Kakak mau cek informasi untuk <b>Bibit</b> atau buah <b>Cabai</b>-nya nih?";
        } 
        
        // JIKA USER MILIH BIBIT (Tarik dari tabel 'bibits')
        elseif ($kategori_bibit) {
            if ($tanya_stok) {
                $query = $this->db->query("SELECT nama_produk, stok FROM bibits WHERE stok > 0 LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar stok <b>Bibit</b> yang *Ready* Kak:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_produk . " : <b>" . $row->stok . " pcs</b></li>";
                    }
                    $balasan .= "</ul>";
                } else {
                    $balasan = "Maaf Kak, stok bibit lagi kosong semua.";
                }
            } elseif ($tanya_harga) {
                $query = $this->db->query("SELECT nama_produk, harga FROM bibits LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar harga <b>Bibit</b> kita Kak:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_produk . " : <b>Rp " . number_format($row->harga, 0, ',', '.') . "</b></li>";
                    }
                    $balasan .= "</ul>";
                } else {
                    $balasan = "Harga bibit belum diupdate Kak.";
                }
            } elseif ($tanya_varietas) {
                $query = $this->db->query("SELECT nama_produk FROM bibits LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar <b>Bibit</b> dari berbagai varietas yang kita punya:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_produk . "</li>";
                    }
                    $balasan .= "</ul>";
                }
            }
        } 
        
        // JIKA USER MILIH CABAI (Tarik dari tabel 'cabais' yang udah lu update)
        elseif ($kategori_cabai) {
            if ($tanya_stok) {
                $query = $this->db->query("SELECT nama_varietas, stok FROM cabais WHERE stok > 0 LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar stok buah <b>Cabai</b> yang *Ready* Kak:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_varietas . " : <b>" . $row->stok . " pcs</b></li>";
                    }
                    $balasan .= "</ul><br>Mau langsung dibungkus yang mana nih Kak? 🌶️";
                } else {
                    $balasan = "Maaf Kak, stok buah cabai lagi kosong semua.";
                }
            } elseif ($tanya_harga) {
                $query = $this->db->query("SELECT nama_varietas, harga FROM cabais LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar harga buah <b>Cabai</b> kita Kak:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_varietas . " : <b>Rp " . number_format($row->harga, 0, ',', '.') . "</b></li>";
                    }
                    $balasan .= "</ul>";
                } else {
                    $balasan = "Harga buah cabai belum diupdate Kak.";
                }
            } elseif ($tanya_varietas) {
                $query = $this->db->query("SELECT nama_varietas, tingkat_pedas FROM cabais LIMIT 5");
                if ($query->num_rows() > 0) {
                    $balasan = "Ini daftar varietas <b>Cabai</b> dan kepedasannya Kak:<br><ul style='margin-bottom: 0; padding-left: 20px;'>";
                    foreach ($query->result() as $row) {
                        $balasan .= "<li>" . $row->nama_varietas . " (<i>" . $row->tingkat_pedas . "</i>)</li>";
                    }
                    $balasan .= "</ul>";
                }
            }
        }
    } 
    
    // =======================================================
    // 4. FAQ BIASA (Kalau nanya di luar stok/harga/varietas)
    // =======================================================
    else {
        $sql = "SELECT jawaban FROM faq_chatbot WHERE ? LIKE CONCAT('%', keyword, '%') LIMIT 1";
        $query = $this->db->query($sql, array($pesan));

        if ($query->num_rows() > 0) {
            $balasan = $query->row()->jawaban;
        } else {
            $balasan = "Maaf Kak, Asisten DuaPutra belum paham maksudnya. 😅<br><br>Ketik <b>'stok'</b>, <b>'harga'</b>, <b>'varietas'</b> atau tanya seputar <b>'ongkir'</b> ya! 🌱";
        }
    }

    echo json_encode(['balasan' => $balasan]);
}
}
?>