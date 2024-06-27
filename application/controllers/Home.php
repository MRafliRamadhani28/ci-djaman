<?php
    class Home extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url'); 
            $this->load->model('AsknsugestModel');
            $this->load->model('ProdukModel');
            $this->load->model('KontakModel');
            $this->load->model('PenggunaModel');
            $this->load->model('TransaksiModel');
            $this->load->model('ProfileModel');
            $this->load->library('encryption'); // Load library enkripsi1
            
            $this->load->library('session');
        }
        public function index(){
            $data['active_menu'] = 'home';
            $data['title'] = 'Jamu Organik dan Terstandarisasi dari Djaman (Jamu Manunggal) Cimahi.';
            $data['meta_description'] = 'Temukan manfaat luar biasa dari jamu segar, organik, dan berstandar laboratorium di Djaman. Jaga kesehatan tubuh dengan cara autentik dan tradisional. elamat berbelanja dan menjaga kesehatan dengan Djaman!';
            $data['meta_url'] = base_url();
            $this->load->model('UserModel');
            $pengguna_id = $this->session->userdata('id');
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }
            // $data['data_produk'] = $this->ProdukModel->getProduk();
            $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();
            $data['data_kontak']= $this->KontakModel->getKontak();
            $data['data_produk_random'] = $this->ProdukModel->getRandomProduk(3); // Contoh: Menampilkan 5 produk secara acak
            $data['data_link'] = $this->UserModel->getLinkEmbed(); 
            foreach ($data['data_produk_random'] as &$produk) {
                $produk->harga = 'Rp. ' . number_format($produk->harga, 0, ',', '.');
            }
            $data['is_diskon_harga'] = $this->ProdukModel->getProdukTerlarisRow1();
            if($data['is_diskon_harga']){            
                $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();

            }

            $data['produk_terlaris']->harga_asli = 'Rp. ' . number_format($data['produk_terlaris']->harga_asli, 0, ',', '.');
            $data['produk_terlaris']->harga_diskon = 'Rp. ' . number_format($data['produk_terlaris']->harga_diskon, 0, ',', '.');

            $this->load->view("header", $data);
            $this->load->view("index_2", $data);
            $this->load->view("footer", $data);
        }

        public function loginPage(){
            $site_key = '6LcuADUoAAAAAAGZpb1eTWPx0GEi4NBt40e-UZqS'; // Ganti dengan Site Key Anda dari reCAPTCHAA
            $data['site_key'] = $site_key;
            $this->load->view("login", $data);
        }

        public function login(){
            // Ambil data Respons Captcha
            $response = $this->input->post('g-recaptcha-response');
            // Validasi reCaptcha Google v2
            if ($response) {
                // reCAPTCHA valid, lanjutkan dengan proses login
                $this->load->model('PenggunaModel');
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                $result = $this->PenggunaModel->login($username, $password);
                if ($result->num_rows() > 0) {
                    $pengguna = $result->row();
                    if ($pengguna->status_aktif === 'Blokir') {
                        $this->session->set_flashdata("error", "Akun Anda terblokir.");
                        redirect('Home/loginPage');
                    } else {
                        $session_data = array(
                            "id" => $pengguna->id,
                            "id_pengguna" => $pengguna->id_pengguna,
                            "nama_lengkap" => $pengguna->nama,
                            "username" => $pengguna->username,
                            "password" => $pengguna->password,
                            "pengguna_logged_in" => true
                        );
                        $this->session->set_userdata($session_data);
                        $this->session->set_userdata('foto', $pengguna->foto);
                        redirect('Home');
                    }
                } else {
                    $this->session->set_flashdata("error", "Username atau Password Salah");
                    redirect('Home/loginPage');
                }
                
            } else{
                // reCAPTCHA tidak valid, tindakan sesuai kebijakan Anda (misalnya, kembali ke halaman login dengan pesan kesalahan)
                $this->session->set_flashdata("error", "Captcha tidak Valid");
                redirect('Home/loginPage'); 
            }
        }

        public function logout(){
            $this->session->sess_destroy();
            $this->session->set_flashdata('success', 'Anda telah berhasil logout.');
            redirect('Home');
        }

        public function registerPage(){
            $site_key = '6LcuADUoAAAAAAGZpb1eTWPx0GEi4NBt40e-UZqS'; // Ganti dengan Site Key Anda dari reCAPTCHAA
            $data['site_key'] = $site_key;
            $this->load->view("register", $data);
        }

        private function incrementPenggunaId($lastAdminID){
            // Ambil angka dari ID Admin terakhir
            $lastNumber = (int) substr($lastAdminID, 3);
    
            // Increment angka
            $nextNumber = $lastNumber + 1;
    
            // Jika angka melebihi 999, kembalikan nilai awal "ADM"
            if ($nextNumber > 999) {
                return 'PGN000';
            }
    
            // Format angka menjadi tiga digit dengan padding nol di depan
            $nextProductID = 'PGN' . sprintf('%03d', $nextNumber);
    
            return $nextProductID;
        }

        public function register() {
            $lastPenggunaID = $this->PenggunaModel->getLastIdPengguna();
            $newPenggunaId = $this->incrementPenggunaId($lastPenggunaID);
        
            // Mendapatkan data input dari form
            $id_pengguna = $newPenggunaId;
            $nama = $this->input->post('nama_lengkap');
            $email = $this->input->post('email');
            $no_telp = $this->input->post('no_telp');
            $kota = $this->input->post('kota');
            $provinsi = $this->input->post('provinsi');
            $alamat = $this->input->post('alamat_lengkap');
            $kode_pos = $this->input->post('kode_pos');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $response = $this->input->post('g-recaptcha-response');

            if ($response) {
                // Memeriksa apakah username sudah digunakan
                if ($this->PenggunaModel->isUsernameExist($username)) {
                    $id_pengguna_exist = $this->PenggunaModel->getPenggunaByUsername($username); // Mengambil ID pengguna yang memiliki username yang sama
                    $this->session->set_flashdata('error', 'Username sudah digunakan Oleh: '.$id_pengguna_exist->nama);
                    redirect('Home/registerPage');
                }
            
                // Upload foto ke folder
                $config['upload_path'] = 'assets/img/pengguna';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 5125;
                $config['file_name'] = $username . '_Avatar';
            
                $this->load->library('upload', $config);
            
                if (!$this->upload->do_upload('foto')) {
                    $data = array(
                        'id_pengguna' => $id_pengguna,
                        'nama' => $nama,
                        'no_telp' => $no_telp,
                        'email' => $email,
                        'kota' => $kota,
                        'provinsi' => $provinsi,
                        'alamat' => $alamat,
                        'kode_pos' => $kode_pos,
                        'username' => $username,
                        'password' => md5($password),
                        'foto' => "pengguna.webp",
                        'status' => "Aktif"
                    );
                    $this->PenggunaModel->simpanDataPengguna($data);
                    $this->session->set_flashdata('success', 'Data Pengguna berhasil disimpan dengan Foto Default.');
                } else {
                    // Mendapatkan path file yang diunggah
                    $file_path = $this->upload->data('full_path');
            
                    // Periksa ekstensi file
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
            
                    if ($file_extension !== 'webp') {
                        // Mengompresi gambar dengan GD
                        list($width, $height) = getimagesize($file_path);
                        $new_width = $width;
                        $new_height = $height;
            
                        $image_p = imagecreatetruecolor($new_width, $new_height);
            
                        switch (exif_imagetype($file_path)) {
                            case IMAGETYPE_JPEG:
                                $image = imagecreatefromjpeg($file_path);
                                break;
                            case IMAGETYPE_PNG:
                                $image = imagecreatefrompng($file_path);
                                break;
                            default:
                                $image = false;
                                break;
                        }
            
                        if ($image) {
                            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                            $webp_file_path = 'assets/img/pengguna/' . $nama . '.webp';
                            imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                            imagedestroy($image_p);
                            imagedestroy($image);
            
                            // Hapus foto asli
                            unlink($file_path);
            
                            $data = array(
                                'id_pengguna' => $id_pengguna,
                                'nama' => $nama,
                                'email' => $email,
                                'username' => $username,
                                'password' => md5($password),
                                'foto' => $nama . '.webp',
                                'status' => "Aktif"
                            );
                            $this->PenggunaModel->simpanDataPengguna($data);
                            $this->session->set_flashdata('success', 'Data Pengguna berhasil disimpan.');
                        }
                    } else {
                        // Jika file sudah dalam format .webp, tidak perlu dikompresi ulang
                        $data = array(
                            'id_pengguna' => $id_pengguna,
                            'nama' => $nama,
                            'email' => $email,
                            'username' => $username,
                            'password' => md5($password),
                            'foto' => $nama . '.webp',
                            'status' => "Aktif"
                        );
                        $this->PenggunaModel->simpanDataPengguna($data);
                        $this->session->set_flashdata('success', 'Data Pengguna berhasil disimpan.');
                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Harap Mengisi Captcha Untuk Mengirim Pertanyaan / Saran');
                redirect('Home/registerPage');
            }
        
            redirect('Home/loginPage');
        }

        private function incrementTransaksiId($lastTransaksiID){
            // Ambil angka dari ID Transaksi terakhir
            $lastNumber = (int) substr($lastTransaksiID, 3);
    
            // Increment angka
            $nextNumber = $lastNumber + 1;
    
            // Jika angka melebihi 999, kembalikan nilai awal "ADM"
            if ($nextNumber > 999) {
                return 'TRS000';
            }
    
            // Format angka menjadi tiga digit dengan padding nol di depan
            $nextProductID = 'TRS' . sprintf('%03d', $nextNumber);
    
            return $nextProductID;
        }

        public function cart($produk = null) {
            if (!$this->session->userdata('pengguna_logged_in')) {
                redirect('Home/loginPage');
            }

            $pengguna_id = $this->session->userdata('id');

            if ($produk <> null) {
                
                $cek_transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
    
                $produk_id = $this->input->post('produk_id');
                $harga_produk = $this->input->post('harga_produk');
    
                if ($cek_transaksi->num_rows() > 0) {
                    $cek_transaksi = $cek_transaksi->row();
                    $detailTransaksi = $this->db->query(
                        "SELECT * FROM detail_transaksi 
                        WHERE transaksi_id = '$cek_transaksi->id' AND produk_id = '$produk_id'");
                    if ($detailTransaksi->num_rows() > 0) {
                        $jumlah = $detailTransaksi->row()->jumlah + 1;
                        $harga_produk = $jumlah * $harga_produk;
                        $data_detail = array(
                            'jumlah' => $jumlah,
                            'total' => $harga_produk
                        );
                        $this->db->where('id', $detailTransaksi->row()->id);
                        $this->db->update('detail_transaksi', $data_detail);
                        $this->session->set_flashdata('success', 'Produk berada dikeranjang.');
                        redirect('Home/SingleProduk/'.$produk);
                    } else {
                        $data_detail = array(
                            'transaksi_id' => $cek_transaksi->id,
                            'produk_id' => $produk_id,
                            'jumlah' => 1,
                            'total' => $harga_produk
                        );
                        $this->db->insert('detail_transaksi', $data_detail);
                        $this->session->set_flashdata('success', 'Produk berada dikeranjang.');
                        redirect('Home/SingleProduk/'.$produk);
                    }
                } else {
                    $lastTransaksiID = $this->TransaksiModel->getLastIdTransaksi();
                    $newKodeTransaksi = $this->incrementTransaksiId($lastTransaksiID);
        
                    $kode_transaksi = $newKodeTransaksi;
                    $status = 'Keranjang';
                    $created_at = date('Y-m-d H:i:s');
                    $updated_at = date('Y-m-d H:i:s');
        
                    $data = array(
                        'kode_transaksi' => $kode_transaksi,
                        'pengguna_id' => $pengguna_id,
                        'status' => $status,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at
                    );
                    $simpanTransaksi = $this->TransaksiModel->simpanDataTransaksi($data);
                    $transaksi = $this->TransaksiModel->getTransaksiById($kode_transaksi);
                    $data_detail = array(
                        'transaksi_id' => $transaksi->id,
                        'produk_id' => $produk_id,
                        'jumlah' => 1,
                        'total' => $harga_produk
                    );
                    $this->db->insert('detail_transaksi', $data_detail);
                    $this->session->set_flashdata('success', 'Produk berada dikeranjang.');
                    redirect('Home/SingleProduk/'.$produk);
                }
            } else {
                $data['active_menu'] = 'keranjang';
                $data['title'] =   "Keranjang";
                $data['meta_description'] = "Keranjang";
                $data['meta_url'] = base_url();
                $data['meta_img'] = "";

                $data['data_kontak']= $this->KontakModel->getKontak();
                // Menghapus karakter '+' dan spasi dari nomor telepon
                foreach ($data['data_kontak'] as &$kontak) {
                    $kontak->formated_phone_for_whatsapp = str_replace(['+', ' '], '', $kontak->phone);
                }

                $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
                $data['transaksi'] = $transaksi->row();
                $data['transaksicek'] = $transaksi->num_rows();
                if ($data['transaksicek'] > 0) {
                    $transaksi_id = $transaksi->row()->id;
                    $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
                } else {
                    $data['cart_count'] = 0;
                }

                $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
                $this->db->from('detail_transaksi');
                $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
                if ($transaksi->num_rows() > 0) {
                    $this->db->where('transaksi_id', $transaksi->row()->id);
                }
                $data['detail_transaksi'] = $this->db->get()->result();

                $this->db->select("transaksi.*, rekening.nama_rekening, rekening.no_rekening, rekening.bank");
                $this->db->from('transaksi');
                $this->db->join('rekening', 'rekening.id = transaksi.rekening_id');
                $this->db->where('status', 'Konfirmasi Pembayaran');
                $this->db->or_where('status', 'Menunggu Dikirim');
                $data['transaksi_konfirmasi'] = $this->db->get()->result();

                $this->db->select("transaksi.*, resi.no_resi, rekening.nama_rekening, rekening.no_rekening, rekening.bank");
                $this->db->from('transaksi');
                $this->db->join('rekening', 'rekening.id = transaksi.rekening_id');
                $this->db->join('resi', 'resi.transaksi_id = transaksi.id', 'left');
                $this->db->where('status', 'Dikirim');
                $data['transaksi_dikirim'] = $this->db->get()->result();

                $this->db->select("transaksi.*, rekening.nama_rekening, rekening.no_rekening, rekening.bank");
                $this->db->from('transaksi');
                $this->db->join('rekening', 'rekening.id = transaksi.rekening_id');
                $this->db->where('status', 'Selesai');
                $data['transaksi_selesai'] = $this->db->get()->result();

                $this->db->select("transaksi.*, rekening.nama_rekening, rekening.no_rekening, rekening.bank");
                $this->db->from('transaksi');
                $this->db->join('rekening', 'rekening.id = transaksi.rekening_id');
                $this->db->where('status', 'Ditolak');
                $data['transaksi_ditolak'] = $this->db->get()->result();

                $this->load->view("header", $data);
                $this->load->view("cart", $data);
                $this->load->view("footer", $data);
            }
        }
        public function hapusProdukCart($id) {
            if (!$this->session->userdata("pengguna_logged_in")) {
                redirect("Home/loginPage");
            }

            // Hapus produk di cart
            $this->db->where('id', $id);
            $this->db->delete('detail_transaksi');
            $this->session->set_flashdata("success", "Produk berhasil dihapus");
            redirect("Home/cart");
        }
        public function checkout($kode_transaksi) {
            if (!$this->session->userdata("pengguna_logged_in")) {
                redirect("Home/loginPage");
            }

            $data['active_menu'] = 'checkout';
            $data['title'] =   "Checkout";
            $data['meta_description'] = "Checkout";
            $data['meta_url'] = base_url();
            $data['meta_img'] = "";

            $data['data_kontak']= $this->KontakModel->getKontak();
            // Menghapus karakter '+' dan spasi dari nomor telepon
            foreach ($data['data_kontak'] as &$kontak) {
                $kontak->formated_phone_for_whatsapp = str_replace(['+', ' '], '', $kontak->phone);
            }

            $pengguna_id = $this->session->userdata('id');

            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND kode_transaksi = '$kode_transaksi'");
            
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }

            $this->db->select("detail_transaksi.*, data_produk.nama_jamu, data_produk.foto, data_produk.harga");
            $this->db->from('detail_transaksi');
            $this->db->join('data_produk', 'data_produk.id = detail_transaksi.produk_id');
            $this->db->where('transaksi_id', $transaksi->row()->id);
            $data['detail_transaksi'] = $this->db->get()->result();

            $data['rekening'] = $this->db->query("SELECT * FROM rekening")->result();

            $this->load->view("header", $data);
            $this->load->view("checkout", $data);
            $this->load->view("footer", $data);
        }
        public function pembayaran($kode_transaksi) {
            if (!$this->session->userdata("pengguna_logged_in")) {
                redirect("Home/loginPage");
            }

            $rekening_id = $this->input->post('rekening_id');
            $rekening = $this->db->query("SELECT * FROM rekening WHERE id = '$rekening_id'")->row();
            if ($rekening->no_rekening <> 0) {

                // Upload foto ke folder
                $config["upload_path"] = "assets/img/bukti_pembayaran";
                $config["allowed_types"] = "jpg|jpeg|png|webp"; // Format yang diizinkan
                $config["max_size"] = 5112;
                $config["file_name"] = "bukti-pembayaran-".date('YmdHis');
                $this->load->library("upload", $config);
                // Menampilkan pesan error jika tidak terdapat foto
                if (!$this->upload->do_upload("foto")) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata("error", "Masukkan Bukti Pembayaran untuk melanjutkan proses.");
                    $this->session->set_flashdata("failed", $error);
                    redirect("Home/checkout/".$kode_transaksi);
                } else {
                    $uploaded_data = $this->upload->data();
                    $foto = $uploaded_data["file_name"];
                    // Kompresi gambar jika bukan format .webp
                    $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
                    if ($file_extension !== "webp") {
                        $file_path = "assets/img/bukti_pembayaran/" . $foto;
                        switch (exif_imagetype($file_path)) {
                            case IMAGETYPE_JPEG:
                                $image = imagecreatefromjpeg($file_path);
                            break;
                            case IMAGETYPE_PNG:
                                $image = imagecreatefrompng($file_path);
                            break;
                            default:
                                $image = false;
                            break;
                        }
                        if ($image) {
                            // Mendapatkan dimensi asli gambar
                            list($width, $height) = getimagesize($file_path);
                            // Menentukan dimensi yang diinginkan
                            $new_width = $width;
                            $new_height = $height;
                            // Membuat gambar baru dengan dimensi yang diinginkan
                            $image_p = imagecreatetruecolor($new_width, $new_height);
                            // Mengkopi gambar asli ke gambar baru dengan ukuran yang diinginkan
                            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                            // Menyimpan gambar dalam format .webp
                            $webp_file_path = "assets/img/bukti_pembayaran/" . "bukti-pembayaran-".date('YmdHis') . ".webp";
                            imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                            // Menghapus gambar asli
                            unlink($file_path);
                            $foto = "bukti-pembayaran-".date('YmdHis') . ".webp";
                        }
                    }
                }

                if ($this->input->post('ambil_toko') <> '') {
                    $ambil_toko = 1;
                } else {
                    $ambil_toko = 0;
                }

                // update status transaksi di cart
                $data = array(
                    'status' => 'Konfirmasi Pembayaran',
                    'total_pembayaran' => $this->input->post('total_pembayaran'),
                    'rekening_id' => $this->input->post('rekening_id'),
                    'ambil_toko' => $ambil_toko,
                    'bukti_pembayaran' => $foto
                );
                $this->db->where('kode_transaksi', $kode_transaksi);
                $this->db->update('transaksi', $data);
            
            } else {
                if ($this->input->post('ambil_toko') <> '') {
                    $ambil_toko = 1;
                } else {
                    $ambil_toko = 0;
                }

                // update status transaksi di cart
                $data = array(
                    'status' => 'Konfirmasi Pembayaran',
                    'total_pembayaran' => $this->input->post('total_pembayaran'),
                    'rekening_id' => $this->input->post('rekening_id'),
                    'ambil_toko' => $ambil_toko
                );
                $this->db->where('kode_transaksi', $kode_transaksi);
                $this->db->update('transaksi', $data);
            }

            $this->notifemail($kode_transaksi);

            $this->session->set_flashdata("success", "Transaksi diproses");
            redirect("Home/cart");
        }

        public function notifemail($kode_transaksi){
            
            $data_admin = $this->db->query("SELECT * FROM admin")->result();
            foreach ($data_admin as $row) {
                $this->load->library("email");
                $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
                $this->email->from("support@djaman.my.id", "Transaksi Baru");
                $this->email->to($row->email);
                $this->email->subject('Transaksi Baru');
                $this->email->message('Dengan kode Transaksi '.$kode_transaksi);
                $this->email->send();
            }
        }

        public function SingleProduk($id_produk){
            $data['active_menu'] = 'belanjaSingle';

            $data['data_produk'] = $this->ProdukModel->getProduk();

            $data['data_kontak']= $this->KontakModel->getKontak();
            // Menghapus karakter '+' dan spasi dari nomor telepon
            foreach ($data['data_kontak'] as &$kontak) {
                $kontak->formated_phone_for_whatsapp = str_replace(['+', ' '], '', $kontak->phone);
            }

            $pengguna_id = $this->session->userdata('id');
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }
            
            $data['data_produk_random'] = $this->ProdukModel->getRandomProduk(3); // Contoh: Menampilkan 3 produk secara acak
            foreach ($data['data_produk_random'] as &$produk) {
                $produk->harga = 'Rp. ' . number_format($produk->harga, 0, ',', '.');
            }
        
            $data['single_product'] = $this->ProdukModel->getProdukById($id_produk);
            if (!$data['single_product']) {
                redirect('Home/not_found');
            }
            $data['harga_produk'] = $data['single_product']->harga;
            $data['single_product']->harga = 'Rp. ' . number_format($data['single_product']->harga, 0, ',', '.');
            // Jika produk tidak ditemukan, arahkan ke halaman 404


            $data['title'] =   $data['single_product']->nama_jamu. ' dari Djaman (Jamu Manunggal) Cimahi.';
            $data['meta_description'] = $data['single_product']->deskripsi;
            $data['meta_url'] = base_url(). 'index.php/Home/SingleProduk/'. $id_produk;
            $data['meta_img'] = base_url(). 'assets/img/produk/'. $data['single_product']->foto;
        
            // Periksa apakah produk terdapat dalam tabel produk_terlaris
            $data['is_diskon'] = $this->ProdukModel->isProdukTerlaris($id_produk);
            if($data['is_diskon']){            
                $data['produk_terlaris']= $this->ProdukModel->getProdukTerlarisById($id_produk);
                $data['produk_terlaris']->harga_diskon = 'Rp. ' . number_format($data['produk_terlaris']->harga_diskon, 0, ',', '.');
            }        
            $data['is_diskon_harga'] = $this->ProdukModel->getProdukTerlarisRow1();
            if($data['is_diskon_harga']){            
                $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();
                $data['produk_terlaris']->harga_asli = 'Rp. ' . number_format($data['produk_terlaris']->harga_asli, 0, ',', '.');
                $data['produk_terlaris']->harga_diskon = 'Rp. ' . number_format($data['produk_terlaris']->harga_diskon, 0, ',', '.');
            }

            $this->load->view("header", $data);
            $this->load->view("single-product", $data);
            $this->load->view("footer", $data);

        }
        

        public function TentangKami(){
            $data['title'] = 'Tentang Kami - Djaman';
            $data['meta_description'] = 'Selamat datang di halaman Tentang Kami Djaman. Kami adalah pelopor dalam pembuatan produk herbal tradisional, khususnya Jamu, yang membawa manfaat kesehatan alami kepada masyarakat. Kami melestarikan warisan jamu tradisional Indonesia dengan inovasi sesuai kebutuhan zaman modern.';
            $data['meta_url'] = base_url(). 'index.php/Home/TentangKami';
            
            $data['active_menu'] = 'tentang_kami';

            $pengguna_id = $this->session->userdata('id');
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }

            $this->load->model('OrganisasiModel');
            $data['data_kontak']= $this->KontakModel->getKontak();
            $data['data_organisasi']= $this->OrganisasiModel->getOrganisasi();
            $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();
            $this->load->view("header", $data);
            $this->load->view("about-us", $data);
            $this->load->view("footer", $data);
        }
        public function Belanja(){
            $data['title'] = 'Jamu Tradisional Berkualitas Tinggi dari Djaman (Jamu Manunggal)';
            $data['meta_description'] = 'Selamat datang di halaman belanja Produk Jamu dari Djaman, tempat Anda dapat menemukan berbagai macam jamu tradisional berkualitas tinggi. Temukan manfaat kesehatan alami dengan produk herbal tradisional terbaik dari Djaman. Melestarikan warisan jamu Indonesia dengan inovasi modern.';
            $data['meta_url'] = base_url(). 'index.php/Home/Belanja';
            
            $data['active_menu'] = 'belanja';

            $pengguna_id = $this->session->userdata('id');
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }

            $data['terjual'] = $this->db->query("SELECT produk_id AS id_produk_terjual, SUM(jumlah) AS terjual FROM detail_transaksi GROUP BY produk_id ORDER BY terjual DESC")->result();

            $data['data_produk']= $this->ProdukModel->getProduk();
            $data['kategori_produk']= $this->ProdukModel->getKategoriPenjualProdukArray();
            $data['data_kontak']= $this->KontakModel->getKontak();
            foreach ($data['data_produk'] as &$produk) {
                $produk->harga = 'Rp. ' . number_format($produk->harga, 0, ',', '.');
            }

            // Periksa apakah produk terdapat dalam tabel produk_terlaris
            $data['is_diskon'] = $this->ProdukModel->getProdukTerlarisRow1();
            if($data['is_diskon']){            
                $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();
                $data['produk_terlaris']->harga_asli = 'Rp. ' . number_format($data['produk_terlaris']->harga_asli, 0, ',', '.');
                $data['produk_terlaris']->harga_diskon = 'Rp. ' . number_format($data['produk_terlaris']->harga_diskon, 0, ',', '.');
            }
            $this->load->view("header", $data);
            $this->load->view("shop", $data);
            $this->load->view("footer", $data);

        }
        public function KontakKami(){
            $data['title'] = 'Kontak Kami - Djaman';
            $data['meta_description'] = 'Hubungi kami di Djaman untuk kebutuhan dan pertanyaan Anda. Temukan kami di [Alamat Toko], [Jam Operasional Toko], [Nomer Telepon], [Alamat Email], dan [Tempat Peta Lokasi Google Maps]. Kirimkan masukan atau pertanyaan melalui formulir kami. Kami siap membantu Anda.';
            $data['meta_url'] = base_url(). 'index.php/Home/KontakKami';

            $data['active_menu'] = 'kontak_kami';

            $pengguna_id = $this->session->userdata('id');
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE pengguna_id = '$pengguna_id' AND status = 'Keranjang'");
            $data['transaksi'] = $transaksi->row();
            $data['transaksicek'] = $transaksi->num_rows();
            if ($data['transaksicek'] > 0) {
                $transaksi_id = $transaksi->row()->id;
                $data['cart_count'] = $this->db->query("SELECT * FROM detail_transaksi WHERE transaksi_id = '$transaksi_id'")->num_rows();
            } else {
                $data['cart_count'] = 0;
            }

            $data['data_kontak']= $this->KontakModel->getKontak();
            $data['data_jam_operasional'] = $this->KontakModel->getJamOperasional();
            $site_key = '6LcuADUoAAAAAAGZpb1eTWPx0GEi4NBt40e-UZqS'; // Ganti dengan Site Key Anda dari reCAPTCHAA
            $data['site_key'] = $site_key;
            $this->load->view("header", $data);
            $this->load->view("contact", $data);
            $this->load->view("footer", $data);

        }

        public function simpanAsknsugest(){
            // Mendapatkan data input dari form
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $response = $this->input->post('g-recaptcha-response');

            if ($response){
                // Validasi input tidak boleh kosong
                if (empty($nama) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
                    $this->session->set_flashdata('error', 'Harap Lengkapi Semua Formulir');
                    redirect('Home/KontakKami');
                }
        
                $data = array(
                    'nama' => $nama,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message
                );
        
                $this->AsknsugestModel->insertAsknsugest($data);
                $this->session->set_flashdata('success', 'Pertanyaan / Saran Terkirim');
                redirect('Home/KontakKami');
            }
            $this->session->set_flashdata('error', 'Harap Mengisi Captcha Untuk Mengirim Pertanyaan / Saran');
            redirect('Home/KontakKami');
        
        }
        public function kirimEmail(){
            // Mendapatkan data input dari form
            $email = $this->input->post('email');
            $data = array(
                'email' => $email,
            );
            $this->AsknsugestModel->insertEmail($data);
            $this->session->set_flashdata('success', 'Pertanyaan / Saran Terkirim');
            redirect('Home');       
        }

        public function tampilKonfirmasiUnsubEmail($email){
            $data['data_email'] = $this->AsknsugestModel->getEmailSubsbyEmail($email);

            $this->load->view("admin/form-konfirmasi-unsub", $data);
        }
        
        
        public function unsubscribeEmail(){
            // Mendapatkan data input dari form
            $email = $this->input->post('email');
            $konfirmasi = strtolower($this->input->post('konfirmasi'));
        
            // Daftar nilai yang valid untuk konfirmasi
            $validKonfirmasi = ['berhenti', 'Berhenti', 'Berhenti'];
        
            // Memeriksa apakah konfirmasi adalah salah satu dari nilai yang valid
            if (in_array($konfirmasi, $validKonfirmasi)) {
                // Proses berhenti berlangganan email di sini
                $this->AsknsugestModel->hapusEmail($email);
        
                $this->session->set_flashdata('success', 'Berhasil Berhenti Berlangganan Email');
            } else {
                $this->session->set_flashdata('error', 'Konfirmasi tidak valid');
            }
        
            redirect('Home/tampilKonfirmasiUnsubEmail/'.$email);       
        }
        


        public function search(){
            $data['active_menu'] = 'cariProduk';
            $keyword = $this->input->get('keyword'); // Mendapatkan nilai keyword dari form pencarian
            
            $data['title'] = 'Mencari Produk Jamu/ Kategori: '. $keyword;
            $data['meta_description'] = 'Temukan keajaiban Jamu Herbal kami! Cari produk Jamu berkualitas tinggi untuk kesehatan alami tubuh Anda. Dapatkan manfaat warisan tradisional dari generasi ke generasi. Temukan solusi alami dengan Jamu herbal kami.';
            $data['meta_url'] = base_url(). 'index.php/Home/search?keyword='.$keyword;
            $data['canonical_url_search'] = base_url(). 'index.php/Home/search?keyword='.urlencode($keyword);
        
            // Panggil model knnSearch dan lakukan pencarian produk berdasarkan keyword
            $this->load->model('ProdukModel');
            $data['data_produk'] = $this->ProdukModel->knnSearch($keyword);
            // Ubah format Harga Kueri Data Produk
            foreach ($data['data_produk'] as &$produk) {
                $produk['harga'] = 'Rp. ' . number_format($produk['harga'], 0, ',', '.');
            }
            // Periksa apakah produk terdapat dalam tabel produk_terlaris
            $data['is_diskon'] = $this->ProdukModel->getProdukTerlarisRow1();
            if($data['is_diskon']){            
                $data['produk_terlaris']= $this->ProdukModel->getProdukTerlaris();
                $data['produk_terlaris']->harga_asli = 'Rp. ' . number_format($data['produk_terlaris']->harga_asli, 0, ',', '.');
                $data['produk_terlaris']->harga_diskon = 'Rp. ' . number_format($data['produk_terlaris']->harga_diskon, 0, ',', '.');
                
            }
            // Load Data Kontak
            $data['data_kontak']= $this->KontakModel->getKontak();
            // Load view belanja dengan data produk hasil pencarian
            $this->load->view("header", $data);
            $this->load->view('shop-search', $data);
            $this->load->view("footer", $data);
        }
        

        public function not_found(){
            $data['active_menu'] = '404NotFound';
            $data['title'] = 'Halaman Tidak Ditemukan - Djaman';
            $data['meta_description'] = 'Temukan manfaat luar biasa dari jamu segar, organik, dan berstandar laboratorium di Djaman. Jaga kesehatan tubuh dengan cara autentik dan tradisional. elamat berbelanja dan menjaga kesehatan dengan Djaman!';
            $data['meta_url'] = base_url();

            $data['data_kontak']= $this->KontakModel->getKontak();
            $this->load->view("header", $data);
            $this->load->view('404');
            $this->load->view("footer", $data);
        }

    }
?>