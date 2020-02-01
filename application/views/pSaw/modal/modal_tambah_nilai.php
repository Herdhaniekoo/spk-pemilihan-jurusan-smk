<!-- Modal Tambah -->
<?php foreach ($nilai_siswa as $ns) : ?>
    <div class="modal fade" id="modalTambahNilai<?= $ns['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalTambahNilaiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalTambahNilai">Tambah Nilai</h5>
                </div>
                <?= form_open_multipart('pSaw/tambahNilai'); ?>
                <input type="hidden" name="id_siswa" value="<?= $ns['id_siswa']; ?>">
                <!-- <input type="hidden" name="id_jurusan" value="<?= $ns['id_jurusan']; ?>"> -->

                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="c1" name="c1" placeholder="Nilai MTK" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c2" name="c2" placeholder="Nilai IPA" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3" name="c3" placeholder="Nilai Bahasa Indonesia" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c4" name="c4" placeholder="Nilai Bahasa Inggris" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c5" name="c5" placeholder="Nilai Tes Fisik" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c6" name="c6" placeholder="Nilai Tes Psikologi" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c7" name="c7" placeholder="Nilai Tes Wawancara" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c8" name="c8" placeholder="Nilai Tes Tulis" required>
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
<?php endforeach; ?>