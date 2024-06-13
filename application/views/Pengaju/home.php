<style>
    .header-title {
        margin-top: 10px;
        margin-bottom: 20px;
        margin-left: 20px;
    }

    h6 {
        color: #fff;
        font-size: 16px !important;
        margin-bottom: 3px;
        margin-left: 15px;
    }

    .footer-title {
        margin-bottom: 20px;
    }

    .sbg3 {
        border-radius: 10px;
    }
</style>

<div class="col-lg-12 col-ml-12 mx-auto">
    <div class="col-12">
        <div class="card mt-3 mb-2">
            <div class="row col-12">
                <div class="col-4 sbg3">
                    <div class="card-body">
                        <?php if ($this->session->userdata('karyawan_data')): ?>
                            <h4 class="header-title text-white">Hai
                                <?php echo $this->session->userdata('karyawan_data')['nama']; ?>! <br> Selamat Datang di
                                Halaman Dashboard
                            </h4>
                            <h6>Nama Karyawan :
                                <?php echo $this->session->userdata('karyawan_data')['nama']; ?>
                            </h6>
                            <h6>Nomor Pekerja :
                                <?php echo $this->session->userdata('karyawan_data')['no_pekerja']; ?>
                            </h6>
                            <h6>Departemen :
                                <?php echo $this->session->userdata('karyawan_data')['departemen']; ?>
                            </h6>
                            <h6>Jabatan :
                                <?php echo $this->session->userdata('karyawan_data')['jabatan']; ?>
                            </h6>
                            <h6 class="footer-title">Tanggal Lahir :
                                <?php echo $this->session->userdata('karyawan_data')['tanggal_lahir']; ?>
                            </h6>
                        <?php else: ?>
                            <h4 class="header-title text-white">Hai Pengunjung! <br> Silakan login untuk mengakses
                                halaman ini </h4>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-8 d-flex align-items-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mt-3 mb-5">
                                <div>
                                    <h5 class="mt-0">Total Pengajuan (PD-DN)</h5>
                                    <p class="text-muted">Jumlah pengajuan surat dinas online berdasarkan PD-DN</p>
                                    <h2 class="text-primary"><?php echo $total_pd_dn; ?></h2>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 mb-5">
                                <div>
                                    <h5 class="mt-0">Total Pengajuan (PD-DL)</h5>
                                    <p class="text-muted">Jumlah pengajuan surat dinas online berdasarkan PD-DL</p>
                                    <h2 class="text-primary"><?php echo $total_pd_dl; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
