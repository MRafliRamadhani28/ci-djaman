<?php
class PenggunaModel extends CI_Model {
    public function login($username, $password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return $this->db->get("pengguna");
    }

    // Terkait Pengguna
    public function getPenggunaByUsername($username)
    {
        return $this->db->get_where('pengguna', ['username' => $username])->row();
    }
    public function getPengguna()
    {
        $this->db->select('pengguna.id_pengguna, pengguna.nama, pengguna.email, pengguna.username, pengguna.password, pengguna.foto, pengguna.status_aktif');
        $this->db->from('pengguna');
        $this->db->order_by('id_pengguna', 'asc');
        return $this->db->get()->result();
    }
    public function isUsernameExist($username) 
    {
        $this->db->where('username', $username);
        $query = $this->db->get('pengguna'); // Ganti 'nama_tabel_pengguna' sesuai dengan nama tabel pengguna Anda
        return $query->num_rows() > 0;
    }
    public function getPenggunaById($id_pengguna)
    {
        $this->db->select('pengguna.id_pengguna, pengguna.nama, pengguna.email, pengguna.username, pengguna.password, pengguna.foto, pengguna.status_aktif');
        $this->db->from('pengguna');
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->limit(1);
        $this->db->order_by('id_pengguna', 'desc');
        return $this->db->get()->row();
    }
    
    public function getLastIdPengguna(){
        $this->db->select_max('id_pengguna');
        $this->db->like('id_pengguna', 'PGN', 'after'); // Hanya ambil ID yang dimulai dengan "JM"
        $this->db->where('LENGTH(id_pengguna)', 6); // Filter hanya ID produk dengan panjang 5 karakter
        $query = $this->db->get('pengguna');
        $result = $query->row_array();
    
        // Jika tidak ada data dengan ID "JM", kembalikan nilai awal yaitu "JM000"
        if ($result['id_pengguna'] === null) {
            return 'PGN000';
        }
    
        return $result['id_pengguna'];
    }
    public function simpanDataPengguna($data){
        $this->db->insert('pengguna', $data);

    }
    public function updatePengguna($id_pengguna, $data)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->update('pengguna', $data);
    }

    // Terkait Kelola Link Embed Super Adin
    public function getLinkEmbed(){
        $this->db->select('id_link, link');
        $this->db->from('link_embed');

        return $this->db->get()->row();
    }

    public function getLinkEmbedDefault(){
        $this->db->select('link_default');
        $this->db->from('link_embed');

        return $this->db->get()->row();
    }

    public function updateLink($id_link, $data)
    {
        $this->db->where('id_link', $id_link);
        if ($this->db->update('link_embed', $data)) {
            return true; // Jika pembaruan berhasil
        } else {
            return false; // Jika ada kesalahan dalam pembaruan
        }
    }
    
    // Terkait Aktivitas Blokir / ktif
    public function blokirPengguna($id_pengguna) {
        $data = array(
            'status_aktif' => 'Blokir'
        );
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->update('pengguna', $data);
        return $this->db->affected_rows() > 0;
    }
    
    public function aktifkanPengguna($id_pengguna) {
        $data = array(
            'status_aktif' => 'Aktif'
        );
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->update('pengguna', $data);
        return $this->db->affected_rows() > 0;
    }

    public function searchPengguna($keyword){
        $this->db->select('pengguna.id_pengguna, pengguna.nama, pengguna.email, pengguna.username, pengguna.foto, pengguna.status_aktif');
        $this->db->from('pengguna');
        $this->db->like('pengguna.id_pengguna', $keyword);
        $this->db->or_like('pengguna.nama', $keyword);
        $this->db->or_like('pengguna.email', $keyword);
        $this->db->or_like('pengguna.username', $keyword);
        $this->db->or_like('pengguna.foto', $keyword);

        return $this->db->get()->result();
    }
    
}
