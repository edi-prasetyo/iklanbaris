<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-header-right">

        </div>

    </div>
    <div class="card-body">
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
        <a href="<?php echo base_url('admin/bank/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Data Bank</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th width="10%">Logo</th>
                        <th>Nama Bank</th>
                        <th>No. Rekening</th>
                        <th>Atas Nama</th>
                        <th>Cabang</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($bank as $bank) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><img class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>"></td>
                        <td><?php echo $bank->bank_name; ?></td>
                        <td><?php echo $bank->bank_number; ?></td>
                        <td><?php echo $bank->bank_account; ?></td>
                        <td><?php echo $bank->bank_branch; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/bank/create'); ?>" class="btn btn-success btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/bank/update/' . $bank->id); ?>" class="btn btn-info btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_bank.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>

            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>