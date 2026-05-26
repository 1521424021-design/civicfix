<?php
defined('BASEPATH') OR exit('No direct script call allowed');

/**
 * Controller Welcome - CivicFix Public Face
 * Menangani tampilan halaman utama sebelum user melakukan autentikasi.
 */
class Welcome extends CI_Controller {

    public function index()
    {
        // Logika Dinamis: Menghitung total laporan untuk ditampilkan di statistik Landing Page
        // Ini akan membuat presentasi kamu lebih meyakinkan karena datanya real-time
        $data['total_laporan'] = $this->db->count_all('laporan');
        $data['total_warga']   = $this->db->where('role', 'Warga')->from('users')->count_all_results();
        
        $data['title'] = "CivicFix - Layanan Pengaduan Infrastruktur Gorontalo";

        // Memanggil file view landing_page.php dengan membawa data statistik
        $this->load->view('landing_page', $data);
        $this->load->helper('text'); 

        // Kode query kamu bawaan sebelumnya...
        $this->load->view('welcome_message'); // atau nama file view landing page-mu
    }
}