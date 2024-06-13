<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') != TRUE) {
            $url = base_url('login');
            redirect($url);
        }

    }

    public function index()
    {
        if ($this->session->userdata('logged') == TRUE) {
            $userdata = $this->session->userdata('userdata');

            // Check access level
            if ($userdata['akses'] == '1') {
                $view = 'SuperAdmin/home';
            } elseif ($userdata['akses'] == '3') {
                $view = 'hcm/home';
            } else {
                $view = 'Pengaju/home';
            }

            $total_pd_dn = 0;
            $total_pd_dl = 0;


            $karyawan_data = $this->session->userdata('karyawan_data');

            // Load model Pengajuan_Model
            $this->load->model('Pengajuan_Model');
            $this->load->model('Karyawan_Model');
            if ($userdata['akses'] == '2') {
                // Mengambil jumlah pengajuan PD-DN
                $total_pd_dn = $this->Pengajuan_Model->PengajuanTipeId('Dinas Dalam Negri', $karyawan_data['id_karyawan']);

                // Mengambil jumlah pengajuan PD-DL
                $total_pd_dl = $this->Pengajuan_Model->PengajuanTipeId('Dinas Luar Negri', $karyawan_data['id_karyawan']);
            } else {
                // Mengambil jumlah pengajuan PD-DN
                $total_pd_dn = $this->Pengajuan_Model->countPengajuanByType('Dinas Dalam Negri');

                // Mengambil jumlah pengajuan PD-DL
                $total_pd_dl = $this->Pengajuan_Model->countPengajuanByType('Dinas Luar Negri');

            }

            $data['judul'] = 'Dashboard';
            $data['karyawan_data'] = $karyawan_data;
            $data['userdata'] = $userdata;
            $data['total_pd_dn'] = $total_pd_dn;
            $data['total_pd_dl'] = $total_pd_dl;

            //data untuk grafik
            $chart_data = $this->Pengajuan_Model->get_surat_data();

            // Data yang akan dikirim ke view
            $data['chart_data'] = $chart_data;

            $this->load->view('layout/header', $data);
            $this->load->view($view, $data);
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }
    public function edit()
    {
        if ($this->session->userdata('logged') == TRUE) {

            $userdata = $this->session->userdata('userdata');
            $user_id = $userdata['id']; // Mengambil ID pengguna dari sesi

            $data['judul'] = 'Edit Akun Pengguna';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');
            $this->load->model('User_Model');

            if ($this->input->post('submit')) {

                $this->form_validation->set_rules('email', 'Email', 'required|callback_email_unique_except[' . $user_id . ']', [
                    'required' => 'Email harus diisi.',
                ]);

                $existing_user = $this->User_Model->getUserById($user_id);
                $password = $existing_user['password'];

                if (!empty($this->input->post('password')) || !empty($this->input->post('retype_password'))) {
                    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                    $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');

                    $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                }

                if ($this->form_validation->run() == TRUE) {

                    $email = $this->input->post('email');
                    $status = 1;
                    $modified_date = date('Y-m-d H:i:s');
                    $modified_by = $user_id; // Menggunakan ID pengguna

                    // $karyawan_id = $this->input->post('employee');

                    $result = $this->User_Model->updateUser($user_id, $email, $password, $status, $modified_date, $modified_by);

                    if ($result) {
                        // Perbarui nilai sesi 'userdata' dengan data pengguna yang baru
                        $user_data = $this->User_Model->getUserById($user_id);
                        $this->session->set_userdata('userdata', $user_data);

                        // Panggil fungsi untuk memperbarui sesi setiap data yang telah dirubah
                        $this->updateSessionData($user_data);

                        $this->session->set_flashdata('msg', 'success');

                        // Tambahkan script JavaScript untuk menunda logout
                        $this->session->set_flashdata('logout', true);
                        redirect('Home/edit');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Akun Gagal di Ubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                        redirect('Home/edit');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Akun Gagal di Ubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

                    redirect('Home/edit');
                }
            }

            $user_data = $this->User_Model->getUserById($user_id);
            $data['user_data'] = $user_data;

            $this->load->model('Karyawan_Model');
            $data['employees'] = $this->Karyawan_Model->getNamaKaryawan();

            $this->load->view('layout/header', $data);
            $this->load->view('vw_edit_profile', $data);
            $this->load->view('layout/footer');

        } else {
            $url = base_url('login');
            redirect($url);
        }
    }

    public function email_unique_except($email, $user_id)
    {
        $previous_email = $this->input->post('previous_email');

        // Jika email tidak diubah, maka validasi lolos
        if ($email == $previous_email) {
            return TRUE;
        }

        // Jika email diubah, lakukan validasi is_unique
        $is_unique = $this->User_Model->isEmailUnique($email, $user_id);

        if (!$is_unique) {
            $this->form_validation->set_message('email_unique_except', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email sudah digunakan, silakan gunakan email lain.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            return FALSE;
        }

        return TRUE;
    }
    // Fungsi untuk mengupdate sesi setiap data yang telah dirubah
    private function updateSessionData($user_data)
    {
        // Membuat array data sesi baru
        $session_data = array(
            'logged' => TRUE,
            'user' => $user_data['email'],
            'access' => ($user_data['akses'] == '1') ? 'SuperAdmin' : 'Pengaju',
            'id' => $user_data['id'],
            'name' => $user_data['name'],
            'userdata' => $user_data
        );

        // Perbarui nilai sesi dengan data yang baru
        $this->session->set_userdata($session_data);
    }



    function error403()
    {
        $this->load->view('403');
    }

}
