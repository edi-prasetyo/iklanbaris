<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/company/update/'.$company->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Perusahaan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="company_name" placeholder="Nama Perusahaan" value="<?php echo $company->company_name; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Telepon Perusahaan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="company_phone" placeholder="Telepon Perusahaan" value="<?php echo $company->company_phone; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Alamat Perusahaan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" name="company_address" placeholder="Alamat Perusahaan"><?php echo $company->company_address; ?></textarea>

            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Ganti Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="company_logo">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/logo/'.$company->company_logo);?>">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update Perusahaan
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
