<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengikut_model extends CI_Model
{
    public $table = 'pengikut';
    public $id = 'pengikut.id_pengikut';
    public function __construct()
    {
        parent::__construct();
    }

    public function delete($id_pengajuan)
    {
        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->delete('pengikut');
    }

    public function insert($data)
    {
        // Pastikan $data adalah array multidimensi
        if (!empty($data) && is_array($data)) {
            // Lakukan insert batch
            $this->db->insert_batch('pengikut', $data);
            return true;
        } else {
            return false;
        }
    }

    public function getById($id_pengajuan)
    {
        $this->db->where('id_pengajuan', $id_pengajuan);
        $query = $this->db->get('pengikut');
        return $query->result_array();
    }
    public function update($id, $data)
    {
        $this->db->where('id_pengajuan', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
}
?>