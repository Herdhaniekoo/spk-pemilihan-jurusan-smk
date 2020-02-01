<!-- modal -->
<!-- Modal Edit -->
<?php foreach ($datasiswa as $ds) : ?>
    <div class="modal fade" id="modalEditSiswa<?= $ds['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalEditSiswa">Edit Data Siswa</h5>
                </div>
                <?= form_open_multipart('pSaw/editSiswa'); ?>
                <input type="hidden" name="id_siswa" value="<?= $ds['id_siswa']; ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="no_daftar" name="no_daftar" placeholder="No pendaftaran" value="<?= $ds['no_daftar']; ?>" required readonly>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama siswa" value="<?= $ds['nama_siswa']; ?>" required>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="<?= $ds['jenis_kelamin']; ?>"> Role =
                                <?php
                                if ($ds['jenis_kelamin'] == 1) {
                                    $ds['jenis_kelamin'] = 'Laki - Laki';
                                } elseif ($ds['jenis_kelamin'] == 2) {
                                    $ds['jenis_kelamin'] = 'Perempuan';
                                }
                                ?>
                                <?= $ds['jenis_kelamin']; ?>
                            </option>
                            <option value="1">Laki - Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Asal sekolah" value="<?= $ds['asal_sekolah']; ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $ds['alamat']; ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-round btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>