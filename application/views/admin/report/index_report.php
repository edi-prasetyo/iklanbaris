<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold"><?php echo $title; ?></h6>

    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success alert-dismissable fade show">';
        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
        echo $this->session->flashdata('message');
        echo '</div>';
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>


    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID IKlan</th>
                    <th>Judul</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($report as $report) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $report->id_iklan; ?></td>
                    <td><?php echo $report->iklan_title; ?></td>

                    <td>
                        <a href="<?php echo base_url('admin/iklan/view/' . $report->iklan_id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
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