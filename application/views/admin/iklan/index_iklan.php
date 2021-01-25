<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

        <?php echo $title; ?>

        <?php echo form_open('admin/iklan'); ?>

        <div class="col-sm-12 my-1 row">

            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" name="id_iklan" placeholder="ID Iklan">
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Cari</button>

            </div>

        </div>
        <?php echo form_close(); ?>

    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }
    ?>

    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Member</th>
                    <th>Status</th>

                    <th width="30%"></th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($iklan as $iklan) { ?>
                <?php if ($iklan->iklan_featured >= date('Y-m-d')) : ?>
                    <tr style="background-color:#deffee">
                    <?php elseif ($iklan->iklan_status == "Inactive") : ?>
                    <tr style="background-color:#ffdede">
                    <?php else : ?>
                    <tr>
                    <?php endif; ?>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $iklan->id_iklan; ?></td>
                    <td><?php echo $iklan->iklan_title; ?></td>
                    <td><?php echo $iklan->user_name; ?></td>
                    <td><?php if ($iklan->iklan_status == "Active") : ?>
                            <span class="badge badge-success" ;?>
                                <?php echo $iklan->iklan_status; ?>
                            </span>
                        <?php elseif ($iklan->iklan_status == "Inactive") : ?>
                            <span class="badge badge-danger" ;?>
                                <?php echo $iklan->iklan_status; ?>
                            </span>
                        <?php else : ?>
                            <span class="badge badge-warning" ;?>
                                <?php echo $iklan->iklan_status; ?>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/iklan/view/' . $iklan->id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/iklan/inactive/' . $iklan->id); ?>" class="btn btn-warning btn-sm text-white"><i class="ri-error-warning-line"></i> Inactive</a>
                        <?php include "delete_iklan.php"; ?>
                    </td>
                    </tr>

                <?php $no++;
            }; ?>
        </table>



    </div>
    <div class="card-footer">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>

</div>