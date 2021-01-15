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

<div class="mb-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
            <a href="<?php echo base_url('admin/layanan/create'); ?>">Add Layanan</a>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul Layanan</th>
                        <th>Ikon Layanan</th>
                        <th width="23%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($layanan as $layanan) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo $layanan->layanan_title; ?></td>
                            <td><?php echo $layanan->layanan_icon; ?> </td>

                            <td>
                                <a href="<?php echo base_url('layanan/detail/' . $layanan->layanan_slug); ?>" class="btn btn-sm btn-primary"><i class="ti-eye"></i> Lihat</a>
                                <a href="<?php echo base_url('admin/layanan/update/' . $layanan->id); ?>" class="btn btn-sm btn-info"><i class="ti-eye"></i> Update</a>
                                <?php include "delete_layanan.php"; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
</div>