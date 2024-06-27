<?php

class ResiModel extends CI_Model {
    public function getResiPerTransaksi() {
        $this->db->select('resi.*, transaksi.kode_transaksi, pengguna.nama AS pembeli')
        ->join('transaksi', 'transaksi.id = resi.transaksi_id')
        ->join('pengguna', 'pengguna.id = transaksi.pengguna_id');

        return $this->db->get('resi')->result();
    }

    public function getTransaksi() {
        $this->db->select('transaksi.kode_transaksi, transaksi.id AS transaksi_id, pengguna.nama AS pembeli, pengguna.id AS pembeli_id')
        ->join('pengguna', 'pengguna.id = transaksi.pengguna_id')
        ->join('resi', 'resi.transaksi_id = transaksi.id', 'left')
        ->where('transaksi.status', 'Dikirim')
        ->where('resi.transaksi_id IS NULL');
        $query = $this->db->get('transaksi');

        return $query->result_array();
    }

    public function getAllTransaksi($resiId) {
        $this->db->select('transaksi.kode_transaksi, transaksi.id AS transaksi_id, pengguna.nama AS pembeli, pengguna.id AS pembeli_id')
        ->join('pengguna', 'pengguna.id = transaksi.pengguna_id')
        ->join('resi', 'resi.transaksi_id = transaksi.id', 'left')
        ->where('transaksi.status', 'Dikirim')
        ->where('resi.transaksi_id IS NULL')
        ->or_where('resi.id', $resiId);
        $query = $this->db->get('transaksi');

        return $query->result_array();
    }

    public function getResiById($resiId) {
        $this->db->select('transaksi.kode_transaksi, transaksi.id AS transaksi_id, resi.no_resi, resi.id, pengguna.nama AS pembeli, pengguna.id AS pembeli_id')
        ->join('pengguna', 'pengguna.id = transaksi.pengguna_id')
        ->join('resi', 'resi.transaksi_id = transaksi.id', 'left')
        ->where('transaksi.status', 'Dikirim')
        ->where('resi.id', $resiId);
        $result = $this->db->get('transaksi');
    
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function editResi($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('resi', $data);
    }
}