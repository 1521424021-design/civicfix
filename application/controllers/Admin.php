<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Admin - CivicFix Professional System
 * Fokus: Manajemen Data Master, Verifikasi Laporan, & Monitoring Sistem
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Proteksi Global: Menggunakan Helper Session Terpusat
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'Admin') {
            $this->session->set_flashdata('error', 'Akses Terbatas: Administrator Only.');
            redirect('auth');
        }

        $this->load->model('Laporan_model');
        $this->load->helper(['text', 'url', 'file']); 
    }

    /**
     * Dashboard: Monitoring Statistik & Filter Aduan HD
     */
    public function dashboard($status = null) {
        // 1. Ambil Statistik Ringkasan (Untuk Card di Dashboard)
        $data['total_laporan'] = $this->db->count_all('laporan');
        $data['total_pending'] = $this->db->where('status', 'Pending')->from('laporan')->count_all_results();
        $data['total_selesai'] = $this->db->where('status', 'Selesai')->from('laporan')->count_all_results();

        // 2. Query Utama dengan Join User
        $this->db->select('laporan.*, users.nama as nama_warga, users.email');
        $this->db->from('laporan');
        $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
        
        if ($status) {
            $this->db->where('laporan.status', urldecode($status));
        }
        
        $this->db->order_by('laporan.tanggal', 'DESC');
        $data['semua_laporan'] = $this->db->get()->result();
        
        $data['title'] = "Panel Monitoring Admin";
        $data['status_aktif'] = $status;

        $this->_render('admin/dashboard', $data);
    }

    /**
     * Eksekusi Verifikasi Cepat (Terima/Tolak via URL Dropdown)
     * DISATUKAN & Dilengkapi validasi SQA Hardening
     */
    public function verifikasi($id = null, $status = null) {
        // SQA Guard: Pastikan parameter tidak kosong
        if ($id == null || $status == null) {
            $this->session->set_flashdata('error', 'Parameter eksekusi tidak lengkap.');
            redirect('admin/dashboard');
        }

        $status_decoded = urldecode($status);
        $status_valid = ['Pending', 'Terverifikasi', 'Sedang Dikerjakan', 'Ditolak', 'Selesai'];

        // Basis Path Guard: Validasi integritas status input
        if (!in_array($status_decoded, $status_valid)) {
            $this->session->set_flashdata('error', 'Aksi ilegal! Status tidak terdaftar di sistem.');
            redirect('admin/dashboard');
        }

        // Cek Eksistensi: Pastikan data laporan memang ada di DB
        $laporan = $this->db->get_where('laporan', ['laporan_id' => $id])->row();
        if (!$laporan) {
            $this->session->set_flashdata('error', 'Data laporan tidak ditemukan.');
            redirect('admin/dashboard');
        }

        // Eksekusi Update Status
        $this->db->where('laporan_id', $id);
        $update = $this->db->update('laporan', ['status' => $status_decoded]);

        if ($update) {
            $this->session->set_flashdata('success', 'Status laporan #' . $id . ' berhasil diubah menjadi ' . $status_decoded);
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status laporan.');
        }

        redirect('admin/dashboard');
    }

    /**
     * Halaman Manajemen Pengguna (Menampilkan Data ke View)
     */
    public function manajemen_user() {
        $data['title'] = "Manajemen Pengguna Sistem";
        
        // Ambil data user keculi admin yang sedang login untuk kontrol SQA
        $data['all_users'] = $this->db->where('user_id !=', $this->session->userdata('user_id'))
                                      ->order_by('role', 'ASC')
                                      ->get('users')
                                      ->result();

        $this->_render('admin/manajemen_user', $data);
    }

    /**
     * Proses Tambah Pengguna Baru (Handler Form Modal)
     */
    public function proses_tambah_user() {
        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', TRUE);
        $nik = $this->input->post('nik', TRUE);
        $password = $this->input->post('password');
        $role = $this->input->post('role', TRUE);

        // Validasi Duplikasi Email (SQA Integrity Check)
        $cek_email = $this->db->get_where('users', ['email' => $email])->row();
        if ($cek_email) {
            $this->session->set_flashdata('error', 'Gagal! Alamat email sudah terdaftar di sistem.');
            redirect('admin/manajemen_user');
        }

        // Amankan Password dengan Algoritma Bcrypt standard TRPL
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $data_user = [
            'nama' => $nama,
            'email' => $email,
            'nik' => !empty($nik) ? $nik : null,
            'password' => $password_hashed,
            'role' => $role
        ];

        $insert = $this->db->insert('users', $data_user);

        if ($insert) {
            $this->session->set_flashdata('success', 'Pengguna baru ber-role ' . $role . ' berhasil didaftarkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghemat data pengguna baru.');
        }

        redirect('admin/manajemen_user');
    }

    /**
     * Hapus Laporan & Bersihkan Storage (SQA)
     */
    public function hapus_laporan($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('error', 'ID Laporan tidak ditentukan.');
            redirect('admin/dashboard');
        }

        $laporan = $this->db->get_where('laporan', ['laporan_id' => $id])->row();
        
        if ($laporan) {
            // Hapus File Fisik di hosting agar tidak memenuhi server local
            if (!empty($laporan->foto)) {
                @unlink(FCPATH . 'uploads/' . $laporan->foto);
            }
            if (!empty($laporan->foto_bukti_petugas)) {
                @unlink(FCPATH . 'uploads/bukti/' . $laporan->foto_bukti_petugas);
            }
            
            $this->db->delete('laporan', ['laporan_id' => $id]);
            $this->session->set_flashdata('success', 'Laporan dan berkas dokumentasi fisik berhasil dihapus permanen.');
        } else {
            $this->session->set_flashdata('error', 'Laporan tidak ditemukan atau sudah dihapus.');
        }
        redirect('admin/dashboard');
    }

    /**
     * Alias route untuk hapus laporan dari anchor link
     */
    public function html_hapus_laporan($id = null) {
        $this->hapus_laporan($id);
    }

    /**
     * Hapus Pengguna Permanen (Proteksi Diri Admin)
     */
    public function hapus_user($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('error', 'ID Pengguna tidak ditentukan.');
            redirect('admin/manajemen_user');
        }

        // SQA Guard: Cek apakah ID yang akan dihapus adalah ID admin yang sedang login
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tindakan ilegal! Anda tidak bisa menghapus akun Anda sendiri.');
            redirect('admin/manajemen_user');
        }

        $this->db->where('user_id', $id);
        $delete = $this->db->delete('users');

        if ($delete) {
            $this->session->set_flashdata('success', 'Akun pengguna berhasil dihapus dari sistem secara permanen.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengguna.');
        }

        redirect('admin/manajemen_user');
    }

    /**
     * Cetak: Report Layout Professional
     */
    public function cetak() {
        $this->db->select('laporan.*, users.nama as nama_warga');
        $this->db->from('laporan');
        $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
        $data['semua_laporan'] = $this->db->get()->result();
        
        $data['title'] = "Laporan Rekapitulasi CivicFix Gorontalo";
        $this->load->view('admin/cetak_laporan', $data);
    }

    /**
     * Halaman Profil Administrator Utama
     */
    public function profil() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', ['user_id' => $user_id])->row();
        
        // Statistik Tambahan untuk memperlengkap Profil Admin
        $data['total_verifikasi'] = $this->db->where('status !=', 'Pending')->from('laporan')->count_all_results();
        $data['total_user'] = $this->db->count_all('users');
        
        $data['title'] = "Profil Administrator Utama";
        $this->_render('admin/profil', $data);
    }

    /**
     * Helper Private: Merapikan struktur view (Estetika Kode MVC)
     */
    private function _render($view, $data = []) {
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }
}