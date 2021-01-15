<div class="card">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">
            <?php
            //Error warning
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            echo form_open_multipart(base_url('admin/category/update/' . $category->id));

            ?>

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control" name="category_name" value="<?php echo $category->category_name ?>">
            </div>

            <div class="form-group">
                <label>Tipe</label>
                <select name="category_type" class="form-control form-control-chosen">
                    <option value="Blog" <?php if ($category->category_type == "Blog") {
                                                echo "selected";
                                            } ?>>Blog</option>
                    <option value="Iklan" <?php if ($category->category_type == "Iklan") {
                                                echo "selected";
                                            } ?>>Iklan</option>

                </select>
            </div>

            <div class="form-group">
                <label class="col-lg-3 col-form-label">Ubah icon <span class="text-danger">*</span>
                </label>
                <img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>">
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input type="file" name="category_image">
                    </div>
                </div>
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