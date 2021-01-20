<!-- Invoice Example -->
<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>

<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <?php include "create_regularity.php"; ?>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Peraturan</th>
                    <th>Type</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($regularity as $regularity) : ?>
                    <tr>
                        <td class="text-info"><?php echo $no; ?></td>
                        <td><?php echo $regularity->regularity_name; ?></td>
                        <td>
                            <?php if ($regularity->regularity_type == "Seller") : ?>
                                <div class="badge badge-success">Penjual</div>
                            <?php else : ?>
                                <div class="badge badge-info">Pembeli</div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php include "update_regularity.php"; ?>
                            <?php include "delete_regularity.php"; ?>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>