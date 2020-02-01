<!-- modal -->
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalTambahSiswa">Tambah Siswa</h5>
            </div>
            <?= form_open_multipart('pSaw/dataSiswa'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <input type="text" class="form-control" id="no_daftar" name="no_daftar" placeholder="No pendaftaran" value="<?= $kode; ?>" required readonly>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama siswa" required>
                </div>

                <div class="form-group">
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <optionvalue="<?= $ds['jenis_kelamin']; ?>">Jenis Kelamin</option>
                            <?php
                            if ($ds['jenis_kelamin'] == 1) {
                                $ds['jenis_kelamin'] = 'Laki - Laki';
                            } else {
                                $ds['jenis_kelamin'] = 'Perempuan';
                            }
                            ?>

                            <option value="1">Laki - Laki</option>
                            <option value="2">Perempuan</option>
                    </select>
                </div>


                <div class="form-group">
                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Asal sekolah" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-round btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
