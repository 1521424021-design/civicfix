<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Warga - Sistem Kendali Pengaduan CivicFix
 * Fokus: Manajemen Alur Kirim Laporan & Tracking Status Aduan Masyarakat
 */
class Warga extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Meload library dan helper yang diperlukan
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'text']);
        
        // Memuat Laporan_model agar tidak memicu error "Undefined property"
        $this->load->model('Laporan_model');
        
        // GUARD SECURITY: Pastikan user sudah login dan role-nya benar-benar Warga
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') !== 'Warga') {
            $this->session->set_flashdata('error', 'Akses Ditolak! Anda harus login sebagai Warga.');
            redirect('auth');
        }
    }

    /**
     * Halaman Utama / Dashboard Warga
     */
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = "Dashboard Warga - CivicFix";
        
        $this->db->where('user_id', $user_id);
        $data['laporan_saya'] = $this->db->get('laporan')->result();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/dashboard', $data);
        $this->load->view('layout/footer', $data);
    }

    /**
     * Halaman Formulir Pengaduan Infrastruktur Baru
     */
    public function kirim_laporan() {
        $data['title'] = "Buat Laporan Baru - CivicFix";
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/kirim_laporan', $data);
        $this->load->view('layout/footer', $data);
    }

    /**
     * Handler Proses Simpan Laporan Baru (Upload Foto & GPS Lock SIG)
     */
    public function proses_simpan_laporan() {
        $user_id = $this->session->userdata('user_id');

        // Konfigurasi Jalur Absolut Folder Upload
        $path = FCPATH . 'uploads/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']   = $path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // Max 2MB
        $config['file_name']     = 'LPR-' . time() . '-' . rand(100, 999);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $error_msg = $this->upload->display_errors('', '');
            $this->session->set_flashdata('error', 'Gagal Mengunggah Berkas: ' . $error_msg);
            redirect('warga/kirim_laporan');
        } else {
            $upload_data = $this->upload->data();
            $nama_foto   = $upload_data['file_name'];

            // Tangkap koordinat pecahan dari klik map SIG
            $latitude  = $this->input->post('lat', TRUE);
            $longitude = $this->input->post('lng', TRUE);
            $koordinat_gabungan = $latitude . ',' . $longitude;

            $input_tipe = $this->input->post('tipe_kerusakan', TRUE);

            // Payload array pengisian data laporan (Double Safe Column Match)
            $data_laporan = [
                'user_id'         => $user_id,
                'tipe_kerusakan'  => $input_tipe, // Masuk ke kolom tipe_kerusakan
                'judul'           => $input_tipe, // Masuk juga ke kolom judul sebagai pengaman
                'deskripsi'       => $this->input->post('deskripsi', TRUE),
                'foto'            => $nama_foto,
                'koordinat_gps'   => $koordinat_gabungan,
                'latitude'        => $latitude,  
                'longitude'       => $longitude, 
                'status'          => 'Pending',  
                'tanggal'         => date('Y-m-d H:i:s')
            ];

            // Eksekusi insert via Laporan_model
            $insert = $this->Laporan_model->simpan_laporan($data_laporan);

            if ($insert) {
                $this->session->set_flashdata('success', 'Laporan aduan infrastruktur Anda berhasil dikirim ke pusat kendali CivicFix!');
                redirect('warga/laporan_saya');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data laporan ke dalam database.');
                redirect('warga/kirim_laporan');
            }
        }
    }

    /**
     * Halaman Berkas Riwayat Aduan Milik Warga yang Sedang Login
     */
    public function laporan_saya() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = "Berkas Aduan Saya";
        
        $this->db->where('user_id', $user_id);
        $this->db->order_by('tanggal', 'DESC');
        $data['laporan_saya'] = $this->db->get('laporan')->result();
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/laporan_saya', $data);
        $this->load->view('layout/footer', $data);
    }

    /**
     * Halaman Profil Akun Warga
     */
    public function profil() {
        $data['title'] = "Profil Saya - CivicFix";
        $user_id = $this->session->userdata('user_id');
        
        $data['user'] = $this->db->get_where('users', ['user_id' => $user_id])->row();

        $this->db->where('user_id', $user_id);
        $data['laporan_saya'] = $this->db->get('laporan')->result();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/profil', $data);
        $this->load->view('layout/footer', $data);
    }
}