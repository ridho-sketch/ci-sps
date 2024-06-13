<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model{

    function query_validasi_email($email){
    	$result = $this->db->query("SELECT * FROM user WHERE email='$email' LIMIT 1");
        return $result;
    }

    public function update_last_login($user_id)
    {
        $this->db->set('last_login', 'NOW()', FALSE);
        $this->db->where('id', $user_id);
        $this->db->update('user');
    }

    public function query_validasi_password($email, $password) {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('email', $email);
        $result = $this->db->get();
    
        if ($result->num_rows() == 1) {
            $hashedPassword = $result->row()->password;
    
            // Verifikasi password menggunakan bcrypt
            if (password_verify($password, $hashedPassword)) {
                // Jika password cocok, ambil data user
                $userQuery = $this->db->get_where('user', array('email' => $email), 1);
                if ($userQuery->num_rows() == 1) {
                    return $userQuery->row_array();
                } else {
                    return false;
                }
            } else {
                // Password tidak cocok
                return false;
            }
        } else {
            // Email tidak ditemukan
            return false;
        }
    }

    function getKaryawanData($karyawan_id) {
        $this->db->select('user.*, karyawan.*'); 
        $this->db->from('user'); 
        $this->db->join('karyawan', 'user.karyawan_id = karyawan.id_karyawan'); 
        $this->db->where('user.karyawan_id', $karyawan_id); 
    
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null; 
        }
    }
    

} 