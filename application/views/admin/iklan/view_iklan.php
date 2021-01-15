<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <?php if ($iklan->iklan_status == 'Active') : ?>
            <span class="badge badge-success"> <?php echo $iklan->iklan_status; ?></span>
        <?php else : ?>
            <span class="badge badge-danger"> <?php echo $iklan->iklan_status; ?></span>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        ?>
        <div class="row">


            <div class="col-md-4">
                <h3><?php echo $iklan->iklan_title; ?></h3>
                <img class="img-fluid" src="<?php echo base_url('assets/img/iklan/' . $iklan->iklan_image); ?>">
                <a href="<?php echo base_url('admin/iklan/inactive/' . $iklan->id); ?>" class="btn btn-warning btn-sm text-white"><i class="ri-error-warning-line"></i> Inactive</a>
                <a href="<?php echo base_url('admin/iklan/active/' . $iklan->id); ?>" class="btn btn-success btn-sm text-white"><i class="ri-check-line"></i> Active</a>
                <?php include "delete_iklan.php"; ?>
            </div>
            <div class="col-md-8">
                <?php echo $iklan->iklan_desc; ?>
            </div>

        </div>
    </div>
</div>