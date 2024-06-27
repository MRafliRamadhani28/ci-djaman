<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisasi extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('OrganisasiModel');
        $this->load->library('session');
        $this->load->library('table');
        if (!$this->session->userdata('logged_in')) {
            redirect('Admin/loginPage');
        }
        
    }
    public function tampilDataOrganisasi(){
        $data['active_menu'] = 'data_organisasi';
        $data['data_organisasi']= $this->OrganisasiModel->getOrganisasi();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-organisasi", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);

    }

    public function detailOrganisasi($id_anggota){
        $data['active_menu'] = 'data_organisasi';
        $data['data_anggota']= $this->OrganisasiModel->getOrganisasiById($id_anggota);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/detail/detail-organisasi", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);

    }

    public function editOrganisasi($id_anggota){
        $data['active_menu'] = 'data_organisasi';
        $data['data_organisasi']= $this->OrganisasiModel->getOrganisasiById($id_anggota);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/edit/edit-anggota", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }

    public function update($id_anggota) {
        // Mendapatkan data input dari form
        $id_anggota = $this->input->post('id_anggota');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $email = $this->input->post('email');
    
        // Memeriksa apakah ada file foto yang diupload
        if ($_FILES['foto']['name']) {
            $config['upload_path'] = 'assets/img/anggota'; // Lokasi penyimpanan foto
            $config['allowed_types'] = 'jpg|jpeg|png|webp'; // Format yang diizinkan
            $config['max_size'] = 5120; // Batasan ukuran file (dalam KB)
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('foto')) {
                // Logika Hapus Foto Sebelum Di Edit
                $existing_profile = $this->OrganisasiModel->getOrganisasiById($id_anggota);
                $existing_foto = $existing_profile->foto;
                if ($existing_foto && $existing_foto !== 'default.jpg'){
                    // Hapus foto sebelumnya
                    $existing_foto_path = 'assets/img/admin/' . $existing_foto;
                    if (file_exists($existing_foto_path)) {
                        unlink($existing_foto_path);
                    }
                }
                $uploaded_data = $this->upload->data();
                $foto = $uploaded_data['file_name'];
    
                // Kompresi gambar jika bukan format .webp
                $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
                if ($file_extension !== 'webp') {
                    $file_path = 'assets/img/anggota/' . $foto;
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
                        $webp_file_path = 'assets/img/anggota/' . $id_anggota . "updatedat_" . time(). '.webp';
                        imagewebp($image_p, $webp_file_path, 80); // 80 adalah kualitas gambar, sesuaikan sesuai kebutuhan
                        imagedestroy($image_p);
                        imagedestroy($image);
    
                        // Hapus gambar asli
                        unlink($file_path);
    
                        $foto = $id_anggota . "updatedat_" . time() . '.webp';
                    }
                }
    
                // Mengupdate data anggota beserta foto
                $data = array(
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'email' => $email,
                    'foto' => $foto
                );

                $this->OrganisasiModel->updateOrganisasi($id_anggota, $data);
                $this->session->set_flashdata('success', 'Data Anggota berhasil diperbarui dengan gambar baru.');
    
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('Organisasi/editOrganisasi/' . $id_anggota);
            }
        } else {
            // Jika tidak ada foto yang diupload, hanya mengupdate data anggota tanpa foto
            $data = array(
                'nama' => $nama,
                'jabatan' => $jabatan,
                'email' => $email
            );
    
            $this->OrganisasiModel->updateOrganisasi($id_anggota, $data);
            $this->session->set_flashdata('success', 'Data Anggota berhasil diperbarui.');
        }
    
        redirect('Organisasi/tampilDataOrganisasi');
    }
    

    public function hapus($id_anggota)
    {
        $this->OrganisasiModel->hapusAnggota($id_anggota);

        redirect('Organisasi/tampilDataOrganisasi');
    }

}
