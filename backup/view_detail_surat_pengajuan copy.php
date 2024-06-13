<style>
    /* Style untuk Select2 */
    .select2-container--default .select2-selection--multiple {
        border-radius: 15px !important;
        border: 1px solid #A9A9A9 !important;
        min-height: 38px !important;
        padding: 4px 0 4px 8px !important;
    }

    .label {
        color: #3e3c3c;
        font-weight: bold;
        margin-right: 10px;
    }

    .detail {
        display: flex;
        align-items: center;
    }

    .data {
        margin: 0;
    }
</style>
<div class="col-lg-6 col-ml-12 mx-auto mb-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('SuperAdmin/daftar_surat_pengajuan'); ?>"
                        class="d-flex align-items-center" style="text-decoration: none; color: #de4444;">
                        <i class="ti-arrow-circle-left" style="font-size: 24px; color:#de4444"></i>
                        <h4 style="color:#de4444; margin-left: 10px;">Detail Surat Pengajuan</h4>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-ml-10 mt-2 mb-5">
                            <h5 style="text-align:center;" class="data"><?php echo $pengajuan['judul_pengajuan']; ?>
                            </h5>
                        </div>
                        <div class="col-12 detail">
                            <label for="nama_karyawan" class="col-form-label label">Nama
                                Karyawan :</label>
                            <?php foreach ($karyawan as $data): ?>
                                <p class="data">
                                    <?php if ($pengajuan['id_karyawan'] == $data['id_karyawan'])
                                        echo $data['nama']; ?>
                                </p>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-12 detail">
                            <label for="tujuan_pengajuan" class="col-form-label label"
                                style="color:#3e3c3c; font-weight:bold;">Tujuan Pengajuan :</label>
                            <p class="data"><?php echo $pengajuan['jenis_pengajuan']; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="kota_asal" class="col-form-label label">Kota
                                Asal :</label>
                            <p class="data"><?php echo $pengajuan['kota_asal']; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="kota_tujuan" class="col-form-label label">Kota
                                Tujuan :</label>
                            <p class="data"><?php echo $pengajuan['kota_tujuan']; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="tanggal_mulai" class="col-form-label label">Tanggal
                                Mulai :</label>
                            <p class="data"><?php echo $tanggal_mulai; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="tanggal_kembali" class="col-form-label label">Tanggal
                                Kembali :</label>
                            <p class="data"><?php echo $tanggal_kembali; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label class="col-form-label label">Kendaraan :</label>
                            <p class="data"><?php echo $pengajuan['kendaraan']; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="penanggung_biaya" class="col-form-label label">Penanggung
                                Biaya :</label>
                            <p class="data"><?php echo $pengajuan['penanggung_biaya']; ?></p>
                        </div>
                        <div class="col-12 detail">
                            <label for="keterangan" class="col-form-label label">Keterangan :</label>
                            <?php if (!empty($pengajuan['keterangan'])): ?>
                                <p class="data"><?php echo $pengajuan['keterangan']; ?></p>
                            <?php else: ?>
                                <p class="data">Tidak Ada Keterangan.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 detail">
                            <label for="pengikut" class="col-form-label label">Pengikut :</label>
                            <?php $i = 0; ?>
                            <?php if (!empty($pengajuan['pengikut'])): ?>
                                <?php foreach ($id_pengikut as $id): ?>
                                    <?php foreach ($karyawan as $data): ?>
                                        <?php $jumlah = count($id_pengikut); ?>
                                        <?php if ($data['id_karyawan'] == $id): ?>
                                            <p><?php echo $data['nama']; ?></p>
                                            <?php $i++; ?>
                                            <?php if ($i != $jumlah): ?>
                                                <p style="margin-right:5px;">,</p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="data">Tidak Ada Pengikut.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 mt-4" style="text-align:center;">
                            <a href="<?php echo site_url('SuperAdmin/daftar_surat_pengajuan'); ?>"><button type="button"
                                    class="btn btn-secondary mb-3">Kembali</button></a>
                            <a href="<?php echo base_url('index.php/SuperAdmin/cetak_surat/') . $pengajuan['id_pengajuan']; ?>"><button
                                    type="button" class="btn btn-warning mb-3"> <i class="ti-printer"
                                        style="margin-right:7px;"></i>Cetak PDF</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#pengikut').select2();
    });
    $('#pengikut').select2({
        placeholder: 'Pilih Pengikut'
    });
</script>