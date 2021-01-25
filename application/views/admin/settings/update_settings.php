<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/settings/update/' . $settings->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Moderasi iklan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <select name="moderation" class="form-control custom-select">
                    <option value="Pending" <?php if ($settings->moderation == "Pending") {
                                                echo "selected";
                                            } ?>>Aktif</option>
                    <option value="Active" <?php if ($settings->moderation == "Active") {
                                                echo "selected";
                                            } ?>>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Jangka Waktu Iklan Premium <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="premium_range" value="<?php echo $settings->premium_range; ?>">
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-4"></div>
            <div class="col-lg-8">
                <button type="submit" class="btn btn-info btn-lg btn-block">
                    Update Pengaturan
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>