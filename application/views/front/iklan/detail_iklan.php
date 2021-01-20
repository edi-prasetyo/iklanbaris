<div class="container">
    <section class="breadcrumbs my-2">
        <div class="d-sm-flex align-items-center justify-content-between">
            <ol>
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url('/' . $this->uri->segment(1)) ?>">
                        <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(1))) ?>
                    </a></li>
                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ol>
        </div>
    </section>
</div>

<div class="container">

    <?php if ($iklan->iklan_status == "Active") : ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        //Notifikasi
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <div class="img-frame"> -->
                                <img class="img-fluid" src="<?php echo base_url('assets/img/iklan/' . $iklan->iklan_image); ?>">
                                <!-- </div> -->
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-success">IDR. <?php echo number_format($iklan->iklan_price, 0, ",", "."); ?></h3>
                                <h2><?php echo $iklan->iklan_title; ?></h2>
                                <small> <span class="text-muted">ID Iklan: </span> <?php echo $iklan->id_iklan; ?> <span class="text-muted ml-5">Dilihat: </span> <?php echo $iklan->iklan_views; ?></small> <br>

                                <h4 class="my-4">Info Iklan</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Merek : </strong> <?php echo $iklan->iklan_merek; ?>
                                    </div>
                                    <div class="col-6">
                                        <strong>Model : </strong><?php echo $iklan->iklan_type; ?>
                                    </div>
                                    <div class="col-6">
                                        <strong>Kondisi : </strong><?php echo $iklan->iklan_kondisi; ?>
                                    </div>
                                    <div class="col-6">
                                        <strong>Lokasi : </strong><?php echo $iklan->province_name; ?>
                                    </div>
                                </div>

                                <h4 class="my-4">Hubungi Penjual</h4>

                                <!-- <button id="change-phrase" type="button">Change Phrase</button> -->
                                <button id="change-phrase" class="btn btn-warning px-3"> <i class="ri-phone-line"></i> Tampilkan Nomor</button>
                                <?php if ($iklan->user_whatsapp == true) : ?>
                                    <span class="btn btn-success px-3"> <i class="ri-whatsapp-line"></i> Chat Whatsapp </span>
                                <?php else : ?>
                                <?php endif; ?>

                                <br>
                                <a href="" data-toggle="modal" data-target="#exampleModal"> <i class="ri-error-warning-line"></i> Laporkan Iklan</a>


                            </div>

                        </div>

                    </div>
                </div>



            </div>

            <div class="col-md-8">
                <div class="card my-2">
                    <div class="card-header">
                        Deskripsi Iklan
                    </div>
                    <div class="card-body">
                        <?php echo $iklan->iklan_desc; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card my-2">
                    <div class="card-header">Info Penjual</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="img-avatar">
                                    <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $iklan->user_image); ?>">
                                </div>
                            </div>
                            <div class="col-8">
                                <h3><a href="<?php echo base_url('iklan/user/' . $iklan->username); ?>"> <?php echo $iklan->user_name; ?></a></h3>
                                <p class="my-3"><i class="ri-map-pin-fill"></i> <?php echo $iklan->user_address; ?></p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>






        </div>

    <?php else : ?>

        <div class="d-flex justify-content-center align-items-center my-5 py-5 text-muted">
            <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
            <div class="inline-block align-middle">
                <h2 class="font-weight-normal lead" id="desc">Halaman yang anda Cari tidak di temukan.</h2>
            </div>
        </div>

    <?php endif; ?>
</div>

<script>
    var button = document.getElementById('change-phrase'),
        content = document.getElementById('change-phrase');

    button.onclick = function() {
        content.innerHTML = '<?php echo $iklan->user_phone; ?>';
    };
</script>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laporkan Iklan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php if ($this->session->userdata('id')) : ?>
                    <?php
                    //Form Open
                    echo form_open(base_url('report'));
                    ?>
                    <input type="hidden" name="iklan_id" value="<?php echo $iklan->id; ?>" />
                    <textarea class="form-control" name="report_desc" placeholder="Tulis Deskripsi Laporan"></textarea>
                    <br>
                    <button class="form-control btn btn-primary" type="submit">Kirim Laporan</button>

                    <?php form_close(); ?>

                <?php else : ?>
                    <a class="btn btn-primary text-white" href="<?php echo base_url('auth'); ?>">Silahkan Login</a>
                <?php endif; ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

            </div>
        </div>
    </div>
</div>