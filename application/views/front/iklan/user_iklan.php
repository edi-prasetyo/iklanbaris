<!--  Breadcrumbs  -->
<div class="breadcrumbs mt-3">
    <div class="container">
        <ol>
            <li><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li><?php echo $title ?></li>
        </ol>


    </div>
</div><!-- End Breadcrumbs -->
<div class="container">
    <div class="row">


        <?php if (!empty($iklan)) : ?>

            <div class="col-md-9">


                <div class="card my-2">
                    <div class="card-header">Info Penjual</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="img-avatar">
                                    <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $user_list->user_image); ?>">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h3><a href="<?php echo base_url('iklan/user/' . $user_list->username); ?>"> <?php echo $user_list->user_name; ?></a></h3>
                                <p class="my-3"><i class="ri-map-pin-fill"></i> <?php echo $user_list->user_address; ?></p>

                                <!-- <button id="change-phrase" type="button">Change Phrase</button> -->
                                <button id="change-phrase" class="btn btn-warning px-3"> <i class="ri-phone-line"></i> Tampilkan Nomor</button>
                                <span class="btn btn-success px-3"> <i class="ri-whatsapp-line"></i> </span>
                                <br>

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
        content.innerHTML = '<?php echo $user_list->user_phone; ?>';
    };
</script>