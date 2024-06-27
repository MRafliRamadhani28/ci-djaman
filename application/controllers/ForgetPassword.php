<?php
use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ForgetPassword extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('ProfileModel');
        $this->load->library('encryption'); // Load library enkripsi
        $this->load->library('session');
        $this->load->library('table');
    }

    public function index() {
        $this->load->view("admin/forget-password");
    }

    public function pembeli() {
        $this->load->view("forget-password");
    }

    public function gantiPasswordByEmail() {
        
        $email = $this->input->post('email');
        
        $existing_profile = $this->ProfileModel->getProfileByEmail($email);
        if($existing_profile){
            // Generate token
            $token = bin2hex(random_bytes(32)); // Buat token acak
            $encrypted_token = $this->encryption->encrypt($token); // Enkripsi token
            
            // Simpan token ke database dengan email sebagai kunci
            $data = array(
                'email' => $email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s', strtotime('now'))
            );
            $this->ProfileModel->insertToken($data);
            // Kirim email dengan token ke alamat email pengguna
            $this->load->library("email");
            $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
            $this->email->from("support@djaman.my.id", "Reset Password Admin Djaman");
            $this->email->to($email);
            $this->email->subject('Reset Password');
            $this->email->message('Klik tautan berikut untuk mereset password Anda (berlaku selama 15 menit): <a href="'.site_url('ForgetPassword/tampilInputToken/' . $token).'"> Ganti Password</a>');
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Email dengan tautan reset password telah dikirim.');
                redirect('ForgetPassword');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim email reset password.');
                redirect('ForgetPassword');
            }

        }else{
            $this->session->set_flashdata('error', 'Email Tidak Ditemukan.');
            redirect('ForgetPassword');

        }
    }

    public function gantiPasswordByEmailPembeli() {
        $email = $this->input->post('email');
        
        $existing_profile = $this->ProfileModel->getProfileByEmailPembeli($email);
        if($existing_profile){
            // Generate token
            $token = bin2hex(random_bytes(32)); // Buat token acak
            $encrypted_token = $this->encryption->encrypt($token); // Enkripsi token
            
            // Simpan token ke database dengan email sebagai kunci
            $data = array(
                'email' => $email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s', strtotime('now'))
            );
            $this->ProfileModel->insertToken($data);
            // Kirim email dengan token ke alamat email pengguna
            $this->load->library("email");
            $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
            $this->email->from("support@djaman.my.id", "Reset Password User Pembeli Djaman");
            $this->email->to($email);
            $this->email->subject('Reset Password');
            $this->email->message('Klik tautan berikut untuk mereset password Anda (berlaku selama 15 menit): <a href="'.site_url('ForgetPassword/tampilInputTokenPembeli/' . $token).'"> Ganti Password</a>');
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Email dengan tautan reset password telah dikirim.');
                redirect('ForgetPassword');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim email reset password.');
                redirect('ForgetPassword');
            }

        } else {
            $this->session->set_flashdata('error', 'Email Tidak Ditemukan.');
            redirect('ForgetPassword');

        }
    }

    public function tampilInputToken($token) {
        $data['data_token']= $this->ProfileModel->findTokenByToken($token);

        // Tampilkan halaman untuk pengguna memasukkan token
        $this->load->view('admin/input/input-token-reset', $data);
    }

    public function tampilInputTokenPembeli($token) {
        $data['data_token']= $this->ProfileModel->findTokenByToken($token);

        // Tampilkan halaman untuk pengguna memasukkan token
        $this->load->view('input-token-reset', $data);
    }

    public function resetPassword() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $token = $this->input->post('token');
    
        // Cek apakah token valid
        $isTokenValid = $this->ProfileModel->findTokenByToken($token);
    
        if (!$isTokenValid) {
            // Token tidak valid, tampilkan pesan error
            $this->session->set_flashdata('error', 'Reset Password Gagal: Token tidak valid');
            redirect('Admin/loginPage');
        }
    
        // Cek apakah token telah kadaluwarsa
        $currentTime = time();
        $createdTime = strtotime($isTokenValid->created_at);
        $expirationTime = $createdTime + (15 * 60);
    
        if ($currentTime >= $expirationTime) {
            $this->session->set_flashdata('error', 'Reset Password Gagal: Token telah kadaluwarsa');
            redirect('ForgetPassword/tampilInputToken');
        }
    
        // Token valid dan masih berlaku, lanjutkan proses penggantian kata sandi
        $data['password'] = md5($password); // Gunakan md5 dengan hati-hati, pertimbangkan penggunaan hashing yang lebih aman
        
        $this->ProfileModel->updateProfileByEmail($email, $data);   
        $this->ProfileModel->deleteToken($email);
    
        // Set pesan sukses
        $this->session->set_flashdata('success', 'Reset Password Berhasil! Silahkan Login');
        redirect('Admin/loginPage');
    }

    public function resetPasswordPembeli() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $token      = $this->input->post('token');
    
        // Cek apakah token valid
        $isTokenValid = $this->ProfileModel->findTokenByToken($token);
    
        if (!$isTokenValid) {
            // Token tidak valid, tampilkan pesan error
            $this->session->set_flashdata('error', 'Reset Password Gagal: Token tidak valid');
            redirect('Home/loginPage');
        }
    
        // Cek apakah token telah kadaluwarsa
        $currentTime = time();
        $createdTime = strtotime($isTokenValid->created_at);
        $expirationTime = $createdTime + (15 * 60);
    
        if ($currentTime >= $expirationTime) {
            $this->session->set_flashdata('error', 'Reset Password Gagal: Token telah kadaluwarsa');
            redirect('ForgetPassword/tampilInputTokenPembeli');
        }
    
        // Token valid dan masih berlaku, lanjutkan proses penggantian kata sandi
        $data['password'] = md5($password); // Gunakan md5 dengan hati-hati, pertimbangkan penggunaan hashing yang lebih aman
        
        $this->ProfileModel->updateProfileByEmailPembeli($email, $data);   
        $this->ProfileModel->deleteToken($email);
    
        // Set pesan sukses
        $this->session->set_flashdata('success', 'Reset Password Berhasil! Silahkan Login');
        redirect('Home/loginPage');
    }

    public function hapusEmail($email) {
        // Panggil fungsi model untuk menghapus email
        $result = $this->AsknsugestModel->hapusEmail($email);

        if ($result) {
            $this->session->set_flashdata('success', 'Email berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Email tidak ditemukan atau gagal dihapus.');
        }

        redirect('Asknsugest/tampilDataEmail'); // Ganti dengan URL tampilan email yang sesuai
    }   
}