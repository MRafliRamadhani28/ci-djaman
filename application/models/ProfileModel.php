<?php
class ProfileModel extends CI_Model {


    public function getProfileById($id_profile)
    {
        $this->db->where('id_admin', $id_profile);
        return $this->db->get('admin')->row();
    }

    public function updateProfile($id, $data)
    {
        $this->db->where('id_admin', $id);
        $this->db->update('admin', $data);
    }

    public function updateProfileByEmail($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('admin', $data);
    }

    public function updateProfileByEmailPembeli($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->update('pengguna', $data);
    }

     // Menyimpan token ke database
    public function insertToken($data)
    {
        $this->db->insert('reset_password_tokens', $data);
    }

    public function getProfileByEmail($email)
    {
        $this->db->select('admin.id_admin, admin.nama, admin.email, admin.username, admin.password, admin.foto, roles.role_id, roles.nama_role, admin.status_aktif');
        $this->db->from('admin');
        $this->db->join('roles', 'roles.role_id = admin.role_id');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $this->db->order_by('id_admin', 'desc');
        return $this->db->get()->row();
    }

    public function getProfileByEmailPembeli($email)
    {
        $this->db->select('pengguna.id_pengguna, pengguna.nama, pengguna.email, pengguna.username, pengguna.password, pengguna.status');
        $this->db->from('pengguna');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $this->db->order_by('id_pengguna', 'desc');
        return $this->db->get()->row();
    }

    // Mencari token berdasarkan email
    public function findTokenByToken($token)
    {
        $query = $this->db->get_where('reset_password_tokens', array('token' => $token));
        return $query->row();
    }

    // Menghapus token setelah digunakan atau kadaluarsa
    public function deleteToken($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('reset_password_tokens');
    }
    
}
