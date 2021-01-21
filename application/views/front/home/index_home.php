<section class="boot-elemant-bg py-md-5 py-4" style="height: 230px; background-image: linear-gradient(rgba(0,0,0,.0), rgba(0,0,0,.0)), url('assets/img/galery/bg.jpg');">
  <div class="container position-relative py-md-5 py-0">
    <div class="row">
      <div class="container" style="position: absolute;">
        <div class="search_home">
          <?php echo form_open('iklan/search'); ?>
          <div class="inner-form shadow">
            <div class="input-field first-wrap">
              <div class="svg-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </div>

              <input id="search" type="text" name="search" value="<?= $search ?>" placeholder="Apa yang anda Cari?" />
            </div>
            <div class="input-field second-wrap">
              <button class="btn-search" type='submit' name='submit' value='Submit'>SEARCH</button>
            </div>
          </div>
          <?php form_close(); ?>
          <span class="info">Handphone, Laptop, Mobil, Motor dll</span>

        </div>
      </div>
    </div>
  </div>
  <div class="elemant-bg-overlay black"></div>
</section>

<!-- End Header -->

<section>
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="section-title text-center mb-20">
          <p>Cari Barang barang sesuai kebutuhanmu</p>
          <h2>Kategori</h2>
        </div>
      </div>

      <?php foreach ($category as $category) : ?>

        <div class="col">
          <a href=" <?php echo base_url('iklan/category/' . $category->category_slug); ?>">
            <div class="card">
              <div class="card-body text-center">
                <img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>">
                <?php echo $category->category_name; ?>
              </div>

          </a>
        </div>
    </div>
  <?php endforeach; ?>

  </div>

</section>


<section class="bg-white">
  <div class="container">

    <div class="col-xl-12">
      <div class="section-title text-center mb-60">
        <p>Iklan Paling Banyak di lihat</p>
        <h2>Iklan Terbaru</h2>
      </div>
    </div>

    <div class="row">

      <?php foreach ($iklan as $iklan) : ?>
        <div class="col-md-6">
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
        </div>
      <?php endforeach; ?>



    </div>


  </div>
</section>