<?php
defined("BASEPATH") or exit('No direct script acces allowed');
class Pengajuan_Model extends CI_Model
{
    public $table = 'pengajuan';
    public $id = 'pengajuan.id_pengajuan';
    var $column_order = array(null, 'nomor_surat', 'judul_pengajuan', 'jenis_pengajuan', 'date_create', 'kota_tujuan', 'tanggal_mulai', 'tanggal_kembali', null);
    var $column_search = array('nomor_surat', 'judul_pengajuan', 'kota_tujuan');
    var $order = array('judul_pengajuan' => 'asc');

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
        $this->db->where('id_pengajuan', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    public function get_pengikut_by_pengajuan_id($id_pengikut)
    {
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->where('pengikut', $id_pengikut);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function insert($data_pengajuan)
    {
        $this->db->insert('pengajuan', $data_pengajuan);
        $id_pengajuan = $this->db->insert_id();
        return $id_pengajuan;
    }

    public function add_pengikut($pengajuan_id, $pengikut_data)
    {
        $data = array(
            'pengikut' => $pengikut_data
        );

        $this->db->where('id_pengajuan', $pengajuan_id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function add_nomor_surat($pengajuan_id, $nomor_surat)
    {
        $data = array(
            'nomor_surat' => $nomor_surat
        );

        $this->db->where('id_pengajuan', $pengajuan_id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }
    public function simpan_pengajuan($data_pengajuan, $data_pengikut)
    {
        $this->db->insert('pengajuan', $data_pengajuan);
        $id_pengajuan = $this->db->insert_id();

        foreach ($data_pengikut as $pengikut) {
            $pengikut['id_pengajuan'] = $id_pengajuan;
            $this->db->insert('pengikut', $pengikut);
        }

        return $id_pengajuan;
    }

    public function isNomorUnique($nomor_surat, $id_pengajuan)
    {
        $this->db->where('nomor_surat', $nomor_surat);
        $this->db->where('id_pengajuan !=', $id_pengajuan);
        $query = $this->db->get('pengajuan');
        return $query->num_rows() == 0;
    }

    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    public function countPengajuanByType($jenis_pengajuan)
    {
        $this->db->where('jenis_pengajuan', $jenis_pengajuan);
        return $this->db->count_all_results('pengajuan');
    }

    public function PengajuanTipeId($jenis_pengajuan, $id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('jenis_pengajuan', $jenis_pengajuan);
        return $this->db->count_all_results('pengajuan');
    }

    public function get_surat_data()
    {
        $this->db->select("YEAR(STR_TO_DATE(tanggal_mulai, '%d-%m-%Y')) AS tahun,
                   SUM(CASE WHEN jenis_pengajuan = 'dinas luar negri' THEN 1 ELSE 0 END) AS dln,
                   SUM(CASE WHEN jenis_pengajuan = 'dinas dalam negri' THEN 1 ELSE 0 END) AS ddn");
        $this->db->from('pengajuan');
        $this->db->group_by("YEAR(STR_TO_DATE(tanggal_mulai, '%d-%m-%Y'))");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function get_filtered_data($start, $length, $search, $jenis)
    {
        $this->db->group_start();
        $this->db->like('judul_pengajuan', $search);
        $this->db->or_like('jenis_pengajuan', $search);
        $this->db->or_like('kota_tujuan', $search);
        $this->db->group_end();
        $this->db->where('jenis_pengajuan', $jenis);
        $this->db->limit($length, $start);
        $query = $this->db->get('pengajuan');
        return $query->result_array();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_datatables_pengaju($id_karyawan)
    {
        $this->_get_datatables_query();
        $this->db->where('id_karyawan', $id_karyawan);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_pengaju($id_karyawan)
    {
        $this->_get_datatables_query();
        $this->db->where('id_karyawan', $id_karyawan);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_pengaju($id_karyawan)
    {
        $this->db->from($this->table);
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->count_all_results();
    }
}
?>