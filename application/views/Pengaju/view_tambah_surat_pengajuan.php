<style>
/* Style untuk Select2 */
    .select2-container--default .select2-selection--multiple {
        border-radius: 15px !important;
        border: 1px solid #A9A9A9 !important;
        min-height: 38px !important;
        padding: 4px 0 4px 8px !important;
       
    }

    
</style>
<div class="col-lg-6 col-ml-12 mx-auto mb-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('Pengaju/daftar_surat_pengajuan'); ?>" class="d-flex align-items-center"
                        style="text-decoration: none; color: #de4444;">
                        <i class="ti-arrow-circle-left" style="font-size: 24px; color:#de4444"></i>
                        <h4 style="color:#de4444; margin-left: 10px;">Tambah Surat Pengajuan</h4>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <?php echo $this->session->flashdata('message'); ?>
                    <div class="col-12">
                        <form action="<?php echo site_url('Pengaju/add_pengajuan'); ?>" method="post">
                            <div class="row transparent-bg">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="judul_pengajuan" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Judul Pengajuan<span
                                                class="required">*</span></label>
                                        <input class="form-control" type="text" placeholder="Judul Pengajuan"
                                            id="judul_pengajuan" name="judul_pengajuan" >
                                        <?php echo form_error('judul_pengajuan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label" style="color:#3e3c3c; font-weight:bold;">Tujuan
                                            Pengajuan<span class="required">*</span></label>
                                        <select class="custom-select" style="border-radius: 15px;"
                                            name="jenis_pengajuan">
                                            <option selected disabled>Pilih Tujuan Pengajuan</option>
                                            <option value="Dinas Luar Kota">Dinas Luar Kota</option>
                                            <option value="Dinas Luar Negri">Dinas Luar Negri</option>
                                        </select>
                                        <?php echo form_error('jenis_pengajuan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kota_asal" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Kota
                                            Asal<span class="required">*</span></label>
                                        <input class="form-control" type="text" placeholder="Kota Asal" id="kota_asal"
                                            name="kota_asal">
                                        <?php echo form_error('kota_asal', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="kota_tujuan" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Kota
                                            Tujuan<span class="required">*</span></label>
                                        <input class="form-control" type="text" placeholder="Kota Tujuan"
                                            id="kota_tujuan" name="kota_tujuan">
                                        <?php echo form_error('kota_tujuan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tanggal_mulai" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Tanggal Mulai<span
                                                class="required">*</span></label>
                                        <input class="form-control" type="date" value="" id="tanggal_mulai"
                                            name="tanggal_mulai">
                                        <?php echo form_error('tanggal_mulai', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tanggal_kembali" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Tanggal Kembali<span
                                                class="required">*</span></label>
                                        <input class="form-control" type="date" value="" id="tanggal_kembali"
                                            name="tanggal_kembali">
                                        <?php echo form_error('tanggal_kembali', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row transparent-bg">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Kendaraan<span
                                                class="required">*</span></label>
                                        <select class="custom-select" style="border-radius: 15px;" name="kendaraan">
                                            <option selected disabled>Pilih Kendaraan</option>
                                            <option value="Mobil">Mobil</option>
                                            <option value="Kapal">Kapal</option>
                                            <option value="Pesawat">Pesawat</option>
                                        </select>
                                        <?php echo form_error('kendaraan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="penanggung_biaya" class="col-form-label"
                                            style="color:#3e3c3c; font-weight:bold;">Penanggung Biaya<span
                                                class="required">*</span></label>
                                        <input class="form-control" type="text" placeholder="Penanggung Biaya"
                                            id="penanggung_biaya" name="penanggung_biaya">
                                        <?php echo form_error('penanggung_biaya', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label"
                                    style="color:#3e3c3c; font-weight:bold;">Keterangan<span>(opsional)</span></label>
                                <input class="form-control" type="text" placeholder="Keterangan" id="keterangan"
                                    name="keterangan">
                            </div>
                            <div class="form-group">
                                <label for="pengikut" class="col-form-label"
                                    style="color:#3e3c3c; font-weight:bold;">Pengikut<span>(opsional)</span></label>
                                <select class="custom-select"
                                    style="border-radius:100px; width:100%x; border: 1px solid #A9A9A9;"
                                    name="pengikut[]" id="pengikut" multiple>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?php echo $row['id_karyawan']; ?>">
                                            <?php echo $row['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12" style="text-align:center;">
                                <a href="<?php echo site_url('Pengaju/daftar_surat_pengajuan'); ?>"><button type="button"
                                        class="btn btn-secondary mb-3">Cancel</button></a>
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
    $(document).ready(function () {
        $('#pengikut').select2();
    });
    $('#pengikut').select2({
        placeholder: 'Pilih Pengikut'
    });
</script>