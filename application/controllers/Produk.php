<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Produk extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("UserModel");
        $this->load->model("ProdukModel");
        $this->load->model("KontakModel");
        $this->load->model("AsknsugestModel");
        $this->load->library("session");
        $this->load->library("table");
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        }
    }
    // Terkait Data - Data Produk
    public function tampilDataProduk() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $data["active_menu"] = "data_produk";
        $data["data_produk"] = ($this->session->userdata("role_id") == 1) ? $this->ProdukModel->getProduk() : $this->ProdukModel->getProdukByAdmin($this->session->userdata("id"));

        if ($data["data_produk"] <> null) {
            foreach ($data["data_produk"] as & $produk) {
                $produk->harga = "Rp. " . number_format($produk->harga, 0, ",", ".");
            }
        } else {
            $data["data_produk"] = [];
        }

        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-produk", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
        $this->load->view("admin/modal/modal-hapus-produk", $data);
    }
    public function detailProduk($id_produk) {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $data["active_menu"] = "data_produk";
        $data["data_produk"] = $this->ProdukModel->getProdukById($id_produk);
        $data["data_produk"]->harga = "Rp. " . number_format($data["data_produk"]->harga, 0, ",", ".");
        // Ambil No telp untuk Whatsapp API
        $data["data_kontak"] = $this->KontakModel->getKontak();
        // Menghapus karakter '+' dan spasi dari nomor telepon
        foreach ($data["data_kontak"] as & $kontak) {
            $kontak->phone = str_replace(["+", " "], "", $kontak->phone);
        }
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/detail/detail-produk", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
        $this->load->view("admin/modal/modal-hapus-produk", $data);
    }
    public function tampilDataProdukTerlaris() {
        $data["produk_terlaris"] = $this->ProdukModel->getProdukTerlaris();
        $this->load->view("admin/dashboard", $data);
    }
    public function inputProduk() {
        // Mendapatkan ID produk terakhir dari database
        $lastProductID = $this->ProdukModel->getLastProductID();
        $newProductID = $this->incrementProductID($lastProductID);
        // Kirim nilai $newProductID ke view menggunakan array data
        $data["newProductID"] = $newProductID;
        $data["active_menu"] = "data_produk";
        // mengambil data kategori
        $data["kategori"] = $this->ProdukModel->getKategoriProdukArray();
        // Load view form dan kirim data ke view
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/input/input-produk", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    private function incrementProductID($lastProductID) {
        // Ambil angka dari ID produk terakhir
        $lastNumber = (int)substr($lastProductID, 2);
        // Increment angka
        $nextNumber = $lastNumber + 1;
        // Jika angka melebihi 999, kembalikan nilai awal "JM000"
        if ($nextNumber > 999) {
            return "JM000";
        }
        // Format angka menjadi tiga digit dengan padding nol di depan
        $nextProductID = "JM" . sprintf("%03d", $nextNumber);
        return $nextProductID;
    }
    public function simpanProduk() {
        // Mendapatkan data input dari form
        $idProduk = $this->input->post("id_produk");
        $namaJamu = $this->input->post("nama_jamu");
        $satuan = $this->input->post("satuan");
        $harga = $this->input->post("harga");
        $deskripsi = $this->input->post("deskripsi");
        $manfaat1 = $this->input->post("manfaat1");
        $manfaat2 = $this->input->post("manfaat2");
        $manfaat3 = $this->input->post("manfaat3");
        $id_kategori = $this->input->post("kategori");
        $pesan = 
        "Nama Lengkap: \n" . 
        "Nomor Telepon: \n" . 
        "Kecamatan: \n" . 
        "Kota: \n" . 
        "Provinsi: \n" . 
        "Alamat Lengkap: \n" . 
        "Kode Pos: \n" . 
        "Nama Produk: $namaJamu \n" . 
        "Harga Produk per Satuan: $harga \n" . 
        "Jumlah Pesanan:... $satuan   \n" . 
        "Metode Pembayaran(Cash on Delivery, BCA, GoPay, Dana):  ";
        $whatsapp_link = "?text=" . urlencode($pesan);

        $link_marketplace = $this->input->post("link_marketplace");
        // Upload foto ke folder
        $config["upload_path"] = "assets/img/produk";
        $config["allowed_types"] = "jpg|jpeg|png|webp"; // Format yang diizinkan
        $config["max_size"] = 5112;
        $config["file_name"] = $idProduk;
        $this->load->library("upload", $config);
        // Menampilkan pesan error jika tidak terdapat foto
        if (!$this->upload->do_upload("foto")) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata("error", "Masukkan Gambar Produk untuk Menambah Produk");
            $this->session->set_flashdata("failed", $error);
            redirect("Produk/inputProduk");
        } else {
            $uploaded_data = $this->upload->data();
            $foto = $uploaded_data["file_name"];
            // Kompresi gambar jika bukan format .webp
            $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
            if ($file_extension !== "webp") {
                $file_path = "assets/img/produk/" . $foto;
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
                    $webp_file_path = "assets/img/produk/" . $idProduk . ".webp";
                    imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                    // Menghapus gambar asli
                    unlink($file_path);
                    $foto = $idProduk . ".webp";
                }
            }
            $data = [
                "id_produk" => $idProduk, 
                "nama_jamu" => $namaJamu, 
                "satuan" => $satuan, 
                "harga" => $harga, 
                "deskripsi" => $deskripsi, 
                "manfaat1" => $manfaat1, 
                "manfaat2" => $manfaat2, 
                "manfaat3" => $manfaat3, 
                "id_kategori" => $id_kategori, 
                "foto" => $foto, 
                "link_wa" => $whatsapp_link,
                "created_at" => date("Y-m-d H:i:s", strtotime("now")),
                "created_by" => $this->session->userdata("id"), ];
            if ($link_marketplace) {
                $data["link_marketplace"] = $link_marketplace;
            }
            $this->ProdukModel->simpanProduk($data);
            // Baris Kode untuk menambah Sitemap
            $this->setNewXML($idProduk);
            $data["data_produk_terbaru"] = $this->ProdukModel->getProdukById($idProduk);
            $namaJamu = $data["data_produk_terbaru"]->nama_jamu;
            $harga = $data["data_produk_terbaru"]->harga;
            $fotoQuery = base_url() . "assets/img/produk/" . $data["data_produk_terbaru"]->foto;
            // Ubah HargaDiskon dan Harga Asli ke format Rupiah
            $harga = "Rp. " . number_format($harga, 0, ",", ".");
            // Mengambil data gambar untuk produk
            $pathFotoProduk = base_url() . "assets/img/produk/" . $foto;
            // Mengambil Data Email dari tabel email_subs dalam bentuk array
            $listEmailSubs = $this->AsknsugestModel->getEmailSubs();
            $emailList = [];
            // perulangan untuk mendapatkan email dalam bentuk row (satu satu)
            foreach ($listEmailSubs as $row) {
                $emailList[] = $row->email; // email adalah nama kolom yang berisi alamat email dalam tabel email_subs
                
            }
            foreach ($emailList as $email) {
                // Mengirim email notifikasi ke subscriber
                $this->load->library("email");
                $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
                $this->email->from("marketing@djaman.my.id", "Marketing Djaman");
                $this->email->to($email);
                $this->email->subject("Produk Terbaru Dari Djaman! " . $namaJamu);
                // Gunakan pesan HTML
                $message = '
                <html>
                    <head>
                        <title>Email Pemberitahuan Produk Terbaru</title>
                        <style>
                            .card {
                                position: relative;
                                display: flex;
                                flex-direction: column;
                                min-width: 0;
                                word-wrap: break-word;
                                background-color: #fff;
                                background-clip: border-box;
                                border: 0 solid #d9dee3;
                                border-radius: 0.5rem;
                            }

                            .h-100 {
                                height: 100% !important;
                            }

                            .card-body {
                                flex: 1 1 auto;
                                padding: 1.5rem 1.5rem;
                            }

                            .card-title {
                                margin-bottom: 0.875rem;
                            }

                            h5,
                            .h5 {
                                font-size: 1.125rem;
                            }

                            .text-muted {
                                --bs-text-opacity: 1;
                                color: #978D4F !important;
                            }

                            .card-subtitle {
                                margin-top: -0.4375rem;
                                margin-bottom: 0;
                            }

                            h6,
                            .h6,
                            h5,
                            .h5,
                            h4,
                            .h4,
                            h3,
                            .h3,
                            h2,
                            .h2,
                            h1,
                            .h1 {
                                margin-top: 0;
                                margin-bottom: 1rem;
                                font-weight: 500;
                                line-height: 1.1;
                                color: #4B3414;
                            }

                            h6,
                            .h6 {
                                font-size: 0.9375rem;
                            }

                            .my-4 {
                                margin-top: 1.5rem !important;
                                margin-bottom: 1.5rem !important;
                            }

                            .img-fluid {
                                max-width: 100%;
                                height: auto;
                            }

                            .mx-auto {
                                margin-right: auto !important;
                                margin-left: auto !important;
                            }

                            .d-flex {
                                display: flex !important;
                            }

                            .card-text:last-child {
                                margin-bottom: 0;
                            }

                            .card .card-link {
                                display: inline-block;
                            }

                            a {
                                color: #978D4F;
                            }
                        </style>
                    </head>
                    <body style="background:#4B3414;" align="center">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Produk Terbaru Dari Djaman!</h5>
                                <img class="img-fluid d-flex mx-auto my-4" src="' . $fotoQuery . '" alt="FotoProduk">
                                <h5 class="card-text">' . $namaJamu . '</h5>
                                <h3 class="card-text">' . $harga . '</h3> Silakan lihat detail produk terbaru di <a href="' . base_url() . " index.php/Home/SingleProduk/" . $idProduk . '" class="card-link">website kami</a>
                                <div class="card-text">Klik Link berikut untuk Berhenti Berlangganan Email:    
                                    <a href="' . base_url() . "index.php/Home/tampilKonfirmasiUnsubEmail/" . $email . '" class="card-link">Berhenti Berlangganan</a>
                                </div>
                            </div>
                        </div>
                    </body>
                </html>
                ';
                $this->email->message($message);
                $result_kirimEmail = $this->email->send();
            }
            if ($result_kirimEmail) {
                $this->session->set_flashdata("success", "Produk Terbaru Berhasil Disimpan. Email Marketing Terkirim dengan link.");
            } else {
                $error_message = $this->email->print_debugger(); // Mengambil pesan kesalahan
                $this->session->set_flashdata("error", "Email marketing gagal dikirim. Pesan Kesalahan: " . $error_message);
            }
            redirect("Produk/tampilDataProduk");
        }
    }
    public function kirimNotifEmailProdukTerbaru($idProduk) {
        $data["data_produk_terbaru"] = $this->ProdukModel->getProdukById($idProduk);
        $namaJamu = $data["data_produk_terbaru"]->nama_jamu;
        $harga = $data["data_produk_terbaru"]->harga;
        $foto = $data["data_produk_terbaru"]->foto;
        // Ubah HargaDiskon dan Harga Asli ke format Rupiah
        $harga = "Rp. " . number_format($harga, 0, ",", ".");
        // Mengambil data gambar untuk produk
        $pathFotoProduk = base_url() . "assets/img/produk/" . $foto;
        // Mengambil Data Email dari tabel email_subs dalam bentuk array
        $listEmailSubs = $this->AsknsugestModel->getEmailSubs();
        $emailList = [];
        // perulangan untuk mendapatkan email dalam bentuk row (satu satu)
        foreach ($listEmailSubs as $row) {
            $emailList[] = $row->email; // email adalah nama kolom yang berisi alamat email dalam tabel email_subs
            
        }
        foreach ($emailList as $email) {
            // Mengirim email notifikasi ke subscriber
            $this->load->library("email");
            $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
            $this->email->from("marketing@djaman.my.id", "Marketing Djaman");
            $this->email->to($email);
            $this->email->subject("Produk Terbaru Dari Djaman! " . $namaJamu);
            $this->email->attach($pathFotoProduk);
            // Gunakan pesan HTML
            $message = '
            <html>
                <head>
                    <title>Email Pemberitahuan Produk Terbaru</title>
                    <style>
                    .card {
                        position: relative;
                        display: flex;
                        flex-direction: column;
                        min-width: 0;
                        word-wrap: break-word;
                        background-color: #fff;
                        background-clip: border-box;
                        border: 0 solid #d9dee3;
                        border-radius: 0.5rem;
                    }

                    .h-100 {
                        height: 100% !important;
                    }

                    .card-body {
                        flex: 1 1 auto;
                        padding: 1.5rem 1.5rem;
                    }

                    .card-title {
                        margin-bottom: 0.875rem;
                    }

                    h5,
                    .h5 {
                        font-size: 1.125rem;
                    }

                    .text-muted {
                        --bs-text-opacity: 1;
                        color: #978D4F !important;
                    }

                    .card-subtitle {
                        margin-top: -0.4375rem;
                        margin-bottom: 0;
                    }

                    h6,
                    .h6,
                    h5,
                    .h5,
                    h4,
                    .h4,
                    h3,
                    .h3,
                    h2,
                    .h2,
                    h1,
                    .h1 {
                        margin-top: 0;
                        margin-bottom: 1rem;
                        font-weight: 500;
                        line-height: 1.1;
                        color: #4B3414;
                    }

                    h6,
                    .h6 {
                        font-size: 0.9375rem;
                    }

                    .my-4 {
                        margin-top: 1.5rem !important;
                        margin-bottom: 1.5rem !important;
                    }

                    .img-fluid {
                        max-width: 100%;
                        height: auto;
                    }

                    .mx-auto {
                        margin-right: auto !important;
                        margin-left: auto !important;
                    }

                    .d-flex {
                        display: flex !important;
                    }

                    .card-text:last-child {
                        margin-bottom: 0;
                    }

                    .card .card-link {
                        display: inline-block;
                    }

                    a {
                        color: #978D4F;
                    }
                    </style>
                </head>
                <body style="background:#4B3414;" align="center">
                    <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Produk Terbaru Dari Djaman!</h5>
                        <img class="img-fluid d-flex mx-auto my-4" src="' . base_url() . " /assets/img/produk/" . $foto . '" alt="FotoProduk">
                        <img class="img-fluid d-flex mx-auto my-4" src="' . base_url("assets/img/produk/" . $foto) . '" alt="FotoProduk">
                            <h5 class="card-text">' . $namaJamu . '</h5>
                            <h3 class="card-text" >' . $harga . '</h3>

                            Silakan lihat detail produk terbaru di 
                            <a href="' . base_url() . "index.php/Home/SingleProduk/" . $idProduk . '" class="card-link">website kami</a>
                            <div class="card-text">Klik Link berikut untuk Berhenti Berlangganan Email: 

                                
                                <a href="' . base_url() . "index.php/Home/tampilKonfirmasiUnsubEmail/" . $email . '" class="card-link">Berhenti Berlangganan</a>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
            ';
            $this->email->message($message);
            $result_kirimEmail = $this->email->send();
        }
        if ($result_kirimEmail) {
            $this->session->set_flashdata("success", "Email Marketing Terkirim dengan link gambar: " . base_url() . "assets/img/produk/" . $foto);
        } else {
            $error_message = $this->email->print_debugger(); // Mengambil pesan kesalahan
            $this->session->set_flashdata("error", "Email marketing gagal dikirim. Pesan Kesalahan: " . $error_message);
        }
    }
    public function editProduk($id_produk) {
        $data["active_menu"] = "data_produk";
        $data["data_produk"] = $this->ProdukModel->getProdukById($id_produk);
        $data["data_produk"]->harga = number_format($data["data_produk"]->harga, 0, ",", ".");
        // mengambil data kategori
        $data["kategori"] = $this->ProdukModel->getKategoriProdukArray();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/edit/edit-produk", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function update($id_produk) {
        $id_produk = $this->input->post("id_produk");
        $nama_jamu = $this->input->post("nama_jamu");
        $satuan = $this->input->post("satuan");
        $harga = $this->input->post("harga");
        $harga_formatRp = 'Rp. ' . number_format($harga, 0, ',', '.');
        $deskripsi = $this->input->post("deskripsi");
        $manfaat1 = $this->input->post("manfaat1");
        $manfaat2 = $this->input->post("manfaat2");
        $manfaat3 = $this->input->post("manfaat3");
        $id_kategori = $this->input->post("kategori");
        $link_marketplace = $this->input->post("link_marketplace");
        $pesan = 
            "Nama Lengkap: \n" . 
            "Nomor Telepon: \n" . 
            "Kecamatan: \n" . 
            "Kota: \n" . 
            "Provinsi: \n" . 
            "Alamat Lengkap: \n" . 
            "Kode Pos: \n" . 
            "Nama Produk: $nama_jamu \n" . 
            "Harga Produk per Satuan: $harga_formatRp \n" . 
            "Jumlah Pesanan:... $satuan   \n" . 
            "Metode Pembayaran(Cash on Delivery, BCA, GoPay, Dana):  ";
        $whatsapp_link = "?text=" . urlencode($pesan);
    
        // Memeriksa apakah ada file foto yang diunggah
        if ($_FILES["foto"]["name"]) {
            // Hapus Foto Lama di Folder
            $data_produkbyID = $this->ProdukModel->getProdukById($id_produk);
            $foto = $data_produkbyID->foto;
            $file_path = FCPATH . "assets/img/produk/" . $foto; // FCPATH adalah path menuju root direktori aplikasi CodeIgniter
            // unlink($file_path);

            $config["upload_path"] = "assets/img/produk"; // Lokasi penyimpanan foto
            $config["allowed_types"] = "jpg|jpeg|png|webp"; // Format yang diizinkan
            $config["max_size"] = 5120; // Batasan ukuran file (dalam KB)
            $this->load->library("upload", $config);
            
            if ($this->upload->do_upload("foto")) {
                $uploaded_data = $this->upload->data();
                $foto = $uploaded_data["file_name"];
                $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
                
                if ($file_extension !== "webp") {
                    
                    // Kompresi gambar jika bukan format .webp
                    $file_path = "assets/img/produk/" . $foto;
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
                        $webp_file_path = "assets/img/produk/" . $id_produk . "updatedat_" . time() . ".webp";
                        imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                        imagedestroy($image_p);
                        imagedestroy($image);
                        // unlink($file_path); // Hapus gambar asli
                        $foto = $id_produk . "updatedat_" . time() . ".webp";
                    }
                }
                
                // Mengupdate data produk beserta foto
                $data = [
                    "nama_jamu" => $nama_jamu,
                    "satuan" => $satuan,
                    "harga" => $harga,
                    "deskripsi" => $deskripsi,
                    "manfaat1" => $manfaat1,
                    "manfaat2" => $manfaat2,
                    "manfaat3" => $manfaat3,
                    "id_kategori" => $id_kategori,
                    "foto" => $foto,
                    "link_wa" => $whatsapp_link,
                    "updated_at" => date("Y-m-d H:i:s", strtotime("now")),
                    "updated_by" => $this->session->userdata("id"),
                ];
                
                if ($link_marketplace) {
                    $data["link_marketplace"] = $link_marketplace;
                }
                
                $this->ProdukModel->updateProduk($id_produk, $data);
                $this->session->set_flashdata("success", "Produk berhasil diperbarui dengan gambar baru.");
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata("error", "$error");
                redirect("Produk/editProduk/" . $id_produk);
            }
        } else {
            // Jika tidak ada foto yang diunggah, hanya mengupdate data produk tanpa foto
            $data = [
                "nama_jamu" => $nama_jamu,
                "satuan" => $satuan,
                "harga" => $harga,
                "deskripsi" => $deskripsi,
                "manfaat1" => $manfaat1,
                "manfaat2" => $manfaat2,
                "manfaat3" => $manfaat3,
                "id_kategori" => $id_kategori,
                "link_wa" => $whatsapp_link,
                "updated_at" => date("Y-m-d H:i:s", strtotime("now")),
                "updated_by" => $this->session->userdata("id"),
            ];
            
            if ($link_marketplace) {
                $data["link_marketplace"] = $link_marketplace;
            }
            
            $this->ProdukModel->updateProduk($id_produk, $data);
            $this->session->set_flashdata("success", "Produk berhasil diperbarui.");
        }
        
        if ($this->ProdukModel->cekRelasiProdukTerlaris($id_produk)) {
            $data["terlaris"] = $this->ProdukModel->getProdukTerlaris($id_produk);
            $update_diskon = $data["terlaris"]->harga_asli - ($data["terlaris"]->harga_asli * $data["terlaris"]->diskon) / 100;
            $data_terlaris = [
                "diskon" => $data["terlaris"]->diskon,
                "harga_diskon" => $update_diskon,
            ];
            
            $this->ProdukModel->updateTerlaris($id_produk, $data_terlaris);
            $this->session->set_flashdata("success", "Produk berhasil diperbarui.");
            $this->session->set_flashdata("success", "Data Produk dan Produk Terlaris berhasil diperbarui.");
        }
        
        redirect("Produk/tampilDataProduk");
    }
    
    public function hapus($id_produk) {
        try {
            // Cek apakah data ada di tabel utama berdasarkan $id
            $data = $this->ProdukModel->getProdukById($id_produk);
            if ($data) {
                // Periksa apakah ada data terkait di tabel referensi
                if ($this->ProdukModel->cekDataReferensi($id_produk)) {
                    $this->session->set_flashdata("error", "Tidak dapat menghapus produk dikarenakan produk tersebut adalah PRODUK TERLARIS");
                } else {
                    // Hapus foto lama di folder
                    $data_produkbyID = $this->ProdukModel->getProdukById($id_produk);
                    $foto = $data_produkbyID->foto;
                    $file_path = FCPATH . "assets/img/produk/" . $foto; // FCPATH adalah path menuju root direktori aplikasi CodeIgniter
                    unlink($file_path);
                    // Lakukan penghapusan data dari tabel utama
                    $this->ProdukModel->hapusProduk($id_produk);
                    $this->ProdukModel->setXML();
                    $this->ProdukModel->hapusSitemap($id_produk);
                    $this->session->set_flashdata("success", "Data berhasil dihapus.");
                }
            } else {
                $this->session->set_flashdata("error", "Data tidak ditemukan.");
            }
        }
        catch(Exception $e) {
            // Tangkap pengecualian jika terjadi kesalahan saat menghapus data
            $this->session->set_flashdata("error", "Terjadi kesalahan saat menghapus data.");
        }
        redirect("Produk/tampilDataProduk");
    }
    public function detailProdukTerlaris() {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }

        $data["active_menu"] = "data_terlaris";
        $data["data_produk_terlaris"] = $this->ProdukModel->getProdukTerlaris();
        $data["data_produk_terlaris"]->harga_asli = "Rp. " . number_format($data["data_produk_terlaris"]->harga_asli, 0, ",", ".");
        $data["data_produk_terlaris"]->harga_diskon = "Rp. " . number_format($data["data_produk_terlaris"]->harga_diskon, 0, ",", ".");
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/detail/detail-produkterlaris", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function UpdateDataTerlaris($id_produk) {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }

        $data["active_menu"] = "data_produk";
        $data["produk_terlaris"] = $this->ProdukModel->getProdukById($id_produk);
        // $data['produk_terlaris']->harga = 'Rp. ' . number_format($data['produk_terlaris']->harga, 0, ',', '.');
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/update-terlaris", $data);
    }
    public function updateTerlaris($id_produk) {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }

        $id_produk = $this->input->post("id_produk");
        $diskon = $this->input->post("diskon");
        $harga_diskon = $this->input->post("harga_diskon");
        $harga_diskonFormatRp = "Rp. " . number_format($harga_diskon, 0, ",", ".");
        $date = $this->input->post("date");
        $foto = $this->input->post("foto");
        $DataProduktoTerlaris = $this->ProdukModel->getProdukById($id_produk);
        $pesan = 
            "Nama Lengkap: \n" . 
            "Nomor Telepon: \n" . 
            "Kecamatan: \n" . 
            "Kota: \n" . 
            "Provinsi: \n" . 
            "Alamat Lengkap: \n" . 
            "Kode Pos: \n" . 
            "Nama Produk: $DataProduktoTerlaris->nama_jamu \n" . 
            "Harga Produk per Satuan: $harga_diskonFormatRp \n" . 
            "Jumlah Pesanan:... $DataProduktoTerlaris->satuan   \n" . 
            "Metode Pembayaran(Cash on Delivery, BCA, GoPay, Dana):  ";
        $whatsapp_link = "?text=" . urlencode($pesan);

        $data = ["id_produk" => $id_produk, 
        "diskon" => $diskon, 
        "harga_diskon" => $harga_diskon, 
        "date" => $date,
        "foto" => $foto, 
        "link_wa" => $whatsapp_link,
        "updated_at" => date("Y-m-d H:i:s", strtotime("now")), 
        "updated_by" => $this->session->userdata("id"), ];
        
        $this->ProdukModel->updateTerlaris($id_produk, $data);
        // Mengambil Data Produk Terlaris Yang Telah Diperbarui
        $data["new_produk_terlaris"] = $this->ProdukModel->getProdukById($this->input->post("id_produk"));
        // Ubah HargaDiskon dan Harga Asli ke format Rupiah
        $data["new_produk_terlaris"]->harga = "Rp. " . number_format($data["new_produk_terlaris"]->harga, 0, ",", ".");
        $harga_diskon = "Rp. " . number_format($harga_diskon, 0, ",", ".");
        // Mengambil Data Email dari tabel email_subs dalam bentuk array
        $listEmailSubs = $this->AsknsugestModel->getEmailSubs();
        $emailList = [];
        // perulangan untuk mendapatkan email dalam bentuk row (satu satu)
        foreach ($listEmailSubs as $row) {
            $emailList[] = $row->email; // email adalah nama kolom yang berisi alamat email dalam tabel email_subs
            
        }
        foreach ($emailList as $email) {
            // Mengirim email notifikasi ke subscriber
            $this->load->library("email");
            $this->email->set_mailtype("html"); // Mengatur jenis konten email sebagai HTML
            $this->email->from("marketing@djaman.my.id", "Marketing Djaman");
            $this->email->to($email);
            $this->email->subject("Ambil Diskon Sebesar " . $diskon . "% untuk Produk " . $data["new_produk_terlaris"]->nama_jamu . "");
            // Gunakan pesan HTML
            $message = '

            <html>
                <head>
                    <title>Email Pemberitahuan Produk Terlaris</title>
                    <style>
                        .card {
                        position: relative;
                        display: flex;
                        flex-direction: column;
                        min-width: 0;
                        word-wrap: break-word;
                        background-color: #fff;
                        background-clip: border-box;
                        border: 0 solid #d9dee3;
                        border-radius: 0.5rem;
                        }
                        .h-100 {
                        height: 100% !important;
                        }
                        .card-body {
                        flex: 1 1 auto;
                        padding: 1.5rem 1.5rem;
                        }
                        .card-title {
                        margin-bottom: 0.875rem;
                        }
                        h5,
                        .h5 {
                        font-size: 1.125rem;
                        }
                        .text-muted {
                        --bs-text-opacity: 1;
                        color: #978D4F !important;
                        }
                        .card-subtitle {
                        margin-top: -0.4375rem;
                        margin-bottom: 0;
                        }
                        h6,
                        .h6,
                        h5,
                        .h5,
                        h4,
                        .h4,
                        h3,
                        .h3,
                        h2,
                        .h2,
                        h1,
                        .h1 {
                        margin-top: 0;
                        margin-bottom: 1rem;
                        font-weight: 500;
                        line-height: 1.1;
                        color: #4B3414;
                        }
                        h6,
                        .h6 {
                        font-size: 0.9375rem;
                        }
                        .my-4 {
                        margin-top: 1.5rem !important;
                        margin-bottom: 1.5rem !important;
                        }
                        .img-fluid {
                        max-width: 100%;
                        height: auto;
                        }
                        .mx-auto {
                        margin-right: auto !important;
                        margin-left: auto !important;
                        }
                        .d-flex {
                        display: flex !important;
                        }
                        .card-text:last-child {
                        margin-bottom: 0;
                        }
                        .card .card-link {
                        display: inline-block;
                        }
                        a {
                        color: #978D4F;
                        }
                    </style>
                </head>
                <body style="background:#4B3414;" align="center">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Produk Terlaris Terbaru Dari Djaman!</h5>
                            <h6 class="card-subtitle text-muted">Diskon Sampai ' . $diskon . '%</h6>
                            <img class="img-fluid d-flex mx-auto my-4" src="' . base_url() . "/assets/img/produk/" . $foto . '" alt="FotoProduk">
                            <h5 class="card-text">' . $data["new_produk_terlaris"]->nama_jamu . '</h5>
                            <h3 class="card-text" style="text-decoration: line-through;">' . $data["new_produk_terlaris"]->harga . '</h3>
                            <div class="card-text">Menjadi ' . $harga_diskon . '</div>
                            Silakan cek perubahan detail di <a href="' . base_url() . '/#Terlaris" class="card-link">website kami</a>
                            <div class="card-text">Klik Link berikut untuk Berhenti Berlangganan Email: 
                                <a href="' . base_url() . "index.php/Home/tampilKonfirmasiUnsubEmail/" . $email . '" class="card-link">Berhenti Berlangganan</a>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';
            $this->email->message($message);
            $result_kirimEmail = $this->email->send();
        }
        if ($result_kirimEmail) {
            $this->session->set_flashdata("success", "Produk Terlaris Telah Diperbarui dan Email Marketing Subscription Terkirim");
        } else {
            $error_message = $this->email->print_debugger(); // Mengambil pesan kesalahan
            $this->session->set_flashdata("error", "Produk Terlaris berhasil diperbarui tetapi email marketing gagal dikirim. Pesan Kesalahan: " . $error_message);
        }
        redirect("Admin");
    }
    // Terkait Kategori Produk
    public function tampilDataKategori() {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $data["data_kategori"] = $this->ProdukModel->getKategoriProduk();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-kategori", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
        $this->load->view("admin/modal/modal-hapus-kategori", $data);
    }
    public function tambahKategoriProduk() {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $data["data_kategori"] = $this->ProdukModel->getKategoriProduk();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/input/input-kategori", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function simpanKategori() {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $data = ["nama_kategori" => $this->input->post("nama_kategori"), "deskripsi_kategori" => $this->input->post("deskripsi_kategori"), ];
        $result = $this->ProdukModel->simpanKategori($data);
        if ($result) {
            $this->session->set_flashdata("success", "Simpan Data Kategori Berhasil");
        } else {
            $this->session->set_flashdata("error", "Data Kategori Max 5");
        }
        redirect("Produk/tampilDataKategori");
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/input/input-kategori", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function editKategoriProduk($id_kategori) {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $data["data_kategori"] = $this->ProdukModel->getKategoriProdukById($id_kategori);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/edit/edit-kategori", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function updateKategori($id_kategori) {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $update_data = ["nama_kategori" => $this->input->post("nama_kategori"), "deskripsi_kategori" => $this->input->post("deskripsi"), ];
        $cekRelasiProduk = $this->ProdukModel->cekRelasiDenganDataProduk($id_kategori);
        if ($cekRelasiProduk) {
            $this->ProdukModel->updateKategori($id_kategori, $update_data);
            // Jika pembaruan gagal, set pesan flash data error
            $this->session->set_flashdata("success", "Pembaruan kategori pada Data Produk dan Data Kategori berhasil dilakukan.");
        } else {
            // Memanggil metode updateKategori dari model untuk melakukan pembaruan
            $result = $this->ProdukModel->updateKategori($id_kategori, $update_data);
            if ($result) {
                // Jika pembaruan berhasil, set pesan flash data sukses
                $this->session->set_flashdata("success", "Kategori Produk berhasil diperbarui.");
            } else {
                // Jika pembaruan gagal, set pesan flash data error
                $this->session->set_flashdata("error", "Gagal memperbarui Kategori Produk.");
            }
        }
        // Redirect ke halaman data-kategori
        redirect("Produk/tampilDataKategori");
    }
    public function hapusKategoriProduk($id_kategori) {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        // Cek apakah ada relasi dengan tabel data_produk
        $isRelated = $this->ProdukModel->cekRelasiDenganDataProduk($id_kategori);
        if (!$isRelated) {
            // Jika tidak ada relasi, hapus kategori produk
            $this->ProdukModel->hapusKategori($id_kategori);
            $this->session->set_flashdata("success", "Kategori Produk berhasil dihapus");
        } else {
            // Jika ada relasi, berikan keterangan
            $this->session->set_flashdata("error", "Kategori Produk tidak dapat dihapus karena ada produk yang terkait.");
        }
        redirect("Produk/tampilDataKategori");
    }
    public function setNewXML($idProduk) {
        // Baris Kode untuk menambah Sitemap
        $data_sitemap = ["id_produk" => $idProduk, ];
        $this->ProdukModel->tambahSitemap($data_sitemap);
        // Mengubah sitemap sesuai produk yang telah ditambahkan
        $this->ProdukModel->setXML();
    }
    public function search() {
        $data["active_menu"] = "data_produk";
        $keyword = $this->input->get("keyword"); // Mendapatkan keyword pencarian dari input GET
        // Lakukan pencarian data berdasarkan keyword
        $data["data_produk"] = $this->ProdukModel->searchProduk($keyword);
        foreach ($data["data_produk"] as & $produk) {
            $produk->harga = "Rp. " . number_format($produk->harga, 0, ",", ".");
        }
        // Tampilkan tampilan (view) dengan hasil pencarian
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-produk", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
    public function searchKategori() {
        if (!$this->session->userdata("logged_in")) {
            redirect("Admin/loginPage");
        } elseif ($this->session->userdata("role_id") == 2) {
            redirect("Admin/errorPage");
        }
        $data["active_menu"] = "data_kategori";
        $keyword = $this->input->get("keyword"); // Mendapatkan keyword pencarian dari input GET
        // Lakukan pencarian data berdasarkan keyword
        $data["data_kategori"] = $this->ProdukModel->searchKategori($keyword);
        // Tampilkan tampilan (view) dengan hasil pencarian
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-kategori", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }
}
