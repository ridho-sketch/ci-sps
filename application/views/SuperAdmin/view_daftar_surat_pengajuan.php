<!-- Import CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">

<!-- CSS Custom -->
<style>
    .table {
        border: 1px #fff !important;
        text-align: center !important;
    }

    .custom-select {
        width: 60px !important;
    }

    thead th {
        text-align: center !important;
    }
</style>
<div class="main-content-inner" style="padding: 20px; min-height: calc(100vh - 200px); position: relative;">
    <div class="row">
        <div class="col-12">
            <?php echo $this->session->flashdata('message'); ?>
            <!-- <div class="row mt-3 mb-3">
                <div class="col-12">
                    <h4>Daftar Surat Pengajuan</h4>
                </div>
            </div> -->
            <div class="card">
                <div class="card-body">
                    <div class="data-tables">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5">
                                <div class="col-sm-7">
                                    <h4>Daftar Surat Pengajuan</h4>
                                </div>
                                <div class="col-sm-5" style="text-align:right;">
                                    <a href="<?php echo site_url('SuratPengajuan/tambah_pengajuan'); ?>">
                                        <button type="button" class="btn btn-danger mb-3">
                                            <i class="fa fa-plus" style="margin-right:10px;"></i> Buat Surat
                                            Pengajuan
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="data-tables">
                                        <table id="dataSurat" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead class="bg-light text-capitalize">
                                                <tr role="row">
                                                    <th data-sortable="false">No</th>
                                                    <th>Nomor SP</th>
                                                    <th>Judul Pengajuan</th>
                                                    <th>Tujuan SP</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Kota Tujuan</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th data-sortable="false">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>

<!-- Script DataTable -->
<script>
    table = $('#dataSurat').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('suratpengajuan/get_data_surat') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0],
        }], "language": {
            "lengthMenu": "Show&nbsp;&nbsp;&nbsp;_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "infoEmpty": "",
        }

    });
</script>

<!-- Script Lainnya -->
<script>
    function setHapusIdPengajuan(idPengajuan) {
        // Set nilai input tersembunyi dengan ID pengajuan yang akan dihapus
        document.getElementById('hapusIdSurat').value = idPengajuan;
    }

    // Fungsi hapus untuk mengarahkan ke fungsi hapus di controller
    function hapus() {
        var idPengajuan = document.getElementById('hapusIdSurat').value;
        // Arahkan ke fungsi hapus di controller dengan menggunakan id_pengajuan yang diperoleh
        window.location.href = '<?= base_url('index.php/SuratPengajuan/hapus_surat/') ?>' + idPengajuan;
    }
</script>