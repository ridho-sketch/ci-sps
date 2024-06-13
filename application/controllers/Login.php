<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                          MEMUAT                                                             ///////
    ///////                               MODEL DAN LIBRARY YANG DIGUNAKAN                                              ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin', 'Mlogin');
        $this->load->model('Karyawan_Model');
        $this->load->library('session');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              MEMUAT                                                         ///////
    ///////                                          HALAMAN LOGIN                                                      ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function index()
    {
        if ($this->session->userdata('logged') != TRUE) {
            $this->load->view('Login/header');
            $this->load->view('Login/index');
            $this->load->view('Login/footer');
        } else {
            $url = base_url('home');
            redirect($url);
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                            MELAKUKAN                                                        ///////
    ///////                        AUTENTIKASI KETIKA USER MENGINPUTKAN USERNAME DAN PASSWORD                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function autentikasi()
{
    $email = $this->input->post('email');
    $password = $this->input->post('pass');

    if (empty($email) || empty($password)) {
        $this->session->set_flashdata('msg', '
        <h3 class="mt-4 mb-2" style="text-align:center !important;">Uupps!</h3>
        <p>Silahkan lengkapi email dan password.</p>
    ');
        redirect('login');
    }

    $user_data = $this->Mlogin->query_validasi_password($email, $password);

    if ($user_data !== false) {
        if ($user_data['status'] == '1') {
            $this->session->set_userdata('logged', TRUE);
            $this->session->set_userdata('user', $email);
            $karyawan_id = $user_data['karyawan_id'];
            $this->session->set_userdata('karyawan_id', $karyawan_id);

            $this->load->model('Karyawan_Model');
            $karyawan_data = $this->Karyawan_Model->getKaryawanById($karyawan_id);

            if ($karyawan_data) {
                echo "Nama Karyawan: " . $karyawan_data['nama'];
                echo "Nomor Pekerja: " . $karyawan_data['no_pekerja'];
            } else {
                echo "Data karyawan tidak ditemukan.";
            }

            $name = $user_data['name'];
            switch ($user_data['akses']) {
                case '1':
                    $access_role = 'SuperAdmin';
                    break;
                case '3':
                    $access_role = 'HCM';
                    break;
                default:
                    $access_role = 'Pengaju';
            }

            $this->session->set_userdata('access', $access_role);
            $this->session->set_userdata('id', $user_data['id']);
            $this->session->set_userdata('name', $name);
            $this->session->set_userdata('userdata', $user_data);

            if ($karyawan_data) {
                $this->session->set_userdata('karyawan_data', $karyawan_data);
            }
            
            $this->load->model('Mlogin'); 
            $this->Mlogin->update_last_login($user_data['id']);

            redirect('home');
        } else {
            $this->session->set_flashdata('msg', '
            <h3 class="mt-4 mb-2" style="text-align:center !important;">Uupps!</h3>
            <p>Akun kamu telah diblokir. Silahkan hubungi admin.</p>
        ');
            redirect('login');
        }
    } else {
        $this->session->set_flashdata('msg', '
        <h3 class="mt-4 mb-2" style="text-align:center !important;">Uupps!</h3>
        <p>Email atau password yang kamu masukan salah.</p>
    ');
        redirect('login');
    }
}

    private function updateSessionData($user_data)
    {
        $updated_user_data = array(
            'logged' => TRUE,
            'user' => $user_data['email'],
            'access' => ($user_data['akses'] == '1') ? 'SuperAdmin' : 'Pengaju',
            'id' => $user_data['id'],
            'name' => $user_data['name'],
            'userdata' => $user_data
        );

        // Perbarui nilai sesi dengan data yang baru
        $this->session->set_userdata($updated_user_data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////     
    ///////                                       MELAKUKAN                                                             ///////
    ///////                         PENGHAPUSAN DATA SESI KETIKA USER LOG OUT                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('login');
        redirect($url);
    }

}