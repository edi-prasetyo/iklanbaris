<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Form Open
                echo form_open(base_url('admin/package'));
                ?>

                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" class="form-control" name="package_name" placeholder="Nama Paket">
                    <?php echo form_error('package_name', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Harga Paket</label>
                    <input type="text" class="form-control" name="package_price" placeholder="Harga Paket">
                    <?php echo form_error('package_price', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Jumlah Post</label>
                    <input type="text" class="form-control" name="package_post" placeholder="Jumlah Post">
                    <?php echo form_error('package_post', '<small class="text-danger">', '</small>'); ?>
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