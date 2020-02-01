<!-- modal -->

<!-- Modal Edit -->
<?php foreach ($nilai_siswa as $ns) : ?>
    <div class="modal fade" id="modalNormalisasi<?= $ns['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalNormalisasiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalNormalisasi">Hitung</h5>
                </div>
                <?= form_open_multipart('pSaw/insertKonversi'); ?>
                <input type="hidden" name="id_siswa" value="<?= $ns['id_siswa']; ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="C1" name="C1" placeholder="" value="<?= $ns['C1']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C2" name="C2" placeholder="" value="<?= $ns['C2']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C3" name="C3" placeholder="" value="<?= $ns['C3']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C4" name="C4" placeholder="" value="<?= $ns['C4']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C5" name="C5" placeholder="" value="<?= $ns['C5']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C6" name="C6" placeholder="" value="<?= $ns['C6']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C7" name="C7" placeholder="" value="<?= $ns['C7']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="C8" name="C8" placeholder="" value="<?= $ns['C8']; ?>">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-round btn-primary">Normalisasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>