<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratPengajuan extends CI_Controller
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
        $this->load->model('Kota_Model');

        $userdata = $this->session->userdata('userdata');

        if ($userdata['akses'] != '1' && $userdata['akses'] != '2' && $userdata['akses'] != '3') {
            redirect('home/error403');
        }
    }

    public function index()
    {
        if ($this->session->userdata('logged') == TRUE) {
            $userdata = $this->session->userdata('userdata');

            $data['judul'] = 'Daftar Surat Pengajuan';
            // $tanggal = '2024-05-31 04:37:56';
            // $datatanggal = date('Y-m-d', strtotime($tanggal));
            // var_dump($datatanggal);

            $this->load->view('layout/header', $data);
            if ($userdata['akses'] == '1') {
                $this->load->view('SuperAdmin/view_daftar_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '2') {
                $this->load->view('Pengaju/view_daftar_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '3') {
                $this->load->view('hcm/view_daftar_surat_pengajuan', $data);
            } else {

                redirect('home/error403');
            }
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }

    private function formatDate($dateString)
    {
        // Split tanggal menjadi bagian-bagian (tahun, bulan, hari)
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

    public function get_data_surat()
    {
        $userdata = $this->session->userdata('userdata');

        if ($this->input->is_ajax_request() == true) {

            if ($userdata['akses'] == '2') {
                $id_karyawan = $this->session->userdata('karyawan_id');
                $list = $this->Pengajuan_Model->get_datatables_pengaju($id_karyawan);
                $recordsTotal = $this->Pengajuan_Model->count_all_pengaju($id_karyawan);
                $recordsFiltered = $this->Pengajuan_Model->count_filtered_pengaju($id_karyawan);
            } else {
                $list = $this->Pengajuan_Model->get_datatables();
                $recordsTotal = $this->Pengajuan_Model->count_all();
                $recordsFiltered = $this->Pengajuan_Model->count_filtered();
            }

            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                $nomor_surat = "No." . $field->nomor_surat . $field->kode_surat;

                $jenis = $field->jenis_pengajuan;
                if ($jenis == "Dinas Dalam Negri") {
                    $jenis_pengajuan = "PD-DN";
                } else {
                    $jenis_pengajuan = "PD-LN";
                }

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $nomor_surat;
                $row[] = $field->judul_pengajuan;
                $jenis = $field->jenis_pengajuan;
                $row[] = $jenis_pengajuan;
                $date_create = date('d-m-Y', strtotime($field->date_create));
                $row[] = $this->formatDate($date_create);
                $row[] = $field->kota_tujuan;
                $tanggal_mulai = $field->tanggal_mulai;
                $row[] = $this->formatDate($tanggal_mulai);
                $tanggal_kembali = $field->tanggal_kembali;
                $row[] = $this->formatDate($tanggal_kembali);
                $row[] = '<ul class="d-flex justify-content-center">
            <li class="mr-3"><a
                    href="' . base_url('index.php/SuratPengajuan/detail_surat/') . $field->id_pengajuan . '"
                    title="detail surat"><i class="ti-info-alt"></i></a>
            </li>
            <li class="mr-3"><a
                    href="' . base_url('index.php/SuratPengajuan/edit_surat/') . $field->id_pengajuan . '"
                    class="text-secondary" title="edit"><i
                        class="fa fa-edit"></i></a>
            </li>
            <li><a class="text-danger" title="hapus" data-toggle="modal"
                    data-target="#hapusModal"
                    onclick="setHapusIdPengajuan(' . $field->id_pengajuan . ')"><i
                        class="ti-trash"></i></a></li>
        </ul>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    private function generate_kode_surat()
    {
        $default_setting = 'SP-HCM';
        $bulan_romawi = $this->get_bulan_romawi(date('n'));
        $tahun = date('Y');

        // Menggabungkan komponen-komponen menjadi nomor surat lengkap
        $nomor_surat = "$default_setting/$bulan_romawi/$tahun";

        return $nomor_surat;
    }

    private function get_bulan_romawi($bulan)
    {
        $romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        return $romawi[$bulan - 1];
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Create                                                           /////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function tambah_pengajuan()
    {
        if ($this->session->userdata('logged') == TRUE) {

            $userdata = $this->session->userdata('userdata');

            $data['judul'] = 'Tambah Pengajuan';
            $data['userdata'] = $userdata;

            $this->load->library('form_validation');

            if ($this->input->post('submit') !== NULL) {
                if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                    $this->form_validation->set_rules('id_karyawan', 'Nama Karyawan', 'required', [
                        'required' => 'Nama Karyawan Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('kode_surat', 'Kode Surat', 'required', [
                        'required' => 'Kode Surat Wajib di isi'
                    ]);
                    // $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'is_unique[pengajuan.nomor_surat]', [
                    //     'is_unique' => 'Nomor Surat sudah digunakan, silakan gunakan Nomor Surat yang lain.'
                    // ]);
                }
                $this->form_validation->set_rules('judul_pengajuan', 'Judul Pengajuan', 'required', [
                    'required' => 'Judul Pengajuan Wajib di isi'
                ]);
                $this->form_validation->set_rules('jenis_pengajuan', 'Tujuan Pengajuan', 'required', [
                    'required' => 'Tujuan Pengajuan Wajib di isi'
                ]);
                $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'required', [
                    'required' => 'Kota Asal Wajib di isi'
                ]);
                $this->form_validation->set_rules('kota_tujuan', 'Kota Tujuan', 'required', [
                    'required' => 'Kota Tujuan Wajib di isi'
                ]);
                $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required', [
                    'required' => 'Tanggal Mulai Wajib di isi'
                ]);
                $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|callback_check_tanggal_kembali', [
                    'required' => 'Tanggal Kembali Wajib di isi'
                ]);
                $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required', [
                    'required' => 'Kendaraan Wajib di isi'
                ]);
                $this->form_validation->set_rules('penanggung_biaya', 'Penanggung Biaya', 'required', [
                    'required' => 'Penanggung Biaya Wajib di isi'
                ]);

                if ($this->form_validation->run() !== FALSE) {

                    $id_user = $this->session->userdata('id');
                    $id_karyawan = $this->session->userdata('karyawan_id');

                    if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                        if ($this->input->post('nomor_surat') == NULL) {
                            $nomor_surat = '        ';
                        } else {
                            $nomor_surat = $this->input->post('nomor_surat');
                        }
                        $data_pengajuan = array(
                            'id_karyawan' => $this->input->post('id_karyawan'),
                            'nomor_surat' => $nomor_surat,
                            'kode_surat' => "/" . $this->input->post('kode_surat'),
                            'judul_pengajuan' => $this->input->post('judul_pengajuan'),
                            'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
                            'kota_asal' => $this->input->post('kota_asal'),
                            'kota_tujuan' => $this->input->post('kota_tujuan'),
                            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                            'kendaraan' => $this->input->post('kendaraan'),
                            'penanggung_biaya' => $this->input->post('penanggung_biaya'),
                            'keterangan' => $this->input->post('keterangan'),
                            'date_create' => date('Y-m-d H:i:s'),
                            'create_by' => $id_user
                        );
                    } elseif ($userdata['akses'] == '2') {
                        $data_pengajuan = array(
                            'id_karyawan' => $id_karyawan,
                            'nomor_Surat' => "        ",
                            'kode_surat' => "/" . $this->generate_kode_surat(),
                            'judul_pengajuan' => $this->input->post('judul_pengajuan'),
                            'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
                            'kota_asal' => $this->input->post('kota_asal'),
                            'kota_tujuan' => $this->input->post('kota_tujuan'),
                            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                            'kendaraan' => $this->input->post('kendaraan'),
                            'penanggung_biaya' => $this->input->post('penanggung_biaya'),
                            'keterangan' => $this->input->post('keterangan'),
                            'date_create' => date('Y-m-d H:i:s'),
                            'create_by' => $id_user
                        );

                    } else {
                        redirect('home/error403');
                    }
                    $pengajuan = $this->Pengajuan_Model->insert($data_pengajuan);

                    if ($pengajuan) {
                        $data_pengikut = $this->input->post('pengikut');
                        $data_keterangan_pengikut = $this->input->post('keterangan_pengikut');

                        if (!empty($data_pengikut) && count($data_pengikut) === count($data_keterangan_pengikut)) {
                            // Inisialisasi array untuk menyimpan data yang akan disimpan
                            $data_to_insert = [];

                            // Loop melalui setiap pengikut dan keterangannya
                            foreach ($data_pengikut as $key => $pengikut) {
                                // Pastikan pengikut dan keterangan pengikut valid (bukan 'Array')
                                if (is_numeric($pengikut) && is_string($data_keterangan_pengikut[$key])) {
                                    // Tambahkan data ke array untuk disimpan
                                    $data_to_insert[] = [
                                        'id_karyawan' => $data_pengikut[$key],
                                        'id_pengajuan' => $pengajuan,
                                        'keterangan' => $data_keterangan_pengikut[$key]
                                    ];
                                }
                            }

                            // Simpan data pengikut jika ada data yang valid
                            if ($pengajuan) {
                                $result = $this->Pengikut_Model->insert($data_to_insert);

                                if ($result) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pengajuan berhasil ditambahkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                                    redirect('SuratPengajuan');
                                } else {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pengajuan Gagal Ditambahkan. Silahkan Coba Lagi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                                    redirect('SuratPengajuan');
                                }
                            }
                        }
                    }
                    if ($pengajuan) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pengajuan berhasil ditambah!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

                        redirect('SuratPengajuan');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pengajuan Gagal Ditambahkan. Silahkan Coba Lagi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                        redirect('SuratPengajuan');
                    }
                }

            }
            // Cek apakah ada data form yang disimpan dalam session
            $form_data = $this->session->userdata('form_data');
            if (!empty($form_data)) {
                // Jika ada, gunakan data tersebut untuk mengisi kembali nilai input
                $data['form_data'] = $form_data;
                // Hapus data form dari session setelah digunakan
                $this->session->unset_userdata('form_data');
            }

            $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
            $data['pengikut'] = $this->Karyawan_Model->pengikut($userdata['karyawan_id']);
            $data['kota'] = $this->Kota_Model->get();
            $data['judul'] = 'Tambah Surat Pengajuan';

            $data['nomor_surat'] = $this->generate_kode_surat();

            $this->load->view('layout/header', $data);
            if ($userdata['akses'] == '1') {
                $this->load->view('SuperAdmin/view_tambah_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '2') {
                $this->load->view('Pengaju/view_tambah_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '3') {
                $this->load->view('hcm/view_tambah_surat_pengajuan', $data);
            } else {

                redirect('home/error403');
            }
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }
    public function check_tanggal_kembali($tanggal_kembali)
    {
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        if (strtotime($tanggal_kembali) < strtotime($tanggal_mulai)) {
            $this->form_validation->set_message('check_tanggal_kembali', 'Tanggal Kembali harus setelah Tanggal Mulai.');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Update                                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit_surat($id_pengajuan)
    {
        $userdata = $this->session->userdata('userdata');
        $pengajuan = $data['pengajuan'] = $this->Pengajuan_Model->getById($id_pengajuan);
        $data['pengikut'] = $this->Pengikut_Model->getById($id_pengajuan);
        $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
        $data['kota'] = $this->Kota_Model->get();
        $data['listpengikut'] = $this->Karyawan_Model->pengikut($userdata['karyawan_id']);

        if ($this->session->userdata('logged') == TRUE) {

            $data['userdata'] = $userdata;

            $this->load->library('form_validation');

            if ($this->input->post('submit') !== NULL) {
                if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                    $this->form_validation->set_rules('id_karyawan', 'Nama Karyawan', 'required', [
                        'required' => 'Nama Karyawan Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('kode_surat', 'Kode Surat', 'required', [
                        'required' => 'Kode Surat Wajib di isi'
                    ]);
                }
                // if($this->input->post('nomor_surat') !== NULL){
                //     $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required|callback_nomor_unique_except[' . $nomor_surat . ']', [
                //         'required' => 'Nomor Surat Wajib di isi'
                //     ]);
                // }
                $this->form_validation->set_rules('judul_pengajuan', 'Judul Pengajuan', 'required', [
                    'required' => 'Judul Pengajuan Wajib di isi'
                ]);
                if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                    $this->form_validation->set_rules('jenis_pengajuan', 'Tujuan Pengajuan', 'required', [
                        'required' => 'Tujuan Pengajuan Wajib di isi'
                    ]);
                }
                $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'required', [
                    'required' => 'Kota Asal Wajib di isi'
                ]);
                $this->form_validation->set_rules('kota_tujuan', 'Kota Tujuan', 'required', [
                    'required' => 'Kota Tujuan Wajib di isi'
                ]);
                $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required', [
                    'required' => 'Tanggal Mulai Wajib di isi'
                ]);
                $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|callback_check_tanggal_kembali', [
                    'required' => 'Tanggal Kembali Wajib di isi'
                ]);
                $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required', [
                    'required' => 'Kendaraan Wajib di isi'
                ]);
                $this->form_validation->set_rules('penanggung_biaya', 'Penanggung Biaya', 'required', [
                    'required' => 'Penanggung Biaya Wajib di isi'
                ]);
                if ($this->form_validation->run() !== FALSE) {
                    $id_user = $this->session->userdata('id');
                    $id_karyawan = $this->session->userdata('karyawan_id');

                    if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                        if ($this->input->post('nomor_surat') == NULL) {
                            $nomor_surat = '        ';
                        } else {
                            $nomor_surat = $this->input->post('nomor_surat');
                        }
                        $data_pengajuan = array(
                            'id_karyawan' => $this->input->post('id_karyawan'),
                            'nomor_surat' => $nomor_surat,
                            'kode_surat' => "/" . $this->input->post('kode_surat'),
                            'judul_pengajuan' => $this->input->post('judul_pengajuan'),
                            'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
                            'kota_asal' => $this->input->post('kota_asal'),
                            'kota_tujuan' => $this->input->post('kota_tujuan'),
                            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                            'kendaraan' => $this->input->post('kendaraan'),
                            'penanggung_biaya' => $this->input->post('penanggung_biaya'),
                            'keterangan' => $this->input->post('keterangan'),
                            'date_modified' => date('Y-m-d H:i:s'),
                            'modified_by' => $id_user
                        );
                    } elseif ($userdata['akses'] == '2') {
                        $data_pengajuan = array(
                            'id_karyawan' => $id_karyawan,
                            'judul_pengajuan' => $this->input->post('judul_pengajuan'),
                            'kota_asal' => $this->input->post('kota_asal'),
                            'kota_tujuan' => $this->input->post('kota_tujuan'),
                            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                            'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                            'kendaraan' => $this->input->post('kendaraan'),
                            'penanggung_biaya' => $this->input->post('penanggung_biaya'),
                            'keterangan' => $this->input->post('keterangan'),
                            'date_modified' => date('Y-m-d H:i:s'),
                            'modified_by' => $id_user
                        );

                    } else {

                        redirect('home/error403');
                    }
                    $pengajuan = $this->Pengajuan_Model->update($id_pengajuan, $data_pengajuan);


                    if ($pengajuan) {
                        $data_pengikut = $this->input->post('pengikut');
                        $data_keterangan_pengikut = $this->input->post('keterangan_pengikut');

                        if (!empty($data['pengikut'])) {
                            $this->Pengikut_Model->delete($id_pengajuan);
                        }

                        if (!empty($data_pengikut) && count($data_pengikut) === count($data_keterangan_pengikut)) {
                            $data_to_insert = [];

                            foreach ($data_pengikut as $key => $pengikut) {
                                // Pastikan pengikut dan keterangan pengikut valid (bukan 'Array')
                                if (is_numeric($pengikut) && is_string($data_keterangan_pengikut[$key])) {
                                    // Tambahkan data ke array untuk disimpan
                                    $data_to_insert[] = [
                                        'id_karyawan' => $data_pengikut[$key],
                                        'id_pengajuan' => $id_pengajuan,
                                        'keterangan' => $data_keterangan_pengikut[$key]
                                    ];
                                }
                            }

                            // Simpan data pengikut jika ada data yang valid
                            if ($pengajuan) {
                                $result = $this->Pengikut_Model->insert($data_to_insert);

                                if ($result) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pengajuan berhasil diubah!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

                                    redirect('SuratPengajuan');
                                } else {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pengajuan Gagal Diubah. Silahkan Coba Lagi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                                    redirect('SuratPengajuan');
                                }
                            }
                        }
                    }
                    if ($pengajuan) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pengajuan berhasil diubah!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');

                        redirect('SuratPengajuan');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pengajuan Gagal Diubah. Silahkan Coba Lagi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                        redirect('SuratPengajuan');
                    }
                }
            }

            $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
            $data['kota'] = $this->Kota_Model->get();
            $data['pengikut'] = $this->Pengikut_Model->getById($id_pengajuan);
            $data['listpengikut'] = $this->Karyawan_Model->pengikut($userdata['karyawan_id']);

            if ($userdata['akses'] == '1' || $userdata['akses'] == '3') {
                if ($pengajuan['kode_surat'] == NULL) {
                    $data['kode_surat'] = $this->generate_kode_surat();
                } else {
                    $data['kode_surat'] = ltrim($pengajuan['kode_surat'], '/');
                }
            }

            if ($userdata['akses'] == '2') {
                $data['nomor_surat'] = "No.".$pengajuan['nomor_surat'].$pengajuan['kode_surat'];
            }


            $data['judul'] = 'Edit Surat Pengajuan';
            $this->load->view('layout/header', $data);
            if ($userdata['akses'] == '1') {
                $this->load->view('SuperAdmin/view_edit_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '2') {
                $this->load->view('Pengaju/view_edit_surat_pengajuan', $data);
            } elseif ($userdata['akses'] == '3') {
                $this->load->view('hcm/view_edit_surat_pengajuan', $data);
            } else {

                redirect('home/error403');
            }
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }
    public function nomor_unique_except($nomor_surat, $id_pengajuan)
    {
        $nomor_lama = $this->input->post('nomor_surat');

        if ($nomor_surat == $nomor_lama) {
            return TRUE;
        }

        $is_unique = $this->Pengajuan_Model->isNomorUnique($nomor_surat, $id_pengajuan);

        if (!$is_unique) {
            $this->form_validation->set_message('nomor_unique_except', ' Nomor surat sudah digunakan, silakan gunakan nomor surat lain.');
            return FALSE;
        }

        return TRUE;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Delete                                                           ///////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function hapus_surat($id_pengajuan)
    {
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login');
        }

        if (!empty($id_pengajuan)) {

            $this->Pengikut_Model->delete($id_pengajuan);

            $this->Pengajuan_Model->delete($id_pengajuan);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data pengajuan berhasil dihapus!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>');
        } else {
            // Set flash message untuk kesalahan
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Gagal menghapus data pengajuan
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>');
        }

        // Redirect ke halaman 'Pengajuan' setelah melakukan penghapusan data
        redirect('SuratPengajuan');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////                                              Detail                                                           /////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function detail_surat($id_pengajuan)
    {
        if ($this->session->userdata('logged') == TRUE) {

            $userdata = $this->session->userdata('userdata');
            $data['userdata'] = $userdata;

            $data['pengajuan'] = $this->Pengajuan_Model->getById($id_pengajuan);
            $date = $data['pengajuan'];
            $data['tanggal_mulai'] = $this->formatDate($date['tanggal_mulai']);
            $data['tanggal_kembali'] = $this->formatDate($date['tanggal_kembali']);
            $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
            $data['pengikut'] = $this->Pengikut_Model->getById($id_pengajuan);
            $data['kota'] = $this->Kota_Model->get();

            $data['judul'] = 'Detail Surat Pengajuan';
            $this->load->view('layout/header', $data);
            $this->load->view('pdf/view_detail_surat_pengajuan', $data);
            $this->load->view('layout/footer');
        } else {
            $url = base_url('login');
            redirect($url);
        }
    }

    //cetak ke pdf
    public function cetak_surat($id_pengajuan)
    {
        require_once FCPATH . 'vendor/autoload.php';

        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $data['pengajuan'] = $this->Pengajuan_Model->getById($id_pengajuan);
        $date = $data['pengajuan'];
        $data['karyawan'] = $this->Karyawan_Model->get_karyawan();
        $data['pengikut'] = $this->Pengikut_Model->getById($id_pengajuan);
        $data['kota'] = $this->Kota_Model->get();

        if (!empty($data['pengajuan'])) {
            // Akses data pengajuan
            $date = $data['pengajuan'];
            $data['tanggal_mulai'] = $this->formatDate($date['tanggal_mulai']);
            $data['tanggal_kembali'] = $this->formatDate($date['tanggal_kembali']);
        }

        if (!empty($data['pengikut'])) {
            // Akses data pengikut
            $data['nomor_surat'] = $this->generate_kode_surat($id_pengajuan);
        }
        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->addPage();

        $pdf->Image(FCPATH . 'assets/images/icon/skklogo_pdf.png', 15, 10, 23, 17, '', '', '', false, 300, '', false, false, 0, false, false);
        $pdf->Image(FCPATH . 'assets/images/icon/bsplogo_pdf.png', 180, 10, 17, 17, '', '', '', false, 300, '', false, false, 0, false, false);

        $data['checkbox'] = FCPATH . 'assets/images/icon/checkbox.png';
        $data['box'] = FCPATH . 'assets/images/icon/box.png';
        $data['space'] = FCPATH . 'assets/images/icon/space.png';
        $data['teks_pd_dn'] = 'PD-DN';
        $data['teks_pd_ln'] = 'PD-LN';

        ob_start();
        $this->load->view('pdf/view_cetak', $data);
        $html = ob_get_clean();


        $pdf->setTitle($data['pengajuan']['judul_pengajuan']);
        $pdf->writeHTML($html);

        $pdf->Output();
    }

}

?>