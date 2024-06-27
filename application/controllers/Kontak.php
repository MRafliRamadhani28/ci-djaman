<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('KontakModel');
        $this->load->library('session');
        $this->load->library('table');

        if (!$this->session->userdata('logged_in')) {
            redirect('Admin/loginPage');
        }
    }
    
    public function tampilKontak(){
        $data['active_menu'] = 'data_kontak';
        $data['data_kontak']= $this->KontakModel->getKontak();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-kontak", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);

    }

    public function detailKontak($id_kontak){
        $data['active_menu'] = 'data_kontak';
        $data['data_kontak'] = $this->KontakModel->getKontakById($id_kontak);

        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/detail/detail-kontak", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }

    public function editKontak($id_kontak){
        $data['active_menu'] = 'data_kontak';
        $data['data_kontak']= $this->KontakModel->getKontakById($id_kontak);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/edit/edit-kontak", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }

    public function update($id_kontak){
        $alamat = $this->input->post('alamat');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $maps = $this->input->post('maps');

        // Mengupdate data kontak
        $data = array(
            'id_kontak' => $id_kontak,
            'alamat' => $alamat,
            'phone' => $phone,
            'email' => $email,
            'maps' => $maps
        );
        $this->KontakModel->updateKontak($id_kontak, $data);
        $this->session->set_flashdata('success', 'Data Kontak berhasil diperbarui.');
        redirect('Kontak/detailKontak/KNTK1');
    }
    public function resetKontak($id_kontak){
        $id_kontak = "KNTK1";
        $alamat = "Gang M. Ardjo RT 05 / 03 No. 224, Cimahi Tengah Kota Cimahi";
        $phone = "+62 858 7263 2736";
        $email = "support@djaman.my.id";
        $mapsURL = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.135335059867!2d107.5450692!3d-6.8743837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e446ae9900a9%3A0xe7cc97d88dc6b93f!2sGg.%20M.%20Ardjo%202%2C%20Cimahi%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat%2040525!5e0!3m2!1sid!2sid!4v1677048460433!5m2!1sid!2sid";

        $maps = <<<HTML
        <iframe src="$mapsURL" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        HTML;

        // Mengupdate data kontak
        $data = array(
            'id_kontak' => $id_kontak,
            'alamat' => $alamat,
            'phone' => $phone,
            'email' => $email,
            'maps' => $maps
        );
        $this->KontakModel->updateKontak($id_kontak, $data);
        $this->session->set_flashdata('success', 'Data Kontak berhasil direset.');
        redirect('Kontak/detailKontak/KNTK1');
    }
}