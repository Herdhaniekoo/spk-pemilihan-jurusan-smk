<!-- Modal Edit -->
<?php foreach ($pengguna as $p) : ?>
  <div class="modal fade" id="modalEditPengguna<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="edit">Edit Pengguna</h5>
        </div>
        <?= form_open_multipart('admin/editPengguna'); ?>
        <input type="hidden" name="id" value="<?= $p['id']; ?>">

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $p['nama']; ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $p['email']; ?>" required>
          </div>

          <div class="form-group">
            <select class="form-control" name="role_id" id="role_id">
              <option value="<?= $p['role_id']; ?>"> Role =
                <?php
                  if ($p['role_id'] == 1) {
                    $p['role_id'] = 'Admin';
                  } elseif ($p['role_id'] == 2) {
                    $p['role_id'] = 'User';
                  }
                  ?>
                <?= $p['role_id']; ?>
              </option>
              <option value="1">Admin</option>
              <option value="2">User</option>
            </select>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
              <label class="form-check-label" for="is_active">
                Aktif?
              </label>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-4">
              <img width="150px" src="<?= base_url('assets/images/') . $p['image']; ?>" class="img-circle profile_img">
            </div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-9">
                  <div class="custom-file">
                    <br>
                    <br>
                    <br>
                    <input type="file" class="custom-file-input" id="image" name="image" required>
                    <label class="custom-file-label" for="image"></label>
                  </div>
                </div>
              </div>
            </div>
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