<?php
defined("BASEPATH") or exit('No direct script acces allowed');
class Pengajuan_Model extends CI_Model
{
    public $table = 'pengajuan';
    public $id = 'pengajuan.id_pengajuan';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_karyawan_id($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_karyawan', $id_karyawan);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->from($this->table);
        ;
        $this->db->where($this->id, $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update($id, $data)
    {
        //$this->db->update($this->table, $data, $where);
        //return $this->db->affected_rows();
        $this->db->where('id_pengajuan', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    public function get_pengikut_by_pengajuan_id($id_pengikut) {
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->where('pengikut', $id_pengikut);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array(); // Mengembalikan array kosong jika tidak ada data
        }
    }
    
    public function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('pengajuan');
        return $this->db->insert_id();
    }
    public function add_pengikut($pengajuan_id, $pengikut_data)
    {
        // Persiapkan data yang akan diupdate
        $data = array(
            'pengikut' => $pengikut_data
        );

        // Lakukan update kolom pengikut untuk data pengajuan dengan id tertentu
        $this->db->where('id_pengajuan', $pengajuan_id);
        $this->db->update($this->table, $data);

        // Kembalikan jumlah baris yang terpengaruh
        return $this->db->affected_rows();
    }

    public function add_nomor_surat($pengajuan_id, $nomor_surat)
    {
        // Persiapkan data yang akan diupdate
        $data = array(
            'nomor_surat' => $nomor_surat
        );

        // Lakukan update kolom pengikut untuk data pengajuan dengan id tertentu
        $this->db->where('id_pengajuan', $pengajuan_id);
        $this->db->update($this->table, $data);

        // Kembalikan jumlah baris yang terpengaruh
        return $this->db->affected_rows();
    }
    public function simpan_pengajuan($data_pengajuan, $data_pengikut) {
        // Simpan data pengajuan
        $this->db->insert('pengajuan', $data_pengajuan);
        $id_pengajuan = $this->db->insert_id();

        // Simpan data pengikut
        foreach ($data_pengikut as $pengikut) {
            $pengikut['id_pengajuan'] = $id_pengajuan;
            $this->db->insert('pengikut', $pengikut);
        }

        return $id_pengajuan;
    }
    
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
?>