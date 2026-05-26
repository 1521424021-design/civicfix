<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Auth - Gerbang Keamanan Utama CivicFix
 * Fokus: Autentikasi Pengguna, Validasi Password Bcrypt, & Manajemen Sesi (Session)
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memastikan library session, form validation, dan helper terload stabil
        $this->load->library(['session', 'form_validation']);
        $this->load->helper('url');
    }

    /**
     * Halaman Utama: Menampilkan Form Login
     */
    public function index() {
        // SQA Overlap Check: Jika pengguna sudah login, langsung lempar ke dashboard masing-masing
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
        }

        $data['title'] = "Login Pusat Kendali - CivicFix";
        $this->load->view('auth/login', $data);
    }

    /**
     * Handler Proses Autentikasi Login (Validasi Data Form)
     */
    public function proses_login() {
        // SQA Set Rules Validasi Form
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Format email atau password tidak valid.');
            redirect('auth');
        } else {
            $email    = $this->input->post('email', TRUE);
            $password = $this->input->post('password');

            // Ambil data pengguna berdasarkan email
            $user = $this->db->get_where('users', ['email' => $email])->row();

            if ($user) {
                // Verifikasi Password menggunakan Bcrypt standard TRPL
                if (password_verify($password, $user->password)) {
                    
                    // Siapkan payload session data
                    $session_payload = [
                        'user_id'   => $user->user_id,
                        'nama'      => $user->nama,
                        'email'     => $user->email,
                        'role'      => $user->role,
                        'logged_in' => TRUE
                    ];

                    $this->session->set_userdata($session_payload);
                    $this->session->set_flashdata('success', 'Selamat datang kembali, ' . $user->nama . '!');
                    
                    // Alihkan halaman secara cerdas berdasarkan role hak akses
                    $this->_redirect_by_role($user->role);

                } else {
                    $this->session->set_flashdata('error', 'Kata sandi yang Anda masukkan salah.');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Alamat email tidak terdaftar di sistem.');
                redirect('auth');
            }
        }
    }

    /**
     * Menampilkan Halaman Form Registrasi Warga Mandiri
     */
    public function register() {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
        }

        $data['title'] = "Buat Akun Warga Baru - CivicFix";
        $this->load->view('auth/register', $data);
    }

    /**
     * Memproses Pengisian Form Registrasi & Enkripsi Kata Sandi (Bcrypt)
     */
    public function proses_register() {
        $nama     = $this->input->post('nama', TRUE);
        $nik      = $this->input->post('nik', TRUE);
        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password');

        // SQA Integrity Guard: Periksa apakah email yang diketik sudah terdaftar sebelumnya
        $cek_email = $this->db->get_where('users', ['email' => $email])->row();
        if ($cek_email) {
            $this->session->set_flashdata('error', 'Gagal! Alamat email tersebut sudah terdaftar di sistem.');
            redirect('auth/register');
        }

        // Amankan password menggunakan standard Bcrypt
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $data_warga_baru = [
            'nama'     => $nama,
            'nik'      => $nik,
            'email'    => $email,
            'password' => $password_hashed,
            'role'     => 'Warga'
        ];

        $insert = $this->db->insert('users', $data_warga_baru);

        if ($insert) {
            $this->session->set_flashdata('success', 'Registrasi sukses! Silakan login menggunakan akun baru Anda.');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan internal saat menyimpan data.');
            redirect('auth/register');
        }
    }

    /**
     * Handler Fungsi Logout (Hancurkan Sesi Keamanan)
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    /**
     * Helper Private: Mengalihkan Dashboard Secara Otomatis Berdasarkan Role
     */
    private function _redirect_by_role($role) {
        switch ($role) {
            case 'Admin':
                redirect('admin/dashboard');
                break;
            case 'Petugas':
                redirect('petugas/dashboard');
                break;
            case 'Warga':
                // NORMALISASI: Langsung arahkan ke URL bersih http://localhost/civicfix/warga
                redirect('warga');
                break;
            default:
                $this->session->sess_destroy();
                redirect('auth');
                break;
        }
    }
} // <-- Ini adalah kurung penutup class utama yang tadi hilang/kurang