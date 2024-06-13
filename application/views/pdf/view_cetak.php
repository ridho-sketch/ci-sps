<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 70px;
        }

        .logo-left {
            width: 60px;
            height: auto;
            text-align: center;
        }

        .logo-right {
            width: 50px;
            height: auto;
            text-align: center;
        }

        .tabel-pengikut {
            border: 1px solid #000;
        }

        .title-header {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            flex: 1;
            margin: 0 auto;
            height: 50px;
            color: #A9A9A9;
        }

        .surat-perintah {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            text-decoration: underline;
        }

        .nomor-surat {
            text-align: center;
            font-size: 13px;
        }

        .pengikut {
            text-align: center;
            border: 1px solid #000;
            height: 25px !important;
            line-height: 25px;
            text-align: center;
            font-size: 10px;
        }

        .persetujuan {
            border: 1px solid #000;
        }

        .body-persetujuan {
            border: 1px solid #000;
        }

        .body-pengikut {
            height: 15px !important;
            border: 1px solid #000;
            font-size: 9px;
            text-align: center;
        }

        .set-td {
            border: 1px solid black;
            text-align: center;
            font-size: 11px;
            height: 20px !important;
            line-height: 20px;
        }

        .td-tujuan {
            border: 1px solid black;
            text-align: center;
            font-size: 9px;
            height: 15px !important;
            line-height: 20px;
        }

        .td-biaya {
            border: 1px solid black;
            text-align: center;
            font-size: 9px;
            height: 5px !important;
            line-height: 20px;
        }

        h2 {
            font-size: 11px;
            font-weight: normal;
            margin: 0 auto;
        }

        h4 {
            font-size: 9px;
            font-weight: normal;
        }

        .data {
            font-size: 10px !important;
            line-height: 15px !important;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td class="title-header" colspan="5">PT. Bumi Siak Pusako</td>
        </tr>
        <tr>
            <td colspan="5" class="surat-perintah">SURAT PERINTAH</td>
        </tr>
        <tr>
            <td colspan="5" class="nomor-surat"><?php echo "No.".str_replace(" ", "&nbsp;", $pengajuan['nomor_surat']).$pengajuan['kode_surat']; ?></td>
        </tr>
        <tr>
            <td colspan="5">
                <h4 style="font-size: 10px !important;width: 100px !important;">Dengan ini mengizinkan/menugaskan,</h4>
                <table>
                    <tr>
                        <td>
                            <?php foreach ($karyawan as $data): ?>
                                <?php if ($pengajuan['id_karyawan'] == $data['id_karyawan']): ?>
                                    <br class="data">Nama : <?php echo $data['nama']; ?>
                                    <br class="data">No. Pekerja : <?php echo $data['no_pekerja']; ?>
                                    <br class="data">Golongan Upah : <?php echo $data['golongan_upah']; ?>
                                    <br class="data">Jabatan : <?php echo $data['jabatan'] . ' ' . $data['departemen']; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <br class="data">Diperlukan Untuk :
                            <?php if ($pengajuan['jenis_pengajuan'] == 'Dinas Dalam Negri'): ?>
                                <img src="<?php echo $space; ?>" alt="space" style="width:10px;">
                                <img src="<?php echo $checkbox; ?>" alt="Checkbox" style="width:11px;height: 10px;">
                                <?php echo $teks_pd_dn; ?>
                                <img src="<?php echo $space; ?>" alt="space" style="width:10px;">
                                <img src="<?php echo $box; ?>" alt="Box" style="width:10px;height: 10px;">
                                <?php echo $teks_pd_ln; ?>
                            <?php else: ?>
                                <img src="<?php echo $space; ?>" alt="space" style="width:10px;">
                                <img src="<?php echo $box; ?>" alt="Box" style="width:10px;height: 10px;">
                                <?php echo $teks_pd_dn; ?>
                                <img src="<?php echo $space; ?>" alt="space" style="width:10px;">
                                <img src="<?php echo $checkbox; ?>" alt="Checkbox" style="width:11px;height: 10px;">
                                <?php echo $teks_pd_ln; ?>
                            <?php endif; ?>
                            <br class="data">Dari : <?php echo $pengajuan['kota_asal']; ?>
                            <br class="data">Tempat tujuan : <?php echo $pengajuan['kota_tujuan']; ?>
                            <br class="data">Terhitung mulai tgl : <?php echo $tanggal_mulai; ?>
                            <br class="data">Kembali tgl : <?php echo $tanggal_kembali; ?>
                            <br class="data">Berkendaraan : <?php echo $pengajuan['kendaraan']; ?>
                            <br class="data">Biaya ditanggung oleh : <?php echo $pengajuan['penanggung_biaya']; ?>
                            <br class="data">Keterangan/Keperluan :
                            <?php if (!empty($pengajuan['keterangan'])): ?>
                                <?php echo $pengajuan['keterangan']; ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
    </table>
    <table class="tabel-pengikut">
        <tr>
            <td class="pengikut" style="width:35px;">
                No.
            </td>
            <td class="pengikut" style="width:195px;">
                Nama Pengikut / No.Pekerja
            </td>
            <td class="pengikut" style="width:70px;">
                Gol. Upah
            </td>
            <td class="pengikut" style="width:120px;">
                Jabatan
            </td>
            <td class="pengikut" style="width:114px;">
                Keterangan
            </td>
        </tr>
        <?php $i = 1; ?>
        <?php if (!empty($pengikut)): ?>
            <?php foreach ($pengikut as $key => $id): ?>
                <?php foreach ($karyawan as $key => $data): ?>
                    <?php if ($data['id_karyawan'] == $id['id_karyawan']): ?>
                        <tr>
                            <td class="body-pengikut"><?php echo $i . '.';
                            $i++; ?></td>
                            <td class="body-pengikut"><?php echo isset($data['nama']) ? $data['nama'] : ''; echo ' / ';?>
                            <?php echo isset($data['no_pekerja']) ? $data['no_pekerja'] : ''; ?></td>
                            <td class="body-pengikut"><?php echo isset($data['golongan_upah']) ? $data['golongan_upah'] : ''; ?></td>
                            <td class="body-pengikut">
                                <?php echo isset($data['jabatan']) ? $data['jabatan'] : '';
                                echo ' ';
                                echo isset($data['departemen']) ? $data['departemen'] : ''; ?>
                            </td>
                            <?php if (!empty($id['keterangan'])): ?>
                                <td class="body-pengikut">
                                    <?php echo isset($id['keterangan']) ? $id['keterangan'] : ''; ?>
                                </td>
                            <?php else: ?>
                                <td style="text-align: center;">
                                    -
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td class="body-pengikut" colspan="5">-</td>
            </tr>
        <?php endif; ?>
    </table>
    <table class="persetujuan">
        <tr style="border: 1px solid white;">
            <?php foreach ($karyawan as $data): ?>
                <?php if ($pengajuan['id_karyawan'] == $data['id_karyawan']): ?>
                    <?php if ($data['jabatan'] == 'Staf' || $data['jabatan'] == 'Supervisor'): ?>
                        <td style="border: 1px solid black;">Yang bersangkutan
                            <br>Tanggal
                        </td>
                        <td style="border: 1px solid black;">Menyetujui
                            <br>TM<img src="<?php echo $space; ?>" alt="space" style="width:10px;">Tanggal
                        </td>
                        <td style="border: 1px solid black;">Menyetujui
                            <br>Plt. Manager<img src="<?php echo $space; ?>" alt="space" style="width:40px;height:3px;">Tanggal
                        </td>
                        <td style="border: 1px solid black;">Mengetahui/Menyetujui
                            <br>Plt.HCM Mgr<img src="<?php echo $space; ?>" alt="space" style="width:40px;height:3px;">Tanggal
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>Rahmah Selviawati
                        </td>
                    <?php elseif ($data['jabatan'] == 'Tim Manager'): ?>
                        <td style="border: 1px solid black;">Yang bersangkutan
                            <br>Tanggal
                        </td>
                        <td style="border: 1px solid black;">Menyetujui
                            <br>Plt. Manager<img src="<?php echo $space; ?>" alt="space" style="width:85px;height:3px;">Tanggal
                        </td>
                        <td style="border: 1px solid black;">Mengetahui/Menyetujui
                            <br>Plt.HCM Mgr<img src="<?php echo $space; ?>" alt="space" style="width:85px;height:3px;">Tanggal
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>Rahmah Selviawati
                        </td>
                    <?php elseif ($data['jabatan'] == 'Manager'): ?>
                        <td style="border: 1px solid black;">Yang bersangkutan
                            <br>Tanggal
                        </td>
                        <td style="border: 1px solid black;">Menyetujui
                            <br>Plt. General Manager<img src="<?php echo $space; ?>" alt="space" style="width:50px;height:3px;">Tanggal
                        </td>
                        <td style="border: 1px solid black;">Mengetahui/Menyetujui
                            <br>Plt.HCM Mgr<img src="<?php echo $space; ?>" alt="space" style="width:85px;height:3px;">Tanggal
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>Rahmah Selviawati
                        </td>
                    <?php elseif ($data['jabatan'] == 'General Manager'): ?>
                        <td style="border: 1px solid black;">Yang bersangkutan
                            <br>Tanggal
                        </td>
                        <td style="border: 1px solid black;">Menyetujui
                            <br>Plt. Direktur<img src="<?php echo $space; ?>" alt="space" style="width:85px;height:3px;">Tanggal
                        </td>
                        <td style="border: 1px solid black;">Mengetahui/Menyetujui
                            <br>Plt.HCM Mgr<img src="<?php echo $space; ?>" alt="space" style="width:85px;height:3px;">Tanggal
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>Rahmah Selviawati
                        </td>
                    <?php elseif ($data['jabatan'] == 'Direktur'): ?>
                        <td style="border: 1px solid black;">Yang bersangkutan
                            <br>Tanggal
                        </td>
                        <td style="border: 1px solid black;">Mengetahui/Menyetujui
                            <br>Plt.HCM Mgr<img src="<?php echo $space; ?>" alt="space" style="width:170px;height:3px;">Tanggal
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>Rahmah Selviawati
                        </td>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    </table>
    <table style="border: 1px solid black;">
        <tr>
            <td colspan="3" style="border: 1px solid black;">PANJAR/LUMPSUM UANG PERJALANAN DINAS (Rp/USD):
                <br>
                <br>
                <br>Catatan : Maksimum pengambilan panjar dinas 80% dari estimasi biaya
                batas akhir pertanggungjawaban panjar dinas 7 hari setelah kembali
            </td>
            <td style="border: 1px solid black;">Menyetujui :
                <br>Finance
            </td>
        </tr>
    </table>
    <table class="tabel-pengikut">
        <tr>
            <td class="set-td"><b>PEMBEBANAN BIAYA</b></td>
        </tr>
    </table>
    <table class="tabel-pengikut">
        <tr style="border: 1px solid white;">
            <td class="set-td">WBS Level 4
            </td>
            <td class="set-td">Cost Element
            </td>
            <td class="set-td">AFE/Project No
            </td>
        </tr>
        <tr style="height: 5px !important;">
            <td class="body-pengikut">
            </td>
            <td class="body-pengikut">
            </td>
            <td class="body-pengikut">
            </td>
        </tr>
        <tr style="height: 5px !important;">
            <td class="body-pengikut">
            </td>
            <td class="body-pengikut">
            </td>
            <td class="body-pengikut">
            </td>
        </tr>
    </table>
    <table class="tabel-pengikut">
        <tr>
            <td class="td-tujuan" rowspan="2">KETERANGAN</td>
            <td class="td-tujuan" colspan="4">TUJUAN</td>
        </tr>
        <tr>
            <td class="td-tujuan">I</td>
            <td class="td-tujuan">II</td>
            <td class="td-tujuan">III</td>
            <td class="td-tujuan">IV</td>
        </tr>
        <tr>
            <td class="td-tujuan" style="text-align:left;">Tanggal Tiba
            </td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
        </tr>
        <tr>
            <td class="td-tujuan" style="text-align:left;">Tanggal Kembali
            </td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
        </tr>
        <tr>
            <td style="text-align:left;border: 1px solid black;">NAMA & TANDA TANGAN PEJABAT YANG DIKUNJUNGI
                <br>(Untuk Kunjungan Ke Pihak Ke 3 Agar Membubuhkan Stempel Instansi / Perusahaan Yang Dikunjungi)
            </td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
            <td class="td-tujuan"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="font-size:8px;">* Untuk Perjalanan Dinas
                <br>**Untuk Cuti dan Training
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="font-size:8px;">Tembusan</td>
            <td style="font-size:8px;">: 1. HCR / FHR</td>
            <td style="font-size:8px;">2. ARSIP DEPT YBS</td>
            <td style="font-size:8px;">3.KLINIK(Jika ada perubahan status keluarga)</td>
        </tr>
    </table>
</body>

</html>