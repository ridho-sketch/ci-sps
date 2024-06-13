<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_Model extends CI_Model
{
    public $table = 'karyawan';
    public $id = 'karyawan.id_karyawan';
    var $column_order = array(null, 'no_pekerja', 'nama', 'golongan_upah', 'departemen', 'jabatan', 'tanggal_lahir', null);
    var $column_search = array('nama', 'departemen', 'jabatan');
    var $order = array('nama' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    public function get_karyawan()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getNamaKaryawan()
    {
        // Gantilah 'nama_tabel_karyawan' dengan nama tabel karyawan yang sesuai pada database Anda
        return $this->db->get('karyawan')->result_array();
    }
    public function insert_karyawan($data)
    {
        try {
            // Jika jabatan adalah 'Direktur', maka set nilai departemen menjadi NULL
            if ($data['jabatan'] === 'Direktur') {
                $data['departemen'] = '-';
            }

            // Masukkan data karyawan ke dalam tabel karyawan
            $this->db->insert('karyawan', $data);

            // Mengembalikan ID karyawan yang baru ditambahkan
            return $this->db->insert_id();
        } catch (Exception $e) {
            // Tangani kesalahan jika ada
            log_message('error', 'Error occurred while inserting karyawan: ' . $e->getMessage());
            return false; // Kembalikan false jika terjadi kesalahan
        }
    }

    public function getKaryawanById($id)
    {
        $this->db->where('id_karyawan', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function get_karyawan_by_id($id_karyawan)
    {
        return $this->db->get_where('karyawan', array('id_karyawan' => $id_karyawan))->row_array();
    }
    public function getArrayKaryawanById($id_karyawan)
    {
        $this->db->where_in('id_karyawan', $id_karyawan);
        $query = $this->db->get('karyawan');
        return $query->result();
    }
    public function getKaryawanByNoPekerja($no_pekerja)
    {
        $this->db->where('no_pekerja', $no_pekerja);
        return $this->db->get('karyawan')->row_array();
    }


    public function update_karyawan($id, $data_karyawan)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data_karyawan);
        return $this->db->affected_rows();
    }

    public function delete_karyawan($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    public function hapus_semua_karyawan($ids)
    {
        // Melakukan penghapusan data berdasarkan id yang diberikan

        // Melakukan sanitasi ids yang diterima
        $sanitized_ids = array_map('intval', $ids);
        $ids_string = implode(',', $sanitized_ids); // Menggabungkan ids menjadi string terpisah koma

        // Lakukan kueri penghapusan
        $sql = "DELETE FROM nama_tabel WHERE id IN ($ids_string)";

        // Eksekusi kueri penghapusan
        $this->db->query($sql);

        // Alternatif menggunakan active record
        // $this->db->where_in('id', $sanitized_ids);
        // $this->db->delete('nama_tabel');

        // Beri respons sukses atau gagal
        return ($this->db->affected_rows() > 0);
    }
    public function deleteSelectedKaryawan($checked_id)
    {
        $this->db->where_in('id', $checked_id);
        return $this->db->delete('karyawan');
    }
    public function get_karyawan_by_no_pekerja($no_pekerja)
    {
        // Lakukan query untuk mengambil data karyawan dari database berdasarkan nomor pekerja
        $this->db->where('no_pekerja', $no_pekerja);
        $query = $this->db->get('karyawan');

        // Mengembalikan hasil query
        return $query->row();

    }

    public function check_employee_exists($no_pekerja)
    {
        // Cek apakah nomor pekerja sudah ada dalam database
        $this->db->where('no_pekerja', $no_pekerja);
        $query = $this->db->get('karyawan');
        return $query->num_rows() > 0;
    }

    public function check_nama_exists($nama)
    {
        $this->db->where('nama', $nama);
        $query = $this->db->get('karyawan');

        // If there is a row returned, the name exists
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteKaryawan($karyawanId)
    {
        $this->db->trans_start(); // Memulai transaksi database

        // Hapus data karyawan berdasarkan id_karyawan
        $this->db->where('id_karyawan', $karyawanId);
        $this->db->delete('karyawan');

        // Hapus data pengikut yang terkait dengan karyawan yang akan dihapus
        $this->db->where('id_karyawan', $karyawanId);
        $this->db->delete('pengikut');

        // Hapus data pengajuan yang terkait dengan karyawan yang akan dihapus
        $this->db->where('id_karyawan', $karyawanId);
        $this->db->delete('pengajuan');

        // Hapus data pengguna (user) yang berkaitan dengan karyawan yang dihapus
        $this->db->where('karyawan_id', $karyawanId);
        $this->db->delete('user');

        $this->db->trans_complete(); // Menyelesaikan transaksi database

        // Kembalikan status transaksi
        return $this->db->trans_status();
    }
    public function pengikut($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_karyawan !=', $id_karyawan);
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function get_filtered_data($start, $length, $search)
    // {
    //     $this->db->like('nama', $search);
    //     $this->db->or_like('departemen', $search);
    //     $this->db->or_like('jabatan', $search);
    //     $this->db->limit($length, $start);
    //     $query = $this->db->get('karyawan');
    //     return $query->result_array();
    // }

    // public function get_total_records()
    // {
    //     return $this->db->count_all('karyawan');
    // }

    // public function get_filtered_records_count($search)
    // {
    //     $this->db->like('nama', $search);
    //     $this->db->or_like('departemen', $search);
    //     $this->db->or_like('jabatan', $search);
    //     $query = $this->db->get('karyawan');
    //     return $query->num_rows();
    // }

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

}
