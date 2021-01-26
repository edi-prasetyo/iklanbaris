<div class="container">
    <section class="breadcrumbs mt-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <ol>
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ol>
        </div>
    </section>
</div>

<div class="container my-2">
    <div class="row">
        <?php if (!empty($iklan)) : ?>

            <div class="col-md-9">

                <?php foreach ($iklan_premium as $iklan_premium) : ?>
                    <a href="<?php echo base_url('iklan/detail/' . $iklan_premium->iklan_slug); ?>">
                        <div class="card my-2 bg-premium">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="img-index-frame">
                                        <img src="<?php echo base_url('assets/img/iklan/' . $iklan_premium->iklan_image); ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-success">IDR <?php echo number_format($iklan_premium->iklan_price, 0, ",", "."); ?></h4>
                                            <span class="badge badge-success badge-pill"><?php echo $iklan_premium->category_name; ?></span>
                                        </div>
                                        <h5 class="text-muted"> <?php echo $iklan_premium->iklan_title; ?></h5>
                                        <small><span class="text-muted">ID Iklan : </span> <?php echo $iklan_premium->id_iklan; ?> <span class="text-muted ml-5">Dilihat : </span> <?php echo $iklan_premium->iklan_views; ?> <span class="text-muted ml-5"> Lokasi : <?php echo $iklan_premium->province_name; ?> </small><br>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>


                <?php foreach ($iklan as $data) : ?>

                    <a href="<?php echo base_url('iklan/detail/' . $data['iklan_slug']); ?>">
                        <div class="card my-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="img-index-frame">
                                        <img src="<?php echo base_url('assets/img/iklan/' . $data['iklan_image']); ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-success">IDR <?php echo number_format($data['iklan_price'], 0, ",", "."); ?></h4>
                                            <span class="badge badge-success badge-pill"><?php echo $data['category_name']; ?></span>
                                        </div>
                                        <h5 class="text-muted"> <?php echo $data['iklan_title']; ?></h5>
                                        <small><span class="text-muted">ID Iklan : </span> <?php echo $data['id_iklan']; ?> <span class="text-muted ml-5">Dilihat : </span> <?php echo $data['iklan_views']; ?> <span class="text-muted ml-5"> Lokasi : <?php echo $data['province_name']; ?> </small><br>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>

                <div class="pagination col-md-12">
                    <?php if (isset($pagination)) {
                        echo $pagination;
                    } ?>
                </div>
            </div>

        <?php else : ?>

            <div class="col-md-9">
                <div class="card my-2">
                    <div class="card-body display-5 text-center">
                        <span class="my-3">Tidak Ada Iklan yang di tampilkan </span><br>
                        di Halaman <b><?php echo $title ?></b> <br>
                        <a href="<?php echo base_url(); ?>" class="btn btn-success text-white my-3">Kembali ke Home</a>

                    </div>

                </div>
            </div>



        <?php endif; ?>



        <div class="col-md-3">

            <!-- Search form (start) -->
            <?php echo form_open('iklan/search'); ?>
            <div class="input-group mb-3">
                <input type="text" name='search' class="form-control" placeholder="Cari Produk.." value='<?= $search ?>'>
                <div class="input-group-append">
                    <input type='submit' name='submit' value='Cari' class="btn btn-info">
                </div>
            </div>
            <?php echo form_close(); ?>


            <div class="card">
                <div class="card-header">
                    Semua Kategori
                </div>

                <ul class="list-group list-group-flush">
                    <?php foreach ($category as $category) : ?>
                        <a href="<?php echo base_url('iklan/category/' . $category->category_slug); ?>">
                            <li class="list-group-item"><img width="10%" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>"> <?php echo $category->category_name; ?></li>
                        </a>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>




    </div>
</div>