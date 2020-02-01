<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="tambah">Tambah Pengguna</h5>
      </div>
      <?= form_open_multipart('admin/tambahPengguna'); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="date" class="form-control" id="date_created" name="date_created">
        </div>
        <div class="form-group">
          <select name="role_id" id="role_id" class="form-control">
            <option value="">Pilih role</option>
            <?php
            if ($r['role'] == 1) {
              $r['role'] = 'Admin';
            } else {
              $r['role'] = 'User';
            }
            ?>

            <option value="1">Admin</option>
            <option value="2">Member</option>
          </select>
        </div>
        <div class="form-group row">
          <div class="col-sm-2">Gambar</div>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" required>
                  <label class="custom-file-label" for="image"></label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
            <label class="form-check-label" for="is_active">
              Aktif?
            </label>
          </div>
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



<!-- Initialize datetimepicker -->
<script>
  $('#myDatepicker').datetimepicker();
  $('#myDatepicker2').datetimepicker({
    format: 'DD.MM.YYYY'
  });

  $('#myDatepicker3').datetimepicker({
    format: 'hh:mm A'
  });

  $('#myDatepicker4').datetimepicker({
    ignoreReadonly: true,
    allowInputToggle: true
  });

  $('#datetimepicker6').datetimepicker();

  $('#datetimepicker7').datetimepicker({
    useCurrent: false
  });

  $("#datetimepicker6").on("dp.change", function(e) {
    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
  });

  $("#datetimepicker7").on("dp.change", function(e) {
    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
  });
</script>