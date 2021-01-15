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
<div class="row">

  <?php foreach ($property as $property) :?>


    <div class="col-md-4">
    		    <div class="card profile-card-2">
                    <div class="card-img-block">
                        <img src="<?php echo base_url('assets/img/property/'.$property->property_image);?>" alt="Card image cap" />
                    </div>
                    <div class="card-body pt-3">
                      <div class="profile-canvas">
                        <img src="<?php echo base_url('assets/img/avatars/'.$property->user_image);?>" alt="profile-image" class="profile"/>
                      </div>
                        <a href="<?php echo base_url('property/detail/'.$property->property_slug);?>"><h5 class="card-title"><?php echo $property->property_title;?></h5></a>
                        <p class="card-text"><?php echo $property->property_address;?></p>
                        <h3>Rp. <?php echo number_format($property->property_price,'0',',','.');?></h3>
                    </div>
                    <div class="card-footer py-4">
                      <i class="fas fa-bed"></i> <?php echo $property->property_bed;?> Km Tidur  <i class="fas fa-bath"></i> <?php echo $property->property_bath;?> Km Mandi
                    </div>
                </div>
    		</div>

          <?php endforeach;?>



</div>

<div class="pagination col-md-12">
    <?php if (isset($pagination)) {
        echo $pagination;
    } ?>
</div>

</div>
