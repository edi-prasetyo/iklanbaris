<?php
$meta = $this->meta_model->get_meta();
// error_reporting(0);
// ini_set('display_errors', 0);
?>
<!--  Breadcrumbs Section -->
<section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        <ol>
          <li><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

<div class="container">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h2>Contact Us</h2>
                <p><?php echo $meta->description;?></p>
                
                    <div class="row">

                      <div class="col-md-2 col-2">
                          <i class="ri-building-line"></i>
                      </div>
                      <div class="col-md-10 col-10">
                         <?php echo $meta->alamat;?>
                      </div>

                      <div class="col-md-2 col-2">
                          <i class="ri-whatsapp-line"></i>
                      </div>
                      <div class="col-md-10 col-10">
                         <?php echo $meta->telepon;?>
                      </div>

                      <div class="col-md-2 col-2">
                      <i class="ri-mail-send-line"></i>
                      </div>
                      <div class="col-md-10 col-10">
                         <?php echo $meta->email;?>
                      </div>
                    

                    </div>
                
            </div>
        </div>
    </div>
</div>