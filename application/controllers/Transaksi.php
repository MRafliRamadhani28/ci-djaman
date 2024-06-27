<?php
    class Transaksi extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url'); 
            $this->load->model('UserModel');
            $this->load->model('TransaksiModel');
            $this->load->library('session');
            $this->load->library('table');
            
        }

        // Terkait Pengelolaan Transaksi
        public function tampilDataTransaksi(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_transaksi';
            $data['data_transaksi']= $this->db->query(
                "SELECT transaksi.*, pengguna.nama, pengguna.alamat, rekening.nama_rekening, rekening.no_rekening, rekening.bank FROM transaksi 
                JOIN pengguna ON pengguna.id=transaksi.pengguna_id
                JOIN rekening ON rekening.id=transaksi.rekening_id
                WHERE transaksi.status != 'Keranjang' AND transaksi.status != 'Selesai' AND transaksi.status != 'Ditolak'
                ORDER BY id DESC")->result();
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-transaksi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
            $this->load->view("admin/modal/modal-blokir", $data);

        }

        // Terkait Pengelolaan Transaksi
        public function riwayatDataTransaksi(){
            $adminId = $this->session->userdata('id');
            if ($this->session->userdata('role_id') == 1) {
                $data['data_transaksi']= $this->db->query(
                    "SELECT transaksi.*, pengguna.nama, pengguna.alamat, rekening.nama_rekening, rekening.no_rekening, rekening.bank FROM transaksi 
                    JOIN rekening ON rekening.id=transaksi.rekening_id
                    JOIN pengguna ON pengguna.id=transaksi.pengguna_id
                    WHERE transaksi.status = 'Selesai' OR transaksi.status = 'Ditolak'
                    ORDER BY id DESC")->result();
            } else if ($this->session->userdata('role_id') == 2){
                $data['data_transaksi']= $this->db->query(
                    "SELECT transaksi.*, pengguna.nama, pengguna.alamat, rekening.nama_rekening, rekening.no_rekening, rekening.bank FROM transaksi 
                    JOIN rekening ON rekening.id=transaksi.rekening_id
                    JOIN pengguna ON pengguna.id=transaksi.pengguna_id
                    JOIN detail_transaksi ON detail_transaksi.transaksi_id=transaksi.id
                    JOIN data_produk ON data_produk.id=detail_transaksi.produk_id
                    LEFT JOIN admin AS penjual ON data_produk.created_by=penjual.id
                    WHERE (transaksi.status = 'Selesai' OR transaksi.status = 'Ditolak') AND
                    penjual.id = $adminId
                    ORDER BY id DESC")->result();
            }
            $data['active_menu'] = 'data_transaksi_riwayat';
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-transaksi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
            $this->load->view("admin/modal/modal-blokir", $data);

        }

        public function detailTransaksi($kode_transaksi){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_transaksi';
            $data['transaksi'] = $transaksi = $this->db->query(
                    "SELECT 
                        transaksi.*,
                        rekening.no_rekening, 
                        rekening.nama_rekening, 
                        rekening.bank 
                    FROM transaksi 
                    JOIN rekening ON rekening.id=transaksi.rekening_id
                    WHERE 
                    kode_transaksi = '$kode_transaksi'
                ")->row();
            $data['detail_transaksi']= $this->db->query(
                    "SELECT 
                        detail_transaksi.*,
                        data_produk.nama_jamu,
                        data_produk.harga 
                    FROM detail_transaksi 
                    JOIN data_produk ON data_produk.id=detail_transaksi.produk_id
                    WHERE 
                    transaksi_id = '$transaksi->id'
                ")->result();

            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/detail/detail-transaksi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);

        }
        
        public function searchTransaksi(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_transaksi';
            $keyword = $this->input->get('keyword'); // Mendapatkan keyword pencarian dari input GET
            $data['data_transaksi']= $this->db->query(
                "SELECT 
                    transaksi.*, 
                    rekening.nama_rekening, 
                    rekening.no_rekening, 
                    rekening.bank 
                FROM transaksi 
                JOIN rekening ON rekening.id=transaksi.rekening_id
                WHERE status != 'Keranjang' 
                AND kode_transaksi LIKE '%$keyword%'
                OR total_pembayaran LIKE '%$keyword%' 
                OR status LIKE '%$keyword%' 
                OR rekening.nama_rekening LIKE '%$keyword%' 
                OR rekening.no_rekening LIKE '%$keyword%' 
                OR rekening.bank LIKE '%$keyword%' 
                ORDER BY id DESC")->result();

            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-transaksi", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);

        }

        // Terkait Rekening
        public function tampilDataRekening(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_rekening';
            $data['data_rekening'] = $this->db->query("SELECT * FROM rekening ORDER BY id DESC")->result();
            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-rekening", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
            $this->load->view("admin/modal/modal-hapus-rekening", $data);
        }
        public function tambahRekening(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_rekening';
            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/input/input-rekening", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
        }
        public function simpanRekening(){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $nama_rekening = $this->input->post('nama_rekening');
            $no_rekening = $this->input->post('no_rekening');
            $bank = $this->input->post('bank');
            $data = array(
                'nama_rekening' => $nama_rekening,
                'no_rekening' => $no_rekening,
                'bank' => $bank,
               );
            $this->db->insert('rekening', $data);
            $this->session->set_flashdata("success", "Data Rekening Berhasil disimpan.");
            redirect('Transaksi/tampilDataRekening'); 
        }
        public function editRekening($id){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            } else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }
            $data['active_menu'] = 'data_rekening';
            $data['data_rekening'] = $this->db->query("SELECT * FROM rekening WHERE id = '$id'")->row();
            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/edit/edit-rekening", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
        }
        public function updateRekening($id){
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $nama_rekening = $this->input->post('nama_rekening');
            $no_rekening = $this->input->post('no_rekening');
            $bank = $this->input->post('bank');
            $data = array(
                'nama_rekening' => $nama_rekening,
                'no_rekening' => $no_rekening,
                'bank' => $bank,
               );
            $this->db->where('id', $id);
            $this->db->update('rekening', $data);
            $this->session->set_flashdata("success", "Data Rekening Berhasil Diperbarui");
            redirect('Transaksi/tampilDataRekening'); 
        }
        public function hapusRekening($id) {
            if (!$this->session->userdata("logged_in")) {
                redirect("Admin/loginPage");
            } elseif ($this->session->userdata("role_id") == 2) {
                redirect("Admin/errorPage");
            }
            // Cek apakah ada relasi dengan tabel transaksi
            $isRelated = $this->db->query("SELECT * FROM transaksi WHERE rekening_id = '$id'")->num_rows();
            if (!$isRelated > 0) {
                // Jika tidak ada relasi, hapus Rekening
                $this->db->where('id', $id);
                $this->db->delete('rekening');
                $this->session->set_flashdata("success", "Rekening berhasil dihapus");
            } else {
                // Jika ada relasi, berikan keterangan
                $this->session->set_flashdata("error", "Rekening tidak dapat dihapus karena ada transaksi yang terkait.");
            }
            redirect("Transaksi/tampilDataRekening");
        }
        public function searchRekening() {
            if (!$this->session->userdata("logged_in")) {
                redirect("Admin/loginPage");
            } elseif ($this->session->userdata("role_id") == 2) {
                redirect("Admin/errorPage");
            }
            $data["active_menu"] = "data_rekening";
            $keyword = $this->input->get("keyword"); // Mendapatkan keyword pencarian dari input GET
            // Lakukan pencarian data berdasarkan keyword
            $this->db->like('no_rekening', $keyword);
            $this->db->or_like('nama_rekening', $keyword);
            $this->db->or_like('bank', $keyword);
            $data["data_rekening"] = $this->db->get('rekening')->result();
            // Tampilkan tampilan (view) dengan hasil pencarian
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/data-rekening", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);
        }

        // proses konfirmasi transaksi
        public function konfirmasiTransaksi($kode_transaksi) {
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $data = array(
                'status' => 'Menunggu Dikirim'
            );
            $this->db->where('kode_transaksi', $kode_transaksi);
            $this->db->update('transaksi', $data);
            redirect('Transaksi/tampilDataTransaksi'); // Ganti dengan halaman yang sesuai
        }

        // proses tolak transaksi
        public function tolakTransaksi($kode_transaksi) {
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $data = array(
                'status' => 'Ditolak'
            );
            $this->db->where('kode_transaksi', $kode_transaksi);
            $this->db->update('transaksi', $data);
            redirect('Transaksi/tampilDataTransaksi'); // Ganti dengan halaman yang sesuai
        }

        // proses kirim transaksi
        public function kirimTransaksi($kode_transaksi) {
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $data = array(
                'status' => 'Dikirim'
            );
            $this->db->where('kode_transaksi', $kode_transaksi);
            $this->db->update('transaksi', $data);
            redirect('Transaksi/tampilDataTransaksi'); // Ganti dengan halaman yang sesuai
        }

        // proses selesai transaksi
        public function selesaiTransaksi($kode_transaksi) {
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }else if ($this->session->userdata('role_id') == 2){
                redirect('Admin/errorPage');
            }

            $data = array(
                'status' => 'Selesai'
            );
            $this->db->where('kode_transaksi', $kode_transaksi);
            $this->db->update('transaksi', $data);
            redirect('Transaksi/tampilDataTransaksi'); // Ganti dengan halaman yang sesuai
        }


        public function search(){
            $keyword = $this->input->get('keyword'); // Mendapatkan keyword pencarian dari input GET
            // Lakukan pencarian data berdasarkan keyword
            $data['data_organisasi'] = $this->OrganisasiModel->searchOrganisasi($keyword);
            $data['data_produk'] = $this->ProdukModel->searchProduk($keyword);
            $data['data_kontak'] = $this->KontakModel->searchKontak($keyword);
            $data['asknsugest'] = $this->AsknsugestModel->searchAsknSugest($keyword);
            $data['data_admin'] = $this->UserModel->searchAdmin($keyword);

            
            
            if (!empty($data['data_produk'])) {
                // Jika ditemukan data organisasi, arahkan ke view data-produk
                $data['active_menu'] = 'data_produk';
                $this->load->view("admin/template/header", $data);
                $this->load->view("admin/data-produk", $data);
                $this->load->view("admin/template/sidebar", $data);
                $this->load->view("admin/template/footer", $data);

            }else if(!empty($data['data_organisasi'])){
                // Jika tidak ditemukan data organisasi, arahkan ke view data-organisasi
                $data['active_menu'] = 'data_organisasi';
                $this->load->view("admin/template/header", $data);
                $this->load->view("admin/data-organisasi", $data);
                $this->load->view("admin/template/sidebar", $data);
                $this->load->view("admin/template/footer", $data);

            }else if(!empty($data['data_kontak'])){
                // Jika tidak ditemukan data organisasi, arahkan ke view data-organisasi
                $data['active_menu'] = 'data_kontak';
                $this->load->view("admin/template/header", $data);
                $this->load->view("admin/data-kontak", $data);
                $this->load->view("admin/template/sidebar", $data);
                $this->load->view("admin/template/footer", $data);

            }else if(!empty($data['asknsugest'])){
                // Jika tidak ditemukan data organisasi, arahkan ke view data-organisasi
                $data['active_menu'] = 'asknsugest';
                $this->load->view("admin/template/header", $data);
                $this->load->view("admin/asknsugest", $data);
                $this->load->view("admin/template/sidebar", $data);
                $this->load->view("admin/template/footer", $data);
            }else if(!empty($data['data_admin']) && $this->session->userdata('role_id') == 1) {
                // Kode yang akan dijalankan jika kondisi terpenuhi
                $data['active_menu'] = 'data_admin';
                $this->load->view("admin/template/header", $data);
                $this->load->view("admin/data-admin", $data);
                $this->load->view("admin/template/sidebar", $data);
                $this->load->view("admin/template/footer", $data);
            } else {
                redirect('Admin/ErrorPage');
            }
        }

        // Halaman Peralihan
        public function errorPage(){
            $this->load->view("admin/error");
        }
        public function MaintainancePage(){
            $this->load->view("admin/maintainance");
            
        }
    }
    
?>