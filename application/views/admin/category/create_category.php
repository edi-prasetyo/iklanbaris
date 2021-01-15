<div class="card">
    <?php
    echo $this->session->flashdata('message');
    if (isset($error_upload)) {
        echo '<div class="alert alert-warning">' . $error_upload . '</div>';
    }
    ?>

    <div class="card-header">
        <h4 class="modal-title">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>

    </div>
    <div class="card-body">
        <?php
        //Form Open
        echo form_open_multipart(base_url('admin/category/create'));
        ?>

        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori">
            <?php echo form_error('category_name', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Status Berita <span class="text-danger">*</span>
            </label>

            <select name="category_type" class="form-control form-control-chosen">
                <option value="Blog">Blog</option>
                <option value="Iklan">Iklan</option>
            </select>

        </div>

        <div class="form-group">
            <label class="col-lg-3 col-form-label">Upload icon <span class="text-danger">*</span>
            </label>
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