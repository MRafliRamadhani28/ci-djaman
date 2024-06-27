<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Asknsugest extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('AsknsugestModel');
        $this->load->library('session');
        $this->load->library('table');

        // $this->load->library('PhpSpreadsheet'); // Load PHPExcel library
        if (!$this->session->userdata('logged_in')) {
            redirect('Admin/loginPage');
        }
    }
    
    
    public function tampilDataEmail(){
        $data['active_menu'] = 'data-email';
        $data['data_email']= $this->AsknsugestModel->getEmailSubs();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/data-email", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
        $this->load->view("admin/modal/modal-hapus-emailsubs", $data);
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
    
    public function tampilAsknsugest(){
        $data['active_menu'] = 'asknsugest';
        $data['asknsugest']= $this->AsknsugestModel->getAsknsugest();
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/asknsugest", $data);
        $this->load->view("admin/template/footer", $data);
    }

    public function detailAsknsugest($id){
        $data['active_menu'] = 'asknsugest';
        $data['data_asknsugest']= $this->AsknsugestModel->getAsknsugestById($id);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/detail/detail-asknsugest", $data);
        $this->load->view("admin/template/sidebar", $data);
        $this->load->view("admin/template/footer", $data);
    }

    public function exportData() {
        // Query untuk mengambil data dari database
        $data = $this->db->get('asknsugest')->result();
    
        // Judul dengan tanggal ekspor
        $title = "Data Ekspor Ask n Suggest pada " . date('Y-m-d', strtotime('now'));
    
        // Konfigurasi header untuk file Excel
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=exportAsknSugest " . date('Y-m-d', strtotime('now')) . ".xls");
    
        // Membuat header kolom dengan tag tambahan untuk lebar kolom dan garis
        $output = "<table border='1'>";
        $output .= "<tr>";
        $output .= "<th colspan='6'>$title</th>";
        $output .= "</tr>";
        $output .= "<tr>";
        $output .= "<th style='width: 100px;'>No.</th>";
        $output .= "<th style='width: 300px;'>Nama</th>";
        $output .= "<th style='width: 500px;'>Email</th>";
        $output .= "<th style='width: 300px;'>No. Telepon</th>";
        $output .= "<th style='width: 300px;'>Subjek/Judul Pesan</th>";
        $output .= "<th style='width: 500px;'>Isi Pesan</th>";
        $output .= "</tr>";
    
        // Isi data ke dalam file Excel
        foreach ($data as $item) {
            $output .= "<tr>";
            $output .= "<td>".$item->id."</td>";
            $output .= "<td>".$item->nama."</td>";
            $output .= "<td>".$item->email."</td>";
            $output .= "<td>'".$item->phone."</td>";
            $output .= "<td>".$item->subject."</td>";
            $output .= "<td>".$item->message."</td>";
            $output .= "</tr>";
        }
    
        $output .= "</table>";
    
        echo $output;
    }
    
    

    // Pastikan Anda telah memuat library PhpSpreadsheet di atasnya, misalnya:
    // use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // public function generateExcelAsknSugest(){
    //     $data['records_AsknSugest'] = $this->AsknsugestModel->getAsknsugest(); // Mengambil data dari model
    
    //     // Create new PhpSpreadsheet object
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     // Set header style
    //     $headerStyle = [
    //         'font' => [
    //             'bold' => true,
    //             'color' => ['rgb' => 'FFFFFF'], // Warna teks putih
    //         ],
    //         'fill' => [
    //             'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //             'startColor' => [
    //                 'rgb' => '0000FF', // Warna latar biru
    //             ],
    //         ],
    //     ];


    //     $sheet->setTitle('Pertanyaan & Saran');
    //     // Generate Excel data from database records
    //     $row = 1;
    //     $sheet->setCellValue('A'.$row, 'Data Excel: Kumpulan Pertanyaan dan Saran');
    //     $row++;
    //     $sheet->setCellValue('A'.$row, 'Tanggal Dicetak: ' . date('d-m-Y H:i:s'));
    //     $row++;
    //     $row++; // Kosongkan baris untuk memberi jarak antara judul dan header tabel
        
    //     $row++; // Baris judul header tabel
    //     $sheet->setCellValue('A'.$row, 'Nama');
    //     $sheet->setCellValue('B'.$row, 'Email');
    //     $sheet->setCellValue('C'.$row, 'Phone');
    //     $sheet->setCellValue('D'.$row, 'Subjek Pesan');
    //     $sheet->setCellValue('E'.$row, 'Isi Pesan');

    
    //     // Set column width based on content length
    //     $sheet->getColumnDimension('A')->setWidth(20); // Kolom A lebar 20
    //     $sheet->getColumnDimension('B')->setWidth(30); // Kolom B lebar 30
    //     $sheet->getColumnDimension('C')->setWidth(15); // Kolom C lebar 15
    //     $sheet->getColumnDimension('D')->setWidth(25); // Kolom D lebar 25
    //     $sheet->getColumnDimension('E')->setWidth(50); // Kolom E lebar 50
    
    //     // Apply style to header row
    //     $sheet->getStyle('A5:E5')->applyFromArray($headerStyle);
    
    //     foreach ($data['records_AsknSugest'] as $record) {
    //         $row++;
    //         $sheet->setCellValue('A'.$row, $record->nama);
    //         $sheet->setCellValue('B'.$row, $record->email);
    //         $sheet->setCellValue('C'.$row, $record->phone);
    //         $sheet->setCellValue('D'.$row, $record->subject);
    //         $sheet->setCellValue('E'.$row, $record->message);
    //     }
    
    //     // Save Excel file
    //     $filename = 'records_PertanyaanSaran' . date('YmdHis') . '.xlsx';
    //     $path = './assets/excel_files/' . $filename;
    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save($path);
    
    //     $file = FCPATH . 'assets/excel_files/' . $filename; // FCPATH mengambil path direktori root proyek
    
    //     if (file_exists($file)) {
    //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment; filename="' . $filename . '"');
    //         header('Cache-Control: max-age=0');
    //         readfile($file);
    //     } else {
    //         show_404(); // Tampilkan halaman 404 jika file tidak ditemukan
    //     }
    // }
    

    

}