

<div class="card">
  <div class="card-header">
    <div class="card-head-row">
      <div class="card-title">Listing iklan</div>
      <div class="card-tools">
        <a class="btn btn-primary btn-round" href="<?php echo base_url('myaccount/property/create');?>"><i class="ri-add-circle-line"></i> Buat Iklan</a>
      </div>
    </div>
  </div>
</div>

<div class="row">



<?php foreach ($property as $property) :?>
  <div class="col-md-4">
              <div class="card card-post card-round">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="avatar">
                      <img src="<?php echo base_url('assets/img/property/'.$property->property_image);?>" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info-post ml-2">
                      <p class="username"><?php echo $property->property_title;?></p>
                      <p class="date text-muted">Aktif dari : <?php echo $property->start_date;?> <br>Expired : <?php echo $property->expired_date;?></p>
                    </div>
                  </div>
                  <div class="separator-solid"></div>

                  <h3 class="card-title">

                      Rp. <?php echo number_format($property->property_price,'0',',','.');?>

                  </h3>
                  <p class="card-text"></p>

                  <?php if ($property->expired_date <= date('Y-m-d') ) :?>
                  <span class="badge badge-danger badge-rounded badge-sm py-2">Expired</span>
                <?php else:?>
                  <a class="btn btn-secondary btn-rounded btn-sm" href="<?php echo base_url('myaccount/property/update/' .$property->id);?>">Ubah Iklan</a>
                  <span class="btn btn-success btn-rounded btn-sm">Active</span>
                  <a class="btn btn-info btn-rounded btn-sm" href="<?php echo base_url('property/detail/'.$property->property_slug);?>">Lihat Iklan</a>
                <?php endif;?>

                <?php if ($property->expired_date <= date('Y-m-d')):?>
                  <a class="btn btn-info btn-rounded btn-sm" href="<?php echo base_url('myaccount/property/perpanjang/'.$property->id);?>">Perpanjang Iklan</a>
                <?php endif;?>

                </div>
              </div>
            </div>
<?php endforeach;?>






</div>

<div class="pagination col-md-12 text-center">
    <?php if (isset($pagination)) {
        echo $pagination;
    } ?>
</div>
