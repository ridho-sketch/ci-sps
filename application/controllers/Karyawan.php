<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
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
    ///////                                             DATA                                                            ///////
    ///////                                           KARYAWAN                                                          ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                             Create                                                          ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function create()
    {

        if ($this->session->userdata('logged') == TRUE) {



            $userdata = $this->session->userdata('userdata');

            if ($userdata['akses'] != '1') {

                redirect('home/error403');
            }

            // $userdata = $this->session->userdata('userdata');

            $data['judul'] = 'Tambah Karyawan';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');

            if ($this->input->post('submit')) {

                $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama Karyawan Wajib di isi']);
                $this->form_validation->set_rules('no_pekerja', 'Nomor Pekerja', 'required|is_unique[karyawan.no_pekerja]', [
                    'required' => 'Nomor Pekerja Wajib di isi',
                    'required|numeric',
                    'is_unique' => 'Nomor Pekerja sudah digunakan, silakan gunakan Nomor Pekerja lain.'
                ]);
                $this->form_validation->set_rules('golongan_upah', 'Golongan Upah', 'required', ['required' => 'Golongan Upah Wajib di isi']);
                $this->form_validation->set_rules('jabatan', 'Jabatan', 'required', ['required' => 'Jabatan Wajib di isi']);
                $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', ['required' => 'Tanggal Lahir Wajib di isi']);

                // Set rule Departemen hanya jika jabatan yang dipilih bukan General Manager atau Direktur
                if (!$this->input->post('jabatan') == "General Manager" && !$this->input->post('jabatan') == "Direktur") {
                    $this->form_validation->set_rules('departemen', 'Departemen', 'required', ['required' => 'Departemen Wajib di isi']);
                }

                $this->form_validation->set_rules('akses', 'Akses', 'required', ['required' => 'Role Wajib di isi']);
                $this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'Email Wajib di isi']);
                $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
                $this->form_validation->set_rules('retype_password', 'Retype Password', 'matches[password]');

                if ($this->form_validation->run() == TRUE) {

                    $this->load->model('Karyawan_Model');
                    $this->load->model('User_Model');

                    $nama = $this->input->post('nama');
                    $no_pekerja = $this->input->post('no_pekerja');
                    $golongan_upah = $this->input->post('golongan_upah');
                    $jabatan = $this->input->post('jabatan');
                    $tanggal_lahir = $this->input->post('tanggal_lahir');
                    $departemen = $this->input->post('departemen');

                    $karyawan_data = array(
                        'nama' => $nama,
                        'no_pekerja' => $no_pekerja,
                        'golongan_upah' => $golongan_upah,
                        'jabatan' => $jabatan,
                        'tanggal_lahir' => $tanggal_lahir,
                        'departemen' => $departemen,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => $this->session->userdata('id'),
                    );
                    $karyawan_id = $this->Karyawan_Model->insert_karyawan($karyawan_data);

                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $akses = $this->input->post('akses');

                    if (empty($password)) {
                        $password = 'bsp2024';
                    }

                    $user_data = array(
                        'email' => $email,
                        'password' => $password,
                        'akses' => $akses,
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => $this->session->userdata('id'),
                        'karyawan_id' => $karyawan_id
                    );
                    $this->User_Model->insert_pengguna($user_data);

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Karyawan dan Pengguna Berhasil Diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-times" style="font-size:20px;"></span>
                </button></div>');
                    redirect('Karyawan');
                }
            }

            $this->load->model('Karyawan_Model');
            $data['employees'] = $this->Karyawan_Model->getNamaKaryawan();

            $this->load->view('layout/header', $data);
            $this->load->view('Karyawan/create', $data);
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Read                                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index()
    {

        $data['judul'] = 'Daftar Karyawan';

        if ($this->session->userdata('logged') == TRUE) {

            $userdata = $this->session->userdata('userdata');

            if ($userdata['akses'] != '1') {

                redirect('home/error403');
            }

            $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
            $data['user'] = $this->session->userdata();

            $this->load->view('layout/header', $data);
            $this->load->view('Karyawan/index', $data);
            $this->load->view('layout/footer');

        } else {
            $url = base_url('login');
            redirect($url);
        }
    }
    private function formatDate($dateString)
    {
        $parts = explode('-', $dateString);
        $day = $parts[0];
        $month = $parts[1];
        $year = $parts[2];

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
    public function get_data_karyawan()
    {
        if ($this->input->is_ajax_request() == true) {
            $list = $this->Karyawan_Model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $field->no_pekerja;
                $row[] = $field->nama;
                $row[] = $field->golongan_upah;
                $row[] = $field->departemen;
                $row[] = $field->jabatan;
                $tanggal_lahir = $field->tanggal_lahir;
                $row[] = $this->formatDate($tanggal_lahir);
                $row[] = '<ul class="d-flex justify-content-center">
                <li class="mr-3">
                    <a href="' . base_url('index.php/Karyawan/update/') . $field->id_karyawan .
                    '" class="text-secondary" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                </li>
                <li>
                    <a class="text-danger" title="Hapus" data-toggle="modal" data-target="#hapusModal" onclick="setHapusIdKaryawan(' . $field->id_karyawan .
                    ')">
                        <i class="ti-trash"></i>
                    </a>
                </li>
            </ul>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Karyawan_Model->count_all(),
                "recordsFiltered" => $this->Karyawan_Model->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Edit                                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Update($id)
    {
        if ($this->session->userdata('logged') == TRUE) {


            $userdata = $this->session->userdata('userdata');

            if ($userdata['akses'] != '1') {

                redirect('home/error403');
            }

            $data['judul'] = 'Edit Karyawan';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');

            $data['karyawan'] = $this->Karyawan_Model->getKaryawanById($id);

            $data['user'] = $this->db->get_where('user', [
                'email' => $this->session->userdata('email')
            ])->row_array();

            $this->form_validation->set_rules('nama', 'Nama Karyawan', 'required', ['required' => 'Nama Karyawan Wajib di isi']);
            $this->form_validation->set_rules('no_pekerja', 'Nomor Pekerja', 'required|callback_check_no_pekerja[' . $id . ']', [
                'required' => 'Nomor Pekerja Wajib di isi'
            ]);
            $this->form_validation->set_rules('golongan_upah', 'Golongan Upah', 'required', ['required' => 'Golongan Upah Wajib di isi']);
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'required', ['required' => 'Jabatan Wajib di isi']);
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', ['required' => 'Tanggal Lahir Wajib di isi']);

            // Set rule Departemen hanya jika jabatan yang dipilih bukan General Manager atau Direktur
            if (!$this->input->post('jabatan') == "General Manager" && !$this->input->post('jabatan') == "Direktur") {
                $this->form_validation->set_rules('departemen', 'Departemen', 'required');
            }

            if ($this->form_validation->run() == false) {
                $this->load->view("layout/header", $data);
                $this->load->view("Karyawan/update", $data);
                $this->load->view("layout/footer");

            } else {
                $old_karyawan = $this->Karyawan_Model->getKaryawanById($id);

                $nama = $this->input->post('nama');
                $no_pekerja = $this->input->post('no_pekerja');
                $golongan_upah = $this->input->post('golongan_upah');
                $jabatan = $this->input->post('jabatan');
                $tanggal_lahir = $this->input->post('tanggal_lahir');
                $departemen = $this->input->post('departemen');
                $modified_date = date('Y-m-d H:i:s');
                $modified_by = $this->session->userdata('id');

                // Jika jabatan adalah General Manager atau Direktur, atur nilai Departemen menjadi strip "-"
                if ($jabatan == 'General Manager' || $jabatan == 'Direktur') {
                    $departemen = '-';
                }

                $data_karyawan = [
                    'nama' => !empty($nama) ? $nama : $old_karyawan['nama'],
                    'no_pekerja' => !empty($no_pekerja) ? $no_pekerja : $old_karyawan['no_pekerja'],
                    'golongan_upah' => !empty($golongan_upah) ? $golongan_upah : $old_karyawan['golongan_upah'],
                    'jabatan' => !empty($jabatan) ? $jabatan : $old_karyawan['jabatan'],
                    'tanggal_lahir' => !empty($tanggal_lahir) ? $tanggal_lahir : $old_karyawan['tanggal_lahir'],
                    'departemen' => $departemen,
                    'modified_date' => $modified_date,
                    'modified_by' => $modified_by
                ];

                $result = $this->Karyawan_Model->update_karyawan($id, $data_karyawan);

                if ($result) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Karyawan Berhasil Diubah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-times" style="font-size:20px;"></span>
                </button></div>');
                    redirect('Karyawan');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal mengubah data karyawan. Silakan coba lagi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-times" style="font-size:20px;"></span>
                </button></div>');
                    redirect('Karyawan/update/' . $id);
                }
            }
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }

    public function check_no_pekerja($no_pekerja, $id)
    {
        $existing_karyawan = $this->Karyawan_Model->getKaryawanByNoPekerja($no_pekerja);
        if (!empty($existing_karyawan) && $existing_karyawan['id_karyawan'] != $id) {

            $this->form_validation->set_message('check_no_pekerja', 'Nomor Pekerja sudah digunakan, silakan gunakan Nomor Pekerja lain.');
            $this->session->set_flashdata('no_pekerja_message', 'Nomor Pekerja sudah digunakan, silakan gunakan Nomor Pekerja lain.');
            return false;

        }
        return true;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Delete                                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Delete($karyawanId)
    {
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }

        $userdata = $this->session->userdata('userdata');
        if ($userdata['akses'] != '1') {
            redirect('home');
        }

        if (!empty($karyawanId) && is_numeric($karyawanId)) {

            // $result_user = $this->User_Model->deleteUserByKaryawanId($karyawanId);
            $result_karyawan = $this->Karyawan_Model->deleteKaryawan($karyawanId);


            if ($result_karyawan) {

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Karyawan dan Pengguna terkait berhasil dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-times" style="font-size:20px;"></span>
                </button></div>');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal menghapus karyawan atau pengguna terkait. Silakan coba lagi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-times" style="font-size:20px;"></span>
                </button></div>');
            }
        } else {
            $this->session->set_flashdata('message', 'ID karyawan tidak valid.');
        }

        redirect('Karyawan/');
    }
}