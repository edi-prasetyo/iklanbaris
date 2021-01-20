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

<section class="inner-page blog">
  <div class="container">
    <div class="row">
      <div class="col-md-9">

        <div class="row">

          <?php foreach ($berita as $berita) : ?>

            <div class="col-md-6">
              <div class="card">
                <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" class="card-img-top" alt="<?php echo $berita->berita_title; ?>">
                <div class="card-body">
                  <h2 class="index-title"><a href="<?php echo base_url('blog/detail/' . $berita->berita_slug); ?> "> <?php echo substr($berita->berita_title, 0, 25); ?></a></h2>
                  <p><?php echo substr($berita->berita_desc, 0, 100); ?></p>

                </div>
                <div class="card-footer">
                  <i class="ri-price-tag-3-line"></i> <a href="<?php echo base_url('blog/category/' . $berita->category_slug); ?>"><?php echo $berita->category_name; ?></a>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
        <div class="pagination col-md-12 text-center">
          <?php if (isset($paginasi)) {
            echo $paginasi;
          } ?>
        </div>
      </div>


      <div class="col-md-3">
        <?php include "blog_sidebar.php"; ?>
      </div><!-- End sidebar -->
    </div>
  </div>

  </div>
</section>