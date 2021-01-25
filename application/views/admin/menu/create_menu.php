<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/menu/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Menu <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="menu_name" placeholder="Nama Menu">
                <?php echo form_error('menu_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Url <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="menu_url" placeholder="Url..">
                <?php echo form_error('menu_url', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Lokasi Menu <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="menu_location" class="form-control form-control-chosen select2_demo_1">
                    <option value="footer_1">Footer 1</option>
                    <option value="footer_2">Footer 2</option>
                    <option value="footer_3">Footer 3</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Create Menu
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>