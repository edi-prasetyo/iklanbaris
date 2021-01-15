<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-8 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pemasukan Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_pemasukan_user, '0', ',', '.'); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/products'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-success">Lihat Data Pemasukan</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-import fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pengeluaran Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_pengeluaran_user, '0', ',', '.'); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/category_products'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-danger">Lihat Data Pengeluaran</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-export fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card mb-4">
            <div class="card-body">
                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo '<div class="alert alert-success alert-dismissable fade show">';
                    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                    echo $this->session->flashdata('message');
                    echo '</div>';
                }


                ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>">
                            </div>
                            <div class="col-md-9">

                                <h2> <?php echo $user->user_name; ?></h2>
                                <i class="fas fa-store"></i> <?php echo $user->asrama_name; ?><br>
                                <i class="fab fa-whatsapp"></i> <?php echo $user->user_phone; ?><br>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <a href="<?php echo base_url('admin/myaccount/update'); ?>" class="btn btn-success bg-gradient-success btn-block"> <i class="ti-user"></i> Ubah Profile</a>
                        <a href="<?php echo base_url('admin/myaccount/ubah_password'); ?>" class="btn btn-primary bg-gradient-primary btn-block"> <i class="ti-lock"></i> Ubah Password</a>
                        <!-- <a href="" class="btn btn-danger bg-gradient-danger btn-block"> Pengeluaran</a> -->
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>






    </div>


</div>