<!-- modal -->

<!-- Modal Selesai -->
<?php foreach ($hasil_seleksi as $hs) : ?>
    <div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="modalSelesaiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalSelesai">Input Data Laporan</h5>
                </div>
                <?= form_open_multipart('pSaw/selesai'); ?>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-round btn-success">Input ke laporan</button>
                </div>
                <?php foreach ($nilai_jurusan as $ns) : ?>
                    <tr>
                        <?php
                        $ns['id_siswa'];
                        $jumlahC1 = ($ns['C1'] / $maxC1['C1']) * $bobotC1['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC2 = ($ns['C2'] / $maxC2['C2']) * $bobotC2['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC3 = ($ns['C3'] / $maxC3['C3']) * $bobotC3['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC4 = ($ns['C4'] / $maxC4['C4']) * $bobotC4['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC5 = ($ns['C5'] / $maxC5['C5']) * $bobotC5['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC6 = ($ns['C6'] / $maxC6['C6']) * $bobotC6['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC7 = ($ns['C7'] / $maxC7['C7']) * $bobotC7['bobot_kriteria']
                        ?>
                        <?php
                        $jumlahC8 = ($ns['C8'] / $maxC8['C8']) * $bobotC8['bobot_kriteria']
                        ?>

                        <?php
                        $sum = [$jumlahC1, $jumlahC2, $jumlahC3, $jumlahC4, $jumlahC5, $jumlahC6, $jumlahC7, $jumlahC8];
                        $total = array_sum($sum);
                        ?>
                    </tr>

                    <div class="modal-body">
                        <input type="text" class="form-control" name="id_jurusan[]" value="<?= $ns['id_jurusan']; ?>">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_siswa" name="id_siswa[]" placeholder="Id siswa" value="<?= $hs['id_siswa']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="no_daftar" name="no_daftar[]" placeholder="No pendaftaran" value="<?= $hs['no_daftar']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="nama_siswa" name="nama_siswa[]" placeholder="Nama siswa" value="<?= $hs['nama_siswa']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="asal_sekolah" name="asal_sekolah[]" placeholder="Asal sekolah" value="<?= $hs['asal_sekolah']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="alamat" name="alamat[]" placeholder="Alamat" value="<?= $hs['alamat']; ?>" required readonly>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="total" name="total[]" placeholder="Rekomendasi 1" value="<?= $total; ?>" required readonly>
                        </div>
                    </div>
                <?php endforeach; ?>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>