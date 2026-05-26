<?php
defined('BASEPATH') OR exit('No direct script call allowed');

/**
 * User_model - Manajemen Otentikasi & Data Pengguna
 * Mengelola sinkronisasi sesi antar role (Warga, Admin, Petugas)
 */
class User_model extends CI_Model {

    /**
     * Sesuai Class Diagram: User (Base Class)
     * Menggunakan password_verify untuk keamanan tingkat tinggi
     */
    public function authenticate($email, $password) {
        // 1. Cari user berdasarkan email saja
        $this->db->where('email', trim($email));
        $user = $this->db->get('users')->row();

        // 2. Jika user ditemukan, cek apakah password cocok dengan hash di DB
        if ($user) {
            // Jika kamu belum pakai hash di DB (masih teks biasa), 
            // gunakan: if ($password == $user->password)
            // Tapi jika sudah pakai register_warga di bawah, gunakan:
            if (password_verify($password, $user->password) || $password == $user->password) {
                return $user;
            }
        }
        return FALSE;
    }

    /**
     * Registrasi Warga Baru
     * Menyimpan data dengan enkripsi password standar industri
     */
    public function register_warga($data) {
        // Enkripsi agar password tidak bisa dibaca admin via phpMyAdmin
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $data);
    }

    /**
     * Sinkronisasi Session: Memetakan hak akses ke sistem
     */
    public function set_user_session($user) {
        $session_data = [
            'user_id'   => $user->user_id,
            'nama'      => $user->nama,
            'email'     => $user->email,
            'role'      => $user->role,
            'logged_in' => TRUE
        ];

        // Penanganan ID spesifik untuk kebutuhan laporan per instansi
        if ($user->role == 'Admin') {
            $session_data['admin_id'] = $user->user_id;
        } elseif ($user->role == 'Petugas') {
            // Pastikan kolom id_dinas ada di tabel users jika ingin digunakan
            $session_data['id_dinas'] = isset($user->id_dinas) ? $user->id_dinas : null;
        }

        $this->session->set_userdata($session_data);
    }

    /**
     * Mengambil detail profil user
     */
    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['user_id' => $id])->row();
    }
}