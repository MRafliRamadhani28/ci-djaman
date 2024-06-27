<?php
class TransaksiModel extends CI_Model {
    
    public function getTransaksiById($kode_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->limit(1);
        $this->db->order_by('kode_transaksi', 'desc');
        return $this->db->get()->row();
    }
    
    public function getLastIdTransaksi(){
        $this->db->select_max('kode_transaksi');
        $this->db->like('kode_transaksi', 'TRS', 'after'); // Hanya ambil ID yang dimulai dengan "JM"
        $this->db->where('LENGTH(kode_transaksi)', 6); // Filter hanya ID produk dengan panjang 5 karakter
        $query = $this->db->get('transaksi');
        $result = $query->row_array();
    
        // Jika tidak ada data dengan ID "JM", kembalikan nilai awal yaitu "JM000"
        if ($result['kode_transaksi'] === null) {
            return 'TRS000';
        }
    
        return $result['kode_transaksi'];
    }
    public function simpanDataTransaksi($data){
        $this->db->insert('transaksi', $data);

    }
    public function updateTransaksi($kode_transaksi, $data)
    {
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);
    }
    
    // Terkait Aktivitas Blokir / ktif
    public function blokirTransaksi($kode_transaksi) {
        $data = array(
            'status_aktif' => 'Blokir'
        );
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);
        return $this->db->affected_rows() > 0;
    }
    
    public function aktifkanTransaksi($kode_transaksi) {
        $data = array(
            'status_aktif' => 'Aktif'
        );
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi', $data);
        return $this->db->affected_rows() > 0;
    }

    public function searchPengguna($keyword){
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->like('transaksi.kode_transaksi', $keyword);

        return $this->db->get()->result();
    }
    
}
