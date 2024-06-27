<?php
class UserModel extends CI_Model {
    public function login($username, $password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return $this->db->get("admin");
    }

    // Terkait Admin
    public function getAdminByUsername($username)
    {
        return $this->db->get_where('admin', ['username' => $username])->row();
    }
    public function getAdmin()
    {
        $this->db->select('admin.id_admin, admin.nama, admin.email, admin.username, admin.password, admin.foto, roles.nama_role, admin.status_aktif');
        $this->db->from('admin');
        $this->db->join('roles', 'roles.role_id = admin.role_id');
        $this->db->order_by('id_admin', 'asc');
        return $this->db->get()->result();
    }
    public function isUsernameExist($username) 
    {
        $this->db->where('username', $username);
        $query = $this->db->get('admin'); // Ganti 'nama_tabel_admin' sesuai dengan nama tabel admin Anda
        return $query->num_rows() > 0;
    }
    public function getAdminById($id_admin)
    {
        $this->db->select('admin.id_admin, admin.nama, admin.email, admin.username, admin.password, admin.foto, roles.role_id, roles.nama_role, admin.status_aktif');
        $this->db->from('admin');
        $this->db->join('roles', 'roles.role_id = admin.role_id');
        $this->db->where('id_admin', $id_admin);
        $this->db->limit(1);
        $this->db->order_by('id_admin', 'desc');
        return $this->db->get()->row();
    }
    public function getRoles()
    {
        $this->db->select('role_id, nama_role');
        $this->db->from('roles');
        return $this->db->get()->result();

    }
    public function getRolesAdmin()
    {
        $this->db->select('role_id, nama_role');
        $this->db->from('roles');
        $this->db->where('role_id', 2);
        return $this->db->get()->row();

    }
    public function getLastIdAdmin(){
        $this->db->select_max('id_admin');
        $this->db->like('id_admin', 'ADM', 'after'); // Hanya ambil ID yang dimulai dengan "JM"
        $this->db->where('LENGTH(id_admin)', 6); // Filter hanya ID produk dengan panjang 5 karakter
        $query = $this->db->get('admin');
        $result = $query->row_array();
    
        // Jika tidak ada data dengan ID "JM", kembalikan nilai awal yaitu "JM000"
        if ($result['id_admin'] === null) {
            return 'ADM000';
        }
    
        return $result['id_admin'];
    }
    public function simpanDataAdmin($data){
        $this->db->insert('admin', $data);

    }
    public function updateAdmin($id_admin, $data)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
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
    public function blokirAdmin($id_admin) {
        $data = array(
            'status_aktif' => 'Blokir'
        );
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
        return $this->db->affected_rows() > 0;
    }
    
    public function aktifkanAdmin($id_admin) {
        $data = array(
            'status_aktif' => 'Aktif'
        );
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
        return $this->db->affected_rows() > 0;
    }

    public function searchAdmin($keyword){
        $this->db->select('admin.id_admin, admin.nama, admin.email, admin.username, admin.foto, admin.status_aktif, roles.nama_role');
        $this->db->from('admin');
        $this->db->join('roles', 'roles.role_id = admin.role_id');
        $this->db->like('admin.id_admin', $keyword);
        $this->db->or_like('admin.nama', $keyword);
        $this->db->or_like('admin.email', $keyword);
        $this->db->or_like('admin.username', $keyword);
        $this->db->or_like('admin.foto', $keyword);
        $this->db->or_like('roles.nama_role', $keyword);

        return $this->db->get()->result();
    }
    
}
