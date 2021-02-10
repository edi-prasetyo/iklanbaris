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

<div class="container my-2">

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

                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <h3 class="text-success"><span class="font-weight-bold"> IDR. <?php echo number_format($iklan->iklan_price, 0, ",", "."); ?> </span> <small><?php echo $iklan->iklan_negotiable; ?></small> </h3>
                                    <?php if ($iklan->iklan_featured <= date('Y-m-d')) : ?>

                                    <?php else : ?>
                                        <div class="badge badge-success"> <i class="ri-vip-crown-fill"></i> Iklan Premium </div>
                                    <?php endif; ?>
                                </div>



                                <h2><?php echo $iklan->iklan_title; ?></h2>

                                <div class="row">
                                    <div class="col-6">
                                        <strong>ID Iklan : </strong><?php echo $iklan->id_iklan; ?>
                                    </div>
                                    <div class="col-6">
                                        <strong>Dilihat : </strong>
                                        <?php echo $iklan->iklan_views; ?> kali
                                    </div>
                                    <div class="col-6">
                                        <strong>Kategori : </strong><?php echo $iklan->category_name; ?>
                                    </div>
                                    <div class="col-6">
                                        <strong>Lokasi : </strong><?php echo $iklan->province_name; ?>
                                    </div>
                                </div>

                                <h5 class="my-4">Hubungi Penjual</h5>
                                <i class="ri-user-3-fill"></i> <a href="<?php echo base_url('iklan/user/' . $iklan->username); ?>"><?php echo $iklan->user_name; ?></a>
                                <br>
                                <button id="change-phrase" class="btn btn-warning px-3"> <i class="ri-phone-line"></i> Tampilkan Nomor</button>
                                <?php if ($iklan->user_whatsapp == true) : ?>
                                    <a href="https://api.whatsapp.com/send?phone=<?php echo $iklan->user_phone; ?>" class="btn btn-success px-3 text-white my-2"> <i class="ri-whatsapp-line"></i> Chat Whatsapp </a>
                                <?php else : ?>
                                <?php endif; ?>

                                <br>
                                <a href="" data-toggle="modal" data-target="#exampleModal"> <i class="ri-error-warning-line"></i> Laporkan Iklan</a>
                                <div class="alert alert-danger">
                                    <i class="ri-folder-warning-line"></i> Peringatan..!! Untuk transaksi lebih aman, jangan pernah melakukan transfer ke rekening penjual, Minta COD untuk transaksi lebih aman.
                                </div>
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
            <div class="col-md-4 my-2">


                <ul class="list-group">
                    <li class="list-group-item active bg-info border-0" aria-current="true">Tips membeli</li>
                    <?php foreach ($regularity_buyer as $regularity_buyer) : ?>
                        <li class="list-group-item"><?php echo $regularity_buyer->regularity_name; ?></li>

                    <?php endforeach; ?>
                </ul>

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

<?php


?>

<script>
    var button = document.getElementById('change-phrase'),
        content = document.getElementById('change-phrase');

    button.onclick = function() {
        content.innerHTML = '<i class="ri-phone-line"></i> <?php
                                                            $hp = substr_replace($iklan->user_phone, '0', 0, 2);
                                                            echo $hp; ?>';
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