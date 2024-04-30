<div class="col-lg-6 col-ml-12 mx-auto mb-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center">
                    <h4 style="color:#de4444; text-align: center;">Detil Surat Pengajuan</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <form action="<?php echo site_url('Pengaju/add_pengajuan_pengaju'); ?>" method="post">
                            <div class="form-group">
                                <label for="id_karyawan" class="col-form-label"
                                    style="color:#3e3c3c; font-weight:bold;">Nama Karyawan</label>
                                <label><?php echo $pengajuan['nama_karyawan']; ?></label>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="judul_pengajuan" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Judul Pengajuan</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['judul_pengajuan'])): ?>
                                            <label><?php echo $pengajuan['judul_pengajuan']; ?></label>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tujuan_pengajuan" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Tujuan
                                            Pengajuan</label>
                                        <label>
                                            <?php if (is_array($pengajuan) && isset($pengajuan['jenis_pengajuan'])): ?>
                                                <label><?php echo $pengajuan['jenis_pengajuan']; ?></label>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kota_asal" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Kota
                                            Asal</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['kota_asal'])): ?>
                                            <label><?php echo $pengajuan['kota_asal']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kota_tujuan" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Kota
                                            Tujuan</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['kota_tujuan'])): ?>
                                            <label><?php echo $pengajuan['kota_tujuan']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tanggal_mulai" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Tanggal Mulai</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['tanggal_mulai'])): ?>
                                            <label><?php echo $pengajuan['tanggal_mulai']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tanggal_kembali" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Tanggal Kembali</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['tanggal_kembali'])): ?>
                                            <label><?php echo $pengajuan['tanggal_kembali']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Kendaraan
                                        </label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['kendaraan'])): ?>
                                            <label><?php echo $pengajuan['kendaraan']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="penanggung_biaya" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Penanggung Biaya</label>
                                        <?php if (is_array($pengajuan) && isset($pengajuan['penanggung_biaya'])): ?>
                                            <label><?php echo $pengajuan['penanggung_biaya']; ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label"
                                    style="color:#3e3c3c; font-weight:bold;">Keterangan</label>
                                <?php if (is_array($pengajuan) && isset($pengajuan['keterangan'])): ?>
                                    <label><?php echo $pengajuan['keterangan']; ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="pengikut" class="col-form-label"
                                    style="color:#3e3c3c; font-weight:bold;">Pengikut</label>
                                <label><?php echo $pengajuan['nama_pengikut']; ?></label>
                            </div>
                            <div class="col-12" style="text-align:right;">
                                <a href="<?php echo site_url('Pengaju/daftar_surat_pengajuan'); ?>"><button
                                        type="button" class="btn btn-secondary mb-3">Cancel</button></a>
                                <button type="submit" class="btn btn-success mb-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>