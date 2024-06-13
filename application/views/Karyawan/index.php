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
            <div class="card">
                <div class="card-body">
                    <div class="data-tables">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5">
                                <div class="col-sm-7">
                                    <h4>Daftar Karyawan</h4>
                                </div>
                                <div class="col-sm-5" style="text-align:right;">
                                    <a href="<?= site_url('Karyawan/Create') ?>">
                                        <button type="button" class="btn btn-danger mb-3">
                                            <i class="fa fa-plus"></i> Tambah Karyawan
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="data-tables">
                                        <table id="dataKaryawan" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead class="bg-light text-capitalize">
                                                <tr role="row">
                                                    <th data-sortable="false">No</th>
                                                    <th>Nomor Pekerja</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Golongan Upah</th>
                                                    <th>Departemen</th>
                                                    <th>Jabatan</th>
                                                    <th>Tanggal Lahir</th>
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

<!-- Modal -->
<div class="modal fade" id="hapusModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 16px;">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Karyawan</h5>
            </div>
            <div class="modal-body" style="text-align:left;">
                <p>Apakah Anda Ingin Menghapus Data Ini?</p>
                <input type="hidden" id="hapusIdKaryawan" name="id_karyawan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a href="#" id="hapusKaryawanLink"><button type="button" class="btn btn-primary">Ya</button></a>
            </div>
        </div>
    </div>
</div>

<!-- Import JavaScript -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script>
    table = $('#dataKaryawan').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('karyawan/get_data_karyawan') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0],
            
        }], "language": {
            "lengthMenu": "Show&nbsp;&nbsp;&nbsp;_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "infoEmpty": ""
        }

    });

</script>

<!-- Script DataTable -->
<script>
    function setHapusIdKaryawan(idKaryawan) {
        document.getElementById('hapusIdKaryawan').value = idKaryawan;
        document.getElementById('hapusKaryawanLink').href = '<?= base_url('index.php/Karyawan/Delete/'); ?>' + idKaryawan;
    }
</script>