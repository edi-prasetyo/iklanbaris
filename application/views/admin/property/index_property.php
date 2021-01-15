
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
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th width="10%">Gambar</th>
                        <th>Judul</th>
                        <th>Harga</th>
                        <th>Post by</th>
                        <th>date Post</th>
                        <th>Views</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($property as $property) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                          <td><img class="img-fluid" src="<?php echo base_url('assets/img/property/' .$property->property_image); ?>"></td>
                        <td><?php echo $property->property_title; ?></td>
                        <td><?php echo $property->property_price; ?></td>
                        <td><img class="img-profile rounded-circle" style="max-width:40px" src="<?php echo base_url('assets/img/avatars/' .$property->user_image); ?>"><br><?php echo $property->user_name; ?></td>
                        <td><?php echo date('D, d F Y', $property->date_created); ?> <?php echo date('H:i', $property->date_created); ?></td>
                        <td><?php echo $property->property_views; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/berita/create'); ?>" class="btn btn-success"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/berita/update/' . $property->id); ?>" class="btn btn-info"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_property.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>

            <hr>

            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>
