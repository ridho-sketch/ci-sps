<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengikut_model extends CI_Model {

    public function hapus_pengikut_by_pengajuan($id_pengajuan) {
        $this->db->where('id_pengajuan', $id_pengajuan);
        $this->db->delete('pengikut');
    }

}
?>
