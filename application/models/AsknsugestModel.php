<?php
class AsknsugestModel extends CI_Model {
    public function getAsknsugest(){
        $query = $this->db->get('asknsugest');
        return $query->result();
    }
    public function getEmailSubs(){
        $query = $this->db->get('email_subs');
        return $query->result();
    }
    public function getEmailSubsbyEmail($email){
        $this->db->where('email', $email);
        $query = $this->db->get('email_subs');
        return $query->row();
    }

    public function getTotalDataAsknSugest(){
        return $this->db->count_all('asknsugest');
    }

    public function getAsknsugestById($id){
        $this->db->where('id', $id);
        $query = $this->db->get('asknsugest');
        return $query->row();
    }

    public function insertAsknsugest($data){
        return $this->db->insert("asknsugest", $data);
    }

    public function insertEmail($data){
        return $this->db->insert("email_subs", $data);
    }

    public function hapusEmail($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('email_subs');
    
        if ($this->db->affected_rows() > 0) {
            return true; // Jika penghapusan berhasil
        } else {
            return false; // Jika tidak ada email yang dihapus (tidak ditemukan)
        }
    }
    
    public function searchAsknSugest($keyword) {
        $this->db->like('nama', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('phone', $keyword);
        $this->db->or_like('subject', $keyword);
        $this->db->or_like('message', $keyword);

        return $this->db->get('asknsugest')->result();
    }
}