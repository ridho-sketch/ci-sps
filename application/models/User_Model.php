<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public $table = 'user';
    public $id = 'user.id';

    var $column_order = array(null, 'email', 'akses', 'last_login', 'create_date', null);
    var $column_search = array('email'); 
    var $order = array('email' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Karyawan_Model');
    }

    public function get_user()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_admin()
    {
        $this->db->from($this->table);
        $this->db->where('akses = 1');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_pengaju()
    {
        $this->db->from($this->table);
        $this->db->where('akses = 2');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('karyawan', 'karyawan.id_karyawan = user.karyawan_id', 'left');

        // Tambahkan klausa WHERE untuk mengecualikan ID user 0
        $this->db->where('user.id !=', 0);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_karyawan()
    {
        return $this->Karyawan_Model->get();
    }
    public function getByIdFromSession($user_id = NULL)
    {
        // Ambil user_id dari session jika tidak disediakan sebagai parameter
        if (!$user_id) {
            $user_id = $this->session->userdata('id');
        }

        if ($user_id) {
            $this->db->select('*');
            $this->db->from($this->table2);
            $this->db->join($this->table, 'karyawan.id_karyawan = user.karyawan_id');
            $this->db->where('user.id', $user_id);
            $query = $this->db->get();
            return $query->row_array();
        } else {
            return NULL;
        }
    }

    public function check_username_exists($username)
    {
        $this->db->where('email', $username);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }
    public function insertKUser($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id(); // Mengembalikan ID user yang baru saja dimasukkan
    }

    public function get_all_karyawan()
    {
        return $this->db->get('karyawan
        ')->result_array();
    }
    public function updateUser($user_id, $email, $password, $status, $modified_date, $modified_by)
    {

        // Contoh sederhana, di sini kita akan melakukan update ke tabel user dengan data yang diberikan
        $data = array(
            'email' => $email,
            'password' => $password, // Password yang sudah di-hash atau password yang sudah ada di database
            'status' => $status,
            'modified_date' => $modified_date,
            'modified_by' => $modified_by,
            // 'karyawan_id' => $karyawan_id
        );

        $this->db->where('id', $user_id);
        $this->db->update('user', $data);

        return $this->db->affected_rows() > 0;
    }

    public function editAkun($user_id, $email, $password, $status, $modified_date, $modified_by)
    {
        // Contoh sederhana, di sini kita akan melakukan update ke tabel user dengan data yang diberikan
        $data = array(
            'email' => $email,
            'password' => $password, // Password yang sudah di-hash atau password yang sudah ada di database
            'status' => $status,
            'modified_date' => $modified_date,
            'modified_by' => $modified_by
        );

        $this->db->where('id', $user_id);
        $this->db->update('user', $data);

        return $this->db->affected_rows() > 0;
    }

    public function insertSuperAdmin($admin_data)
    {
        // Hash password dengan bcrypt sebelum disimpan ke database
        $admin_data['password'] = password_hash($admin_data['password'], PASSWORD_BCRYPT);

        $this->db->insert('user', $admin_data);

        // Jika ada baris yang terpengaruh, return true; jika tidak, return false
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    // public function insertPengaju($email, $password, $akses, $status, $create_date, $create_by, $karyawan_id)
    // {
    //     // Hash password dengan SHA2 sebelum disimpan ke database
    //     $hashedPassword = hash('sha224', $password);

    //     // Proses penyimpanan ke database
    //     $data = array(
    //         'email' => $email,
    //         'password' => $hashedPassword,
    //         'akses' => $akses,
    //         'status' => $status,
    //         'create_date' => $create_date,
    //         'create_by' => $create_by,
    //         'karyawan_id' => $karyawan_id
    //     );

    //     $this->db->insert('user', $data);

    //     // Jika ada baris yang terpengaruh, return true; jika tidak, return false
    //     return ($this->db->affected_rows() > 0) ? true : false;
    // }

    public function insertKPengaju($data)
    {
        // Masukkan data pengguna ke dalam tabel pengguna
        $this->db->insert('user', $data);
    }
    public function isUserExist($karyawan_id)
    {
        // Lakukan pencarian user berdasarkan karyawan_id
        $this->db->where('karyawan_id', $karyawan_id);
        $query = $this->db->get('user');

        // Periksa apakah ada baris hasil query
        return $query->num_rows() > 0;
    }

    public function deleteUser($userId)
    {
        if (!empty($userId) && is_numeric($userId)) {
            // Dapatkan id_karyawan dari tabel user
            $karyawanId = $this->getKaryawanIdByUserId($userId);

            if ($karyawanId !== false) {
                $this->db->trans_start(); // Memulai transaksi database

                // Hapus data karyawan berdasarkan id_karyawan
                $this->db->where('id_karyawan', $karyawanId);
                $this->db->delete('karyawan');

                // Hapus data pengajuan yang terkait dengan karyawan yang akan dihapus
                $this->db->where('id_karyawan', $karyawanId);
                $this->db->delete('pengajuan');

                // Hapus data pengikut yang terkait dengan karyawan yang akan dihapus
                $this->db->where('id_karyawan', $karyawanId);
                $this->db->delete('pengikut');

                // Hapus data pengguna (user)
                $this->db->where('id', $userId);
                $this->db->delete('user');

                $this->db->trans_complete(); // Menyelesaikan transaksi database

                // Kembalikan status transaksi
                return $this->db->trans_status();
            } else {
                // Jika id_karyawan tidak ditemukan, kembalikan false
                return false;
            }
        } else {
            return false; // Jika $userId tidak valid, kembalikan false
        }
    }

    private function getKaryawanIdByUserId($userId)
    {
        // Lakukan query untuk mendapatkan id_karyawan dari tabel user
        $this->db->select('karyawan_id');
        $this->db->where('id', $userId);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->karyawan_id;
        } else {
            return false;
        }
    }




    public function getUserAccess($user_id)
    {
        // Lakukan query untuk mengambil akses pengguna dari database berdasarkan user_id
        $this->db->select('akses');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->akses;
        } else {
            return false;
        }
    }

    public function getUserById($userId)
    {
        $this->db->where('id', $userId);
        $query = $this->db->get('user');
        return $query->row_array();
    }
    public function insert_pengguna($user_data)
    {
        // Menghasilkan hash SHA-224 dari password
        // $user_data['password'] = hash('sha224', $user_data['password']);
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);


        $this->db->insert('user', $user_data);

        return $this->db->insert_id();
    }


    public function isEmailUnique($email, $user_id)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $user_id); // Exclude the current user id
        $query = $this->db->get('user');
        return $query->num_rows() == 0;
    }

    public function deleteUserByKaryawanId($karyawanId)
    {
        $this->db->where('karyawan_id', $karyawanId);
        $this->db->delete('user');
        return $this->db->affected_rows() > 0;
    }
    // public function get_filtered_data($start, $length, $search, $access)
    // {
    //     $this->db->like('email', $search);
    //     $this->db->where('akses', $access);
    //     $this->db->limit($length, $start);
    //     $query = $this->db->get('user');
    //     return $query->result_array();
    // }

    // public function get_total_records($access)
    // {
    //     $this->db->where('akses', $access);
    //     return $this->db->count_all_results('user');
    // }

    // public function get_filtered_records_count($search, $access)
    // {
    //     $this->db->like('email', $search);
    //     $this->db->where('akses', $access);
    //     $query = $this->db->get('user');
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
 
    function get_datatables($akses)
    {
        $this->_get_datatables_query();
        $this->db->where('akses', $akses);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($akses)
    {
        $this->_get_datatables_query();
        $this->db->where('akses', $akses);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($akses)
    {
        $this->db->from($this->table);
        $this->db->where('akses', $akses);
        return $this->db->count_all_results();
    }
}
?>