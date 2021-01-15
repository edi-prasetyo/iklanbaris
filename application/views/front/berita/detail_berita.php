

<!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Blog</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page blog">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

          <article class="entry entry-single card">

            <div class="entry-img">
              <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" alt="" class="img-fluid" width="100%;">
            </div>

            <h2 class="entry-title">
              <a href="blog-single.html"><?php echo $berita->berita_title; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="ri-user-3-line"></i> <?php echo $berita->user_name; ?></li>
                <li class="d-flex align-items-center"><i class="ri-calendar-line"></i> <?php echo date('d F Y', $berita->date_created);?></li>
                <li class="d-flex align-items-center"><i class="ri-eye-line"></i> <?php echo $berita->berita_views; ?> View</li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
<?php echo $berita->berita_desc; ?>
              </p>

              <!-- Your share button code -->


            </div>

            <div class="entry-footer clearfix">
              <div class="float-left">
                <i class="ri-price-tag-3-line"></i>
                <ul class="cats">
                  <li><a href="<?php echo base_url('blog/category/'.$berita->category_slug);?>"><?php echo $berita->category_name;?></a></li>
                </ul>


              </div>

              <div class="float-right share">
                <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_line"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
              </div>

            </div>

          </article><!-- End blog entry -->

          <div class="blog-author clearfix">
            <img src="<?php echo base_url('assets/img/avatars/' .$berita->user_image); ?>" class="rounded-circle float-left" alt="">
            <h4><?php echo $berita->user_name; ?></h4>
            <div class="social-links">
              <a href="https://twitters.com/#"><i class="ri-twitter-line"></i></a>
              <a href="https://facebook.com/#"><i class="ri-facebook-fill"></i></a>
              <a href="https://instagram.com/#"><i class="ri-instagram-line"></i></a>
            </div>
            <p>
              <?php echo $berita->user_bio;?>
            </p>
          </div><!-- End blog author bio -->



        </div>
        <div class="col-md-3">
        <?php include "blog_sidebar.php";?>
        </div>
      </div>

    </div>
  </section>
