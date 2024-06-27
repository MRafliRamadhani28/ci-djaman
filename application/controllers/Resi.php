<?php
    class Resi extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url'); 
            $this->load->model('ResiModel');
            $this->load->library('session');
            $this->load->library('table');
        }

        public function tampilResi(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'resi';
            $data['data_resi'] = $this->ResiModel->getResiPerTransaksi();
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-resi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
            $this->load->view("admin/modal/modal-hapus-resi", $data);
        }

        public function tambahResi(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'resi';
            $data['resi'] = $this->ResiModel->getTransaksi();
            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/input/input-resi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
        }

        public function simpanResi(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $no_resi = $this->input->post('no_resi');
            $kode_transaksis = $this->input->post('kode_transaksi');

            if ($kode_transaksis == null || $no_resi == null) {
                $this->session->set_flashdata('error', 'Data Resi gagal ditambahkan.');
                redirect('Resi/tambahResi');
            }

            $kode_transaksis = explode('-', $kode_transaksis);
            $kode_transaksi  = $kode_transaksis[0];
            $pembeli         = $kode_transaksis[1];

            $data = array(
                'no_resi'       => $no_resi,
                'transaksi_id'  => $kode_transaksi,
                'pengguna_id'   => $pembeli
            );

            $result = $this->db->insert('resi', $data);
            if ($result) {
                $this->session->set_flashdata('success', 'Data Resi berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Data Resi gagal ditambahkan.');
            }
            redirect('Resi/tampilResi');
        }

        public function editResi($id){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'resi';
            $data['data_resi'] = $this->ResiModel->getResiById($id);
            $data['resi'] = $this->ResiModel->getAllTransaksi($id);

            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/edit/edit-resi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
        }

        public function updateResi($id){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $no_resi = $this->input->post('no_resi');
            $kode_transaksis = $this->input->post('kode_transaksi');

            if ($kode_transaksis == null || $no_resi == null) {
                $this->session->set_flashdata('error', 'Data Resi gagal ditambahkan.');
                redirect('Resi/tambahResi');
            }

            $kode_transaksis = explode('-', $kode_transaksis);
            $kode_transaksi  = $kode_transaksis[0];
            $pembeli         = $kode_transaksis[1];

            $data = array(
                'no_resi'       => $no_resi,
                'transaksi_id'  => $kode_transaksi,
                'pengguna_id'   => $pembeli
            );
            $this->ResiModel->editResi($id, $data);
            $this->session->set_flashdata("success", "Data Resi Berhasil Diperbarui");
            redirect('Resi/tampilResi'); 
        }

        public function hapusResi($id) {
            if (!$this->session->userdata("logged_in")) {
                redirect("Admin/loginPage");
            } elseif ($this->session->userdata("role_id") == 2) {
                redirect("Admin/errorPage");
            }

            $this->db->where('id', $id);
            $this->db->delete('resi');
            $this->session->set_flashdata("success", "Resi berhasil dihapus");

            redirect("Resi/tampilResi");
        }
    }