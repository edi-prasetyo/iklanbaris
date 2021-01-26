<?php
$meta = $this->meta_model->get_meta();
// error_reporting(0);
// ini_set('display_errors', 0);
?>
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
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <h2>Contact Us</h2>
        <p><?php echo $meta->description; ?></p>

        <div class="row">

          <div class="col-md-2 col-2">
            <i class="ri-building-line"></i>
          </div>
          <div class="col-md-10 col-10">
            <?php echo $meta->alamat; ?>
          </div>

          <div class="col-md-2 col-2">
            <i class="ri-whatsapp-line"></i>
          </div>
          <div class="col-md-10 col-10">
            <?php echo $meta->telepon; ?>
          </div>

          <div class="col-md-2 col-2">
            <i class="ri-mail-send-line"></i>
          </div>
          <div class="col-md-10 col-10">
            <?php echo $meta->email; ?>
          </div>


        </div>

      </div>
    </div>
  </div>
</div>