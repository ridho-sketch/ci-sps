<?php
defined("BASEPATH") or exit('No direct script acces allowed');
class Kota_Model extends CI_Model
{
    public $table = 'kota';
    public $id = 'kota.id_kota';
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
}
?>