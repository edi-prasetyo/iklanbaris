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



                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="img-avatar">
                                            <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $user_list->user_image); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-9">

                                        <h2><i class="fas fa-store"></i> <?php echo $user_list->user_name; ?></h2>

                                        <i class="far fa-map"></i><?php echo $user_list->user_address; ?><br>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <!-- <button id="change-phrase" type="button">Change Phrase</button> -->
                                <button id="change-phrase" class="btn btn-warning mb-3 btn-block"> <i class="ri-phone-line"></i> Tampilkan Nomor</button>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo $user_list->user_phone; ?>" class="btn btn-success px-3 text-white my-2 btn-block"> <i class="ri-whatsapp-line"></i> Chat Whatsapp </a>
                            </div>
                        </div>
                    </div>

                </div>


                <?php foreach ($iklan as $iklan) : ?>

                    <a href="<?php echo base_url('iklan/detail/' . $iklan->iklan_slug); ?>">
                        <div class="card my-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="img-index-frame">
                                        <img src="<?php echo base_url('assets/img/iklan/' . $iklan->iklan_image); ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-success">IDR <?php echo number_format($iklan->iklan_price, 0, ",", "."); ?></h4>
                                            <span class="badge badge-success badge-pill"><?php echo $iklan->category_name; ?></span>
                                        </div>
                                        <h5 class="text-muted"> <?php echo $iklan->iklan_title; ?></h5>
                                        <small><span class="text-muted">ID Iklan : </span> <?php echo $iklan->id_iklan; ?> <span class="text-muted ml-5">Dilihat : </span> <?php echo $iklan->iklan_views; ?> <span class="text-muted ml-5"> Lokasi : <?php echo $iklan->province_name; ?> </small><br>

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
            <div class="card">
                <div class="card-header">
                    Semua Kategori
                </div>

                <ul class="list-group list-group-flush">
                    <?php foreach ($category as $category) : ?>
                        <li class="list-group-item"><a href="<?php echo base_url('iklan/category/' . $category->category_slug); ?>"> <img width="10%" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>"> <?php echo $category->category_name; ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>


    </div>
</div>

<script>
    var button = document.getElementById('change-phrase'),
        content = document.getElementById('change-phrase');

    button.onclick = function() {
        content.innerHTML = '<i class="ri-phone-line"></i> <?php
                                                            $hp = substr_replace($user_list->user_phone, '0', 0, 2);
                                                            echo $hp; ?>';
    };
</script>