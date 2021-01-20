<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Peraturan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Form Open
                echo form_open(base_url('admin/regularity/create'));
                ?>

                <div class="form-group">
                    <label>Nama Peraturan</label>
                    <input type="text" class="form-control" name="regularity_name" placeholder="Judul Peraturan">
                    <?php echo form_error('regularity_name', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Rules Tipe <span class="text-danger">*</span>
                    </label>

                    <select name="regularity_type" class="form-control custom-select">
                        <option value="Buyer">Pembeli</option>
                        <option value="Seller">Penjual</option>
                    </select>

                </div>



                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->