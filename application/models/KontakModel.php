<?php
class KontakModel extends CI_Model {
    public function getKontak(){
        $query = $this->db->get('data_kontak');
        return $query->result();
    }

    public function getKontakById($id_kontak){
        $this->db->where('id_kontak', $id_kontak);
        $query = $this->db->get('data_kontak');
        return $query->row();
    }

    public function updateKontak($id_kontak, $data){
        $this->db->where('id_kontak', $id_kontak);
        $this->db->update('data_kontak', $data);
    }
    public function searchKontak($keyword) {
        $this->db->like('id_kontak', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('phone', $keyword);
        $this->db->or_like('email', $keyword);

        return $this->db->get('data_kontak')->result();
    }

    public function getJamOperasional() {
        return $this->db->get('jam_operasional')->result();
    }

    public function getJamOperasionalById($id_jamoperasional) {
        $this->db->where('id_jamoperasional', $id_jamoperasional);
        $result = $this->db->get('jam_operasional');
    
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null; // Atau Anda bisa mengembalikan pesan kesalahan sesuai kebutuhan
        }
    }
    

    public function editJamOperasional($id, $data) {
        $this->db->where('id_jamoperasional', $id);
        return $this->db->update('jam_operasional', $data);
    }

}