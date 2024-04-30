<style>
    /* Style untuk border pada setiap kolom */
    #dataTable th,
    #dataTable td {
        border: 0.5px solid #dee2e6;
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
                                    <h4 class="header-title">Data Karyawan</h4>
                                </div>
                            </div>
                            <div class="row">
                                <form action="<?= base_url('index.php/Karyawan/deleteAll'); ?>" method="POST"
                                    class="col-md-7">
                                    <a href="<?= site_url('SuperAdmin/tambah_karyawan') ?>">
                                        <button type="button" class="btn btn-danger mb-3">
                                            <i class="fa fa-plus"></i> Tambah Karyawan
                                        </button>
                                    </a>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="dataTable" class="text-center dataTable no-footer mt-2" role="grid"
                                        aria-describedby="dataTable_info" style="width: auto;">
                                        <thead class="bg-light text-capitalize">
                                            <tr role="row">
                                                <th tabindex="0" aria-controls="dataTable" style="width: 30px;"
                                                    class="sorting_disabled">
                                                    No
                                                </th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 150px;"
                                                    aria-sort="none"
                                                    aria-label="Nomor Pekerja: activate to sort column ascending">Nomor
                                                    Pekerja</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 285px;"
                                                    aria-sort="none"
                                                    aria-label="Nama Pekerja: activate to sort column ascending">Nama
                                                    Karyawan</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 100px;"
                                                    aria-sort="none"
                                                    aria-label="Golongan Upah: activate to sort column ascending">
                                                    Golongan Upah</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 150px;"
                                                    aria-sort="none"
                                                    aria-label="Departemen: activate to sort column ascending">
                                                    Departemen</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 150px;"
                                                    aria-sort="none"
                                                    aria-label="Jabatan: activate to sort column ascending">Jabatan</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 100px;"
                                                    aria-sort="none"
                                                    aria-label="Tanggal Lahir: activate to sort column ascending"
                                                    data-sortable="false">
                                                    Tanggal Lahir</th>
                                                <th tabindex="0" aria-controls="dataTable" style="width: 90px;"
                                                    data-sortable="false">Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($karyawan as $key => $data): ?>
                                                <tr>
                                                    <td><?php echo $i; ?> </td>
                                                    <td>
                                                        <?php echo isset($data['no_pekerja']) ? $data['no_pekerja'] : ''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($data['nama']) ? $data['nama'] : ''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($data['golongan_upah']) ? $data['golongan_upah'] : ''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($data['departemen']) ? $data['departemen'] : ''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($data['jabatan']) ? $data['jabatan'] : ''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($data['tanggal_lahir']) ? $data['tanggal_lahir'] : ''; ?>
                                                    </td>

                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a
                                                                    href="<?= base_url('index.php/SuperAdmin/edit_karyawan/') . $data['id_karyawan']; ?>"
                                                                    class="text-secondary" title="Edit"><i
                                                                        class="fa fa-edit"></i></a></li>
                                                            <li><a class="text-danger" title="Hapus" data-toggle="modal"
                                                                    data-target="#hapusModal"
                                                                    onclick="setHapusIdKaryawan(<?= $data['id_karyawan']; ?>)"><i
                                                                        class="ti-trash"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
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

<script>
    function setHapusIdKaryawan(idKaryawan) {
        document.getElementById('hapusIdKaryawan').value = idKaryawan;
        document.getElementById('hapusKaryawanLink').href = '<?= base_url('index.php/SuperAdmin/delete_karyawan/'); ?>' + idKaryawan;
    }
</script>