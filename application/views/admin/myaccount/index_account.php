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
    <!-- Basic Button -->
    <div class="col-lg-9">
        <div class="card mb-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>">
                            </div>
                            <div class="col-md-9">

                                <h2><i class="fas fa-store"></i> <?php echo $user->user_name; ?></h2>
                                <i class="fab fa-whatsapp"></i> <?php echo $user->user_phone; ?><br>
                                <i class="far fa-map"></i> <?php echo $user->user_address; ?><br>
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


    <div class="col-lg-9">
        <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                  <label class="col-lg-3 col-form-label">Nama
                  </label>
                  <div class="col-lg-9">
                      : <?php echo $user->user_name;?>
                  </div>

                  <label class="col-lg-3 col-form-label">Email
                  </label>
                  <div class="col-lg-9">
                      : <?php echo $user->email;?>
                  </div>

                  <label class="col-lg-3 col-form-label">Biografi
                  </label>
                  <div class="col-lg-9">
                      : <?php echo $user->user_bio;?>
                  </div>
                  

              </div>
            </div>
        </div>
    </div>




</div>
