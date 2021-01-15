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
<!-- Invoice Example -->
<div class="mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>

            <!-- <a class="m-0 float-right btn btn-primary btn-sm" href="<?php echo base_url('admin/pemasukan/filter_pemasukan'); ?>"> Lihat Per tanggal <i class="fa fa-calendar ml-3"></i></a> -->
            <a class="m-0 float-right btn btn-primary btn-sm bg-gradient-primary" href="<?php echo base_url('admin/home/create_pemasukan'); ?>">Add New <i class="ti-plus"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Donatur</th>
                        <th>kategori</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pemasukan as $pemasukan) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($pemasukan->tanggal)); ?></td>
                            <td><?php echo $pemasukan->donatur_name; ?></td>
                            <td><?php echo $pemasukan->category_name; ?></td>
                            <td><span class="badge badge-success"><?php echo $pemasukan->type; ?></span></td>
                            <td>
                                <?php if ($pemasukan->nominal == NULL) : ?>
                                    Rp. <?php echo '0'; ?>
                                <?php else : ?>
                                    Rp. <?php echo number_format($pemasukan->nominal, '0', ',', '.') ?>
                                <?php endif; ?>


                            </td>
                            <td>
                                <?php include "view_pemasukan.php"; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th width="5%"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-size: 30px;">Jumlah</th>
                        <th style="font-size: 30px;">Rp. <?php echo number_format($total_pemasukan_user, '0', ',', '.'); ?></th>
                        <th width="22%"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">



        </div>



    </div>

    <div class="pagination col-md-12 text-center mt-3">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>
</div>