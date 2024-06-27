<?php
class OrganisasiModel extends CI_Model {

    public function getOrganisasi(){
        $query = $this->db->get('data_organisasi');
        return $query->result();
    }

    public function getOrganisasiById($id_anggota)
    {
        $this->db->where('id_anggota', $id_anggota);
        $query = $this->db->get('data_organisasi');
        return $query->row();
    }
    public function updateOrganisasi($id_anggota, $data)
    {
        $this->db->where('id_anggota', $id_anggota);
        $this->db->update('data_organisasi', $data);
    }

    public function hapusOrganisasi($id_anggota)
    {
        $this->db->where('id_anggota', $id_anggota);
        $this->db->delete('data_organisasi');
    }
    public function searchOrganisasi($keyword) {
        $this->db->like('id_anggota', $keyword);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->or_like('email', $keyword);

        return $this->db->get('data_organisasi')->result();

    }
}
