<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                         Load Model                                                          ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin', 'Mlogin');
        $this->load->model('Karyawan_Model');
        $this->load->model('User_Model');
        $this->load->model('Pengajuan_Model');
        $this->load->model('Pengikut_Model');

    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                            DATA                                                             ///////
    ///////                                            USER                                                             ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                      CREATE SUPER ADMIN                                                     ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Create()
    {

        $userdata = $this->session->userdata('userdata');

        if ($userdata['akses'] = '1') {

            $data['judul'] = 'Tambah Akun SuperAdmin';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');

            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]', [
                    'required' => 'Email harus diisi.',
                    'is_unique' => 'Email sudah digunakan, silakan gunakan email lain.'
                ]);

                $password = $this->input->post('password');
                $retype_password = $this->input->post('retype_password');

                if (empty($password) && empty($retype_password)) {
                    $password = 'bsp2024';
                    $retype_password = 'bsp2024';
                } else {
                    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                    $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');
                }

                if ($this->form_validation->run() == TRUE) {
                    $this->load->model('User_Model');

                    $admin_data = array(
                        'email' => $this->input->post('email'),
                        'password' => $password,
                        'akses' => 1,
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => $this->session->userdata('id')
                    );

                    $result = $this->User_Model->insertSuperAdmin($admin_data);

                    if ($result) {
                        $updated_user_data = $this->User_Model->getUserById($userdata['id']);
                        $this->session->set_userdata('userdata', $updated_user_data);

                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data User Super Admin Berhasil Ditambah!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times" style="font-size:20px;"></span>
                        </button></div>');
                        redirect('User/');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Akun Super Admin Gagal di Tambah. Silahkan Coba Lagi!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                        redirect('User/');
                    }
                }
            }

            $this->load->view('layout/header', $data);
            $this->load->view('User/create', $data);
            $this->load->view('layout/footer');
        } else {

            redirect('home/error403');

        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                        Read Semua User                                                      ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index()
    {

        $userdata = $this->session->userdata('userdata');

        if ($userdata['akses'] = '1') {

            $data['judul'] = 'Daftar User';
            $data['user'] = $this->User_Model->get();
            $data['karyawan'] = $this->User_Model->get_all_karyawan();

            $this->load->view('layout/header', $data);
            $this->load->view('User/index', $data);
            $this->load->view('layout/footer');

        } else {

            redirect('home/error403');

        }
    }

    private function formatDate($dateString)
    {
        // Split tanggal menjadi bagian-bagian (tahun, bulan, hari)
        $parts = explode('-', $dateString);
        $day = $parts[2];
        $month = $parts[1];
        $year = $parts[0];

        // Array nama bulan dalam Bahasa Indonesia
        $monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        // Format ulang tanggal
        return $day . ' ' . $monthNames[(int) $month - 1] . ' ' . $year;
    }
    public function get_data_admin()
    {
        if ($this->input->is_ajax_request() == true) {
            $akses = "1";
            $list = $this->User_Model->get_datatables($akses);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $field->email;
                $row[] = ($field->last_login == '0000-00-00 00:00:00') ? 'Belum Pernah Login' : $field->last_login;
                $create_date = date('Y-m-d', strtotime($field->create_date));
                $row[] = $this->formatDate($create_date);
                $row[] = '<ul class="d-flex justify-content-center">
            <li class="mr-3"><a
                    href="' . base_url('User/update/') . $field->id . '"
                    class="text-secondary" title="Edit"><i
                        class="fa fa-edit"></i></a></li>
            <li><a class="text-danger" title="Hapus"
                    data-toggle="modal"
                    data-target="#hapusModal' . $field->id . '"><i
                        class="ti-trash"></i></a>
            </li>
            <li>
                <div class="modal fade"
                    id="hapusModal' . $field->id . '"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"
                            style=" border-radius: 16px;">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus User
                                </h5>
                            </div>
                            <div class="modal-body"
                                style="text-align:left;">
                                <p>Apakah Anda Ingin Menghapus Data
                                    Ini?</p>
                                <input type="hidden"
                                    id="hapusIdUser' . $field->id . '"
                                    name="id"
                                    value="' . $field->id . '">
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Tidak</button>
                                <a
                                    href="' . base_url('User/delete_user/') . $field->id . '"><button
                                        type="button"
                                        class="btn btn-primary">Ya</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->User_Model->count_all($akses),
                "recordsFiltered" => $this->User_Model->count_filtered($akses),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }


    public function get_data_pengaju()
    {
        if ($this->input->is_ajax_request() == true) {
            $akses = "2";
            $list = $this->User_Model->get_datatables($akses);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $field->email;
                $row[] = $field->last_login;
                $create_date = date('Y-m-d', strtotime($field->create_date));
                $row[] = $this->formatDate($create_date);
                $row[] = '<ul class="d-flex justify-content-center">
            <li class="mr-3"><a
                    href="' . base_url('User/update/') . $field->id . '"
                    class="text-secondary" title="Edit"><i
                        class="fa fa-edit"></i></a></li>
            <li><a class="text-danger" title="Hapus"
                    data-toggle="modal"
                    data-target="#hapusModal' . $field->id . '"><i
                        class="ti-trash"></i></a>
            </li>
            <li>
                <div class="modal fade"
                    id="hapusModal' . $field->id . '"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"
                            style=" border-radius: 16px;">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus User
                                </h5>
                            </div>
                            <div class="modal-body"
                                style="text-align:left;">
                                <p>Apakah Anda Ingin Menghapus Data
                                    Ini?</p>
                                <input type="hidden"
                                    id="hapusIdUser' . $field->id . '"
                                    name="id"
                                    value="' . $field->id . '">
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Tidak</button>
                                <a
                                    href="' . base_url('User/delete_user/') . $field->id . '"><button
                                        type="button"
                                        class="btn btn-primary">Ya</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->User_Model->count_all($akses),
                "recordsFiltered" => $this->User_Model->count_filtered($akses),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function get_data_hcm()
    {
        if ($this->input->is_ajax_request() == true) {
            $akses = "3";
            $list = $this->User_Model->get_datatables($akses);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $field->email;
                $row[] = $field->last_login;
                $create_date = date('Y-m-d', strtotime($field->create_date));
                $row[] = $this->formatDate($create_date);
                $row[] = '<ul class="d-flex justify-content-center">
            <li class="mr-3"><a
                    href="' . base_url('User/update/') . $field->id . '"
                    class="text-secondary" title="Edit"><i
                        class="fa fa-edit"></i></a></li>
            <li><a class="text-danger" title="Hapus"
                    data-toggle="modal"
                    data-target="#hapusModal' . $field->id . '"><i
                        class="ti-trash"></i></a>
            </li>
            <li>
                <div class="modal fade"
                    id="hapusModal' . $field->id . '"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"
                            style=" border-radius: 16px;">
                            <div class="modal-header">
                                <h5 class="modal-title">Hapus User
                                </h5>
                            </div>
                            <div class="modal-body"
                                style="text-align:left;">
                                <p>Apakah Anda Ingin Menghapus Data
                                    Ini?</p>
                                <input type="hidden"
                                    id="hapusIdUser' . $field->id . '"
                                    name="id"
                                    value="' . $field->id . '">
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Tidak</button>
                                <a
                                    href="' . base_url('User/delete_user/') . $field->id . '"><button
                                        type="button"
                                        class="btn btn-primary">Ya</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->User_Model->count_all($akses),
                "recordsFiltered" => $this->User_Model->count_filtered($akses),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                          Edit User                                                          ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update($user_id)
    {
        $userdata = $this->session->userdata('userdata');

        if ($userdata['akses'] = '1') {



            $userdata = $this->session->userdata('userdata');

            if ($userdata['akses'] != '1') {

                redirect('home/error403');
            }

            $data['judul'] = 'Edit Akun Pengguna';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');
            $this->load->model('User_Model');

            if ($this->input->post('submit')) {

                $this->form_validation->set_rules('email', 'Email', 'required|callback_email_unique_except[' . $user_id . ']', ['required' => 'Email Wajib di isi']);

                $existing_user = $this->User_Model->getUserById($user_id);
                $password = $existing_user['password'];

                if (!empty($this->input->post('password')) || !empty($this->input->post('retype_password'))) {
                    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                    $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]', ['required' => 'Confirm Password Wajib di isi']);

                    $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }

                if ($this->form_validation->run() == TRUE) {

                    $email = $this->input->post('email');
                    $status = 1;
                    $modified_date = date('Y-m-d H:i:s');
                    $modified_by = $this->session->userdata('id');

                    // $karyawan_id = $user_id['$karyawan_id'];  // Mengambil karyawan_id dari input post

                    $result = $this->User_Model->updateUser($user_id, $email, $password, $status, $modified_date, $modified_by);

                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Akun berhasil diperbarui.            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span class="fa fa-times" style="font-size:20px;"></span>
                 </button></div>');
                        redirect('User/');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Akun Gagal di Ubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                        redirect('User/');
                    }
                }
            }

            $user_data = $this->User_Model->getUserById($user_id);
            $data['user_data'] = $user_data;

            $this->load->model('Karyawan_Model');
            $data['employees'] = $this->Karyawan_Model->getNamaKaryawan();

            $this->load->view('layout/header', $data);
            $this->load->view('User/update', $data);
            $this->load->view('layout/footer');

        } else {
            redirect(home / error404);
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
            $this->form_validation->set_message('email_unique_except', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email sudah digunakan, silakan gunakan email lain.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ');
            return FALSE;
        }

        return TRUE;
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                         Delete User                                                         ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function delete_user($userId)
    {


        $userdata = $this->session->userdata('userdata');

        if ($userdata['akses'] = '1') {

            if (!empty($userId) && is_numeric($userId)) {

                $result = $this->User_Model->deleteUser($userId);

                if ($result) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Akun User Berhasil di Hapus            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span class="fa fa-times" style="font-size:20px;"></span>
                 </button></div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal Menghapus User. Silahkan Coba Lagi!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ID Pengguna Tidak Valid!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            }

            redirect('User/');
        } else {
            redirect('home/error403');
        }
    }
}