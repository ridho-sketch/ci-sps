<style>
    /* Style untuk border pada setiap kolom */
    #dataTable th,
    #dataTable td {
        border: 0.2px solid #dee2e6;
    }
</style>
<div class="main-content-inner" style="padding: 20px; min-height: calc(100vh - 200px); position: relative;">
    <div class="row">
        <div class="col-12">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="data-tables">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="header-title">Daftar Surat Pengajuan</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo site_url('Pengaju/tambah_surat'); ?>">
                                        <button type="button" class="btn btn-danger mb-3">
                                            <i class="fa fa-plus"></i> Buat Surat Pengajuan
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="data-tables">
                                        <table id="dataTable" class="text-center dataTable" role="grid"
                                            aria-describedby="dataTable_info">
                                            <thead class="bg-light text-capitalize">
                                                <tr role="row">
                                                    <th tabindex="0" aria-controls="dataTable" style="width: 5%;">No
                                                    </th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width: 11%;"
                                                        aria-sort="none"
                                                        aria-label="Nama Pekerja: activate to sort column ascending">
                                                        Judul
                                                        Surat
                                                        Pengajuan</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width:11%;"
                                                        aria-sort="none"
                                                        aria-label="Departemen: activate to sort column ascending">
                                                        Tujuan Pengajuan</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width: 11%;"
                                                        aria-sort="none"
                                                        aria-label="Golongan Upah: activate to sort column ascending">
                                                        Tanggal Pengajuan</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width:11%;"
                                                        aria-sort="none"
                                                        aria-label="Departemen: activate to sort column ascending">
                                                        Kota Tujuan</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width:11%;"
                                                        aria-sort="none"
                                                        aria-label="Departemen: activate to sort column ascending">
                                                        Tanggal Mulai</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width:11%;"
                                                        aria-sort="none"
                                                        aria-label="Departemen: activate to sort column ascending">
                                                        Tanggal Kembali</th>
                                                    <th tabindex="0" aria-controls="dataTable" style="width: 5%;"
                                                        data-sortable="false">Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($pengajuan as $key => $data): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['judul_pengajuan']) ? $data['judul_pengajuan'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['jenis_pengajuan']) ? $data['jenis_pengajuan'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['date_create']) ? $data['date_create'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['kota_tujuan']) ? $data['kota_tujuan'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['tanggal_mulai']) ? $data['tanggal_mulai'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($data['tanggal_kembali']) ? $data['tanggal_kembali'] : ''; ?>
                                                        </td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><a
                                                                        href="<?= base_url('index.php/Pengaju/detail_surat/') . $data['id_pengajuan']; ?>"
                                                                        title="detail surat"><i class="ti-info-alt"></i></a>
                                                                </li>
                                                                <li><a class="text-danger" title="hapus" data-toggle="modal"
                                                                        data-target="#hapusModal"
                                                                        onclick="setHapusIdPengajuan(<?= $data['id_pengajuan']; ?>)"><i
                                                                            class="ti-trash"></i></a></li>
                                                            </ul>
                                                        </td>
                                                        <?php $i++; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Surat</h5>
                </div>
                <div class="modal-body" style="text-align:left;">
                    <p>Apakah Anda Ingin Menghapus Data Ini?</p>
                    <input type="hidden" id="hapusIdSurat" name="id_pengajuan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <!-- Perbaikan tombol "Ya" -->
                    <button type="button" class="btn btn-primary" onclick="hapus()">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setHapusIdPengajuan(idPengajuan) {
        // Set nilai input tersembunyi dengan ID pengajuan yang akan dihapus
        document.getElementById('hapusIdSurat').value = idPengajuan;
    }

    // Fungsi hapus untuk mengarahkan ke fungsi hapus di controller
    function hapus() {
        var idPengajuan = document.getElementById('hapusIdSurat').value;
        // Arahkan ke fungsi hapus di controller dengan menggunakan id_pengajuan yang diperoleh
        window.location.href = '<?= base_url('index.php/Pengaju/hapus_surat/') ?>' + idPengajuan;
    }
</script>