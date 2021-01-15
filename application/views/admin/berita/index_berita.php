<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold"><?php echo $title; ?></h6>
        <a href="<?php echo base_url('admin/berita/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Berita</a>
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
                    <th>Judul Berita</th>
                    <th>Kategori</th>
                    <th>Post by</th>
                    <!-- <th>Tanggal</th> -->
                    <th>Views</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($berita as $berita) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $berita->berita_title; ?></td>
                    <td><?php echo $berita->category_name; ?></td>
                    <td><?php echo $berita->user_name; ?></td>
                    <!-- <td><?php //echo date('D, d F Y', $berita->date_created); 
                                ?> <?php //echo date('H:i', $berita->date_created); 
                                    ?></td> -->
                    <td><?php echo $berita->berita_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('blog/detail/' . $berita->berita_slug); ?>" class="btn btn-success btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/berita/update/' . $berita->id); ?>" class="btn btn-info btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
                        <?php include "delete_berita.php"; ?>
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