<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Fitur_seeder - Alat Bantu Pengisian Data Master (SQA Tools)
 * Hanya dijalankan satu kali untuk membuat akun Admin & Petugas yang valid
 */
class Fitur_seeder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        echo "<h3>CivicFix Account Seeder Activated</h3>";
        echo "<p>Silakan akses URL: <b>" . base_url('fitur_seeder/buat_akun_master') . "</b> untuk menyuntikkan data akun Admin dan Petugas.</p>";
    }

    /**
     * Fungsi Utama: Membuat Akun Admin & Petugas Berbasis Enkripsi Bcrypt
     */
    public function buat_akun_master() {
        // 1. Bersihkan data email lama agar tidak bentrok (Duplikasi Email Guard)
        $this->db->delete('users', ['email' => 'admin@gmail.com']);
        $this->db->delete('users', ['email' => 'petugas@gmail.com']);

        // 2. Enkripsi password menggunakan Bcrypt secara murni lewat kodingan
        $password_admin   = password_hash('admin123', PASSWORD_BCRYPT);
        $password_petugas = password_hash('petugas123', PASSWORD_BCRYPT);

        // 3. Siapkan data Admin Utama
        $data_admin = [
            'nama'     => 'Sofyan Admin',
            'nik'      => '7500000000000001',
            'email'    => 'admin@gmail.com',
            'password' => $password_admin,
            'role'     => 'Admin'
        ];

        // 4. Siapkan data Petugas Lapangan (URC)
        $data_petugas = [
            'nama'     => 'Oyan Petugas',
            'nik'      => '7500000000000002',
            'email'    => 'petugas@gmail.com',
            'password' => $password_petugas,
            'role'     => 'Petugas'
        ];

        // 5. Eksekusi suntik data ke tabel database 'users'
        $insert_admin   = $this->db->insert('users', $data_admin);
        $insert_petugas = $this->db->insert('users', $data_petugas);

        if ($insert_admin && $insert_petugas) {
            echo "<h2>🎉 KEBENTUK 100% SUKSES!</h2>";
            echo "<p>Akun Admin dan Petugas baru yang valid berhasil dimasukkan ke tabel database.</p>";
            echo "<hr>";
            echo "<h4>Kredensial Ruang Kendali Admin:</h4>";
            echo "<ul><li>Email: <b>admin@gmail.com</b></li><li>Password: <b>admin123</b></li></ul>";
            echo "<h4>Kredensial Ruang Kerja Petugas:</h4>";
            echo "<ul><li>Email: <b>petugas@gmail.com</b></li><li>Password: <b>petugas123</b></li></ul>";
            echo "<br><a href='" . base_url('auth') . "'>&larr; Kembali ke Gerbang Login Utama</a>";
        } else {
            echo "<h2 style='color:red;'>Gagal menyuntikkan data akun master ke database.</h2>";
        }
    }
}