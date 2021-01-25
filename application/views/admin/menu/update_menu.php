<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/menu/update/' . $menu->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Menu <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="menu_name" value="<?php echo $menu->menu_name; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Url <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="menu_url" value="<?php echo $menu->menu_url; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Lokasi Menu <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="menu_location" class="form-control custom-select">
                    <option value="footer_1" <?php if ($menu->menu_location == "footer_1") {
                                                    echo "selected";
                                                } ?>>Footer 1</option>
                    <option value="footer_2" <?php if ($menu->menu_location == "footer_2") {
                                                    echo "selected";
                                                } ?>>Footer 2</option>
                    <option value="footer_3" <?php if ($menu->menu_location == "footer_3") {
                                                    echo "selected";
                                                } ?>>Footer 3</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update Menu
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>