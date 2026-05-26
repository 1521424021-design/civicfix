<?php
defined('BASEPATH') OR exit('No direct script call allowed');

/**
 * Dinas_model - Mengelola data instansi terkait
 * Digunakan untuk klasifikasi laporan (Misal: Dinas PU, Dishub, dll)
 */
class Dinas_model extends CI_Model {

    /**
     * Mengambil semua data dinas untuk dropdown atau list
     */
    public function get_dinas() {
        return $this->db->get('dinas')->result();
    }

    /**
     * Mengambil detail dinas berdasarkan ID
     */
    public function get_dinas_by_id($id) {
        return $this->db->get_where('dinas', ['dinas_id' => $id])->row();
    }

    /**
     * SQA: Menghitung jumlah dinas yang terintegrasi dengan CivicFix
     */
    public function count_dinas() {
        return $this->db->count_all('dinas');
    }
}