<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Laporan - CivicFix Pusat Data Terpadu
 * Fokus: Manajemen Kueri CRUD Laporan Infrastruktur Gorontalo (Admin, Petugas, & Warga)
 */
class Laporan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Meload library database secara otomatis demi kelancaran kueri SIG
        $this->load->database();
    }

    /**
     * Mengambil semua data laporan beserta nama warga pelapor (Join)
     * Digunakan oleh Dashboard Monitoring Admin & Radar Petugas
     */
    public function get_semua_laporan($status = null) {
        $this->db->select('laporan.*, users.nama as nama_warga, users.email');
        $this->db->from('laporan');
        $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
        
        // SQA Environment Guard: Jika ada filter status yang dipilih (Pending/Terverifikasi/Selesai)
        if ($status != null) {
            $this->db->where('laporan.status', $status);
        }
        
        $this->db->order_by('laporan.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Mengambil detail laporan spesifik berdasarkan ID
     * Digunakan oleh halaman Verifikasi Aduan & Update Progres Petugas
     */
    public function get_laporan_detail($laporan_id) {
        $this->db->select('laporan.*, users.nama as nama_warga, users.nik, users.email');
        $this->db->from('laporan');
        $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
        $this->db->where('laporan.laporan_id', $laporan_id);
        
        return $this->db->get()->row();
    }

    /**
     * [KRUSIAL] Menyimpan laporan pengaduan baru dari portal warga
     * Berfungsi memproses input form koordinat SIG, deskripsi, dan berkas foto
     */
    public function simpan_laporan($data) {
        return $this->db->insert('laporan', $data);
    }

    /**
     * Memperbarui data, memo tanggapan, atau status alur laporan (Admin & Petugas)
     * Digunakan di fungsi admin/verifikasi dan petugas/update_progres
     */
    public function update_laporan($laporan_id, $data) {
        $this->db->where('laporan_id', $laporan_id);
        return $this->db->update('laporan', $data);
    }

    /**
     * Menghapus data laporan secara permanen dari database
     * Digunakan oleh fungsi html_hapus_laporan di Panel Kendali Admin
     */
    public function hapus_laporan($laporan_id) {
        $this->db->where('laporan_id', $laporan_id);
        return $this->db->delete('laporan');
    }

    /**
     * Menghitung total data berdasarkan status tertentu untuk keperluan metrik statistik card
     */
    public function hitung_berdasarkan_status($status = null) {
        $this->db->from('laporan');
        if ($status != null) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results();
    }
}