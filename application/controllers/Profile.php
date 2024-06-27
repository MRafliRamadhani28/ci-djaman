<?php
    class Profile extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url'); 
            $this->load->model('ProfileModel');
            $this->load->model('UserModel');
            $this->load->library('session');
            if (!$this->session->userdata('logged_in')) {
                redirect('Admin/loginPage');
            }
        }

        
        public function tampilEditProfile($id_profile){
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

            $data['active_menu'] = 'dashboard';
            $data['admin']= $this->ProfileModel->getProfileById($id_profile);
            
            $this->load->view("admin/template/header", $data);
            $this->load->view("admin/edit/edit-profile", $data);
            $this->load->view("admin/template/sidebar", $data);
            $this->load->view("admin/template/footer", $data);;
        }

        
        public function update($id_profile) {
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Mengambil data pengguna berdasarkan ID
            $existingUser = $this->ProfileModel->getProfileById($id_profile);
        
            // Memeriksa apakah username baru yang dimasukkan telah digunakan oleh pengguna lain
            if ($username !== $existingUser->username && $this->UserModel->isUsernameExist($username)) {
                $id_admin_exist = $this->UserModel->getAdminByUsername($username); // Mengambil ID admin yang memiliki username yang sama
                $this->session->set_flashdata('error', 'Username sudah digunakan oleh ' . $id_admin_exist->nama);
                redirect('Profile/tampilEditProfile/' . $id_profile);
            }
        
            // Memeriksa apakah ada file foto yang diupload
            if ($_FILES['foto']['name']) {
                // Logika Hapus Foto Sebelum Di Edit
                $existing_profile = $this->ProfileModel->getProfileById($id_profile);
                $existing_foto = $existing_profile->foto;
                if ($existing_foto && $existing_foto !== 'default.jpg'){
                    // Hapus foto sebelumnya
                    $existing_foto_path = 'assets/img/admin/' . $existing_foto;
                    if (file_exists($existing_foto_path)) {
                        unlink($existing_foto_path);
                    }
                }
                $config['upload_path'] = 'assets/img/admin'; // Lokasi penyimpanan foto
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 10240; // Batasan ukuran file (dalam KB)
                $config['file_name'] = $username . '_Avatar_' . "updatedat_" . time(); // Nama file diubah sesuai nama yang diinputkan
        
                $this->load->library('upload', $config);
        
                if ($this->upload->do_upload('foto')) {
                    $uploaded_data = $this->upload->data();
                    $foto = $uploaded_data['file_name'];
        
                    // Memeriksa apakah file adalah WebP
                    $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
                    if ($file_extension === 'webp') {
                        // Jika file adalah WebP, maka tidak perlu konversi
                        $data = array(
                            'nama' => $nama,
                            'email' => $email,
                            'username' => $username,
                            'foto' => $foto
                        );
                    } else {
                        // Konversi gambar ke WebP
                        list($width, $height) = getimagesize($config['upload_path'] . '/' . $foto);
                        $new_width = $width;
                        $new_height = $height;
        
                        $image_p = imagecreatetruecolor($new_width, $new_height);
        
                        switch (exif_imagetype($config['upload_path'] . '/' . $foto)) {
                            case IMAGETYPE_JPEG:
                                $image = imagecreatefromjpeg($config['upload_path'] . '/' . $foto);
                                break;
                            case IMAGETYPE_PNG:
                                $image = imagecreatefrompng($config['upload_path'] . '/' . $foto);
                                break;
                            default:
                                $image = false;
                                break;
                        }
        
                        if ($image) {
                            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                            $webp_file_path = 'assets/img/admin/' . pathinfo($foto, PATHINFO_FILENAME) . '.webp';
                            imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                            imagedestroy($image_p);
                            imagedestroy($image);
        
                            // Hapus foto asli
                            unlink($config['upload_path'] . '/' . $foto);
        
                            // Update data profil dengan nama file WebP yang baru
                            $data = array(
                                'nama' => $nama,
                                'email' => $email,
                                'username' => $username,
                                'foto' => pathinfo($foto, PATHINFO_FILENAME) . '.webp'
                            );
                        }
                    }
        
                    // Memeriksa apakah password diisi atau tidak
                    if (!empty($password)) {
                        $data['password'] = md5($password);
                    }


                    $this->session->set_userdata($data);
                    $this->ProfileModel->updateProfile($id_profile, $data);
                    $this->session->set_flashdata('success', 'Profile berhasil diperbarui');
                } else {
                    // Handle pesan kesalahan berdasarkan jenis kesalahan
                    $upload_error = $this->upload->display_errors();

                    if (strpos($upload_error, 'The filetype you are attempting to upload is not allowed') !== false) {
                        $this->session->set_flashdata('error', 'Jenis file yang diunggah tidak diperbolehkan. Harap unggah file gambar (JPG, JPEG, PNG dan WEBP).');
                    } elseif (strpos($upload_error, 'The file you are attempting to upload is larger than the permitted size.') !== false) {
                        $this->session->set_flashdata('error', 'Ukuran file yang diunggah melebihi batas maksimum yang diperbolehkan (10 MB).');
                    } else {
                        $this->session->set_flashdata('error', $upload_error);
                    }
                }
            } else {
                // Jika tidak ada foto yang diupload, hanya mengupdate data produk tanpa foto
                $data = array(
                    'nama' => $nama,
                    'email' => $email,
                    'username' => $username
                );
        
                // Memeriksa apakah password diisi atau tidak
                if (!empty($password)) {
                    $data['password'] = md5($password);
                }
        
                $this->ProfileModel->updateProfile($id_profile, $data);
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success', 'Profile berhasil diperbarui');
            }
        
            redirect('Profile/tampilEditProfile/' . $id_profile);
        }
        
        

}
?>