<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Petugas - CivicFix Unit Reaksi Cepat
 * Fokus: Eksekusi Lapangan, Update Progres, & Dokumentasi Bukti Perbaikan
 */
class Petugas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Proteksi role Petugas
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'Petugas') {
            $this->session->set_flashdata('error', 'Akses Ditolak: Khusus Anggota Satgas URC Lapangan.');
            redirect('auth');
        }

        $this->load->model('Laporan_model');
        $this->load->helper(['text', 'url']);
    }

    /**
     * Dashboard: Daftar Tugas & Statistik Khusus Petugas
     */
    public function dashboard() {
        // 1. Ambil statistik beban kerja lapangan URC
        $data['total_laporan'] = $this->db->where_in('status', ['Terverifikasi', 'Sedang Dikerjakan', 'Selesai'])->from('laporan')->count_all_results();
        $data['total_pending'] = $this->db->where('status', 'Terverifikasi')->from('laporan')->count_all_results();
        $data['total_selesai'] = $this->db->where('status', 'Selesai')->from('laporan')->count_all_results();

        // 2. Query Utama: Memuat identitas pelapor dan email
        $this->db->select('laporan.*, users.nama as nama_warga, users.email');
        $this->db->from('laporan');
        $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
        $this->db->where_in('laporan.status', ['Terverifikasi', 'Sedang Dikerjakan', 'Selesai']);
        $this->db->order_by('laporan.tanggal', 'DESC');
        
        $result = $this->db->get()->result();
        
        $data['tugas_masuk'] = $result;
        $data['semua_laporan'] = $result; 

        $data['title'] = "Panel Tugas Lapangan";

        $this->_render('petugas/dashboard', $data);
    }

    /**
     * Update Progres: Input Tanggapan & Upload Bukti Fisik Selesai SQA
     */
    public function update_progres($laporan_id) {
        $status = $this->input->post('status');
        $tanggapan = $this->input->post('tanggapan_petugas');
        
        // Buat payload array dasar
        $update_payload = [
            'status'            => $status,
            'tanggapan_petugas' => $tanggapan
        ];
        
        // Cek apakah petugas mengunggah foto bukti penyelesaian fisik
        if (!empty($_FILES['foto_bukti']['name'])) {
            
            $path = FCPATH . 'uploads/bukti/';
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);
            } 

            $config['upload_path']   = $path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'SELESAI_LPR_' . $laporan_id . '_' . time();
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config); // Reset state mesin upload
            
            if ($this->upload->do_upload('foto_bukti')) {
                $upload_data = $this->upload->data();
                // Simpan nama file ke kolom database 'foto_bukti_petugas'
                $update_payload['foto_bukti_petugas'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto bukti: ' . $this->upload->display_errors('', ''));
                redirect('petugas/dashboard');
            }
        }

        // Jalankan perintah update ke database lewat query builder terproteksi
        $this->db->where('laporan_id', $laporan_id);
        $update = $this->db->update('laporan', $update_payload);
        
        if ($update) {
            $this->session->set_flashdata('success', 'Manifest data laporan #'.$laporan_id.' berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status ke database.');
        }

        redirect('petugas/dashboard');
    }

    /**
     * Halaman Profil Akun Petugas
     */
    public function profil() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', ['user_id' => $user_id])->row();
        $data['title'] = "Profil Akun Saya";

        $this->_render('petugas/profil', $data);
    }

    /**
     * Helper Private: Render View dengan Layout Terpusat
     */
    private function _render($view, $data = []) {
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }
}