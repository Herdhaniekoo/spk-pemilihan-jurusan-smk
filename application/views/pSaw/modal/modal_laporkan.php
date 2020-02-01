<!-- modal -->

<!-- Modal Cetak -->
<?php foreach ($cetak as $c) : ?>
    <div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="modalCetakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalCetak">Laporkan</h5>
                </div>
                <?= form_open_multipart('pSaw/cetak'); ?>

                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="id_siswa" name="id_siswa" value="<?= $c['id_siswa']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $c['nama_siswa']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= $c['asal_sekolah']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $c['alamat']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="id_jurusan" value="<?= $c['id_jurusan']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?= $c['nama_jurusan']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="total" name="total" value="<?= $c['total']; ?>" required readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-round btn-primary">Laporkan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>