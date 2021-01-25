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

<!-- <section class="inner-page blog">
  <div class="container">
    <div class="row">
      <div class="col-md-9">

        <article class="entry entry-single card">

          <div class="entry-img">
            <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" alt="" class="img-fluid">
          </div>

          <h2 class="entry-title">
            <a href="blog-single.html"><?php echo $berita->berita_title; ?></a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="ri-user-3-line"></i> <?php echo $berita->user_name; ?></li>
              <li class="d-flex align-items-center"><i class="ri-calendar-line"></i> <?php echo date('d F Y', $berita->date_created); ?></li>
              <li class="d-flex align-items-center"><i class="ri-eye-line"></i> <?php echo $berita->berita_views; ?> View</li>
            </ul>
          </div>

          <div class="entry-content">
            <p>
              <?php echo $berita->berita_desc; ?>
            </p>




          </div>

          <div class="entry-footer clearfix">
            <div class="float-left">
              <i class="ri-price-tag-3-line"></i>
              <ul class="cats">
                <li><a href="<?php echo base_url('blog/category/' . $berita->category_slug); ?>"><?php echo $berita->category_name; ?></a></li>
              </ul>


            </div>

            <div class="float-right share">

              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_whatsapp"></a>
                <a class="a2a_button_pinterest"></a>
                <a class="a2a_button_line"></a>
              </div>
              <script async src="https://static.addtoany.com/menu/page.js"></script>

            </div>

          </div>

        </article>

        <div class="blog-author clearfix">
          <img src="<?php echo base_url('assets/img/avatars/' . $berita->user_image); ?>" class="rounded-circle float-left" alt="">
          <h4><?php echo $berita->user_name; ?></h4>
          <div class="social-links">
            <a href="https://twitters.com/#"><i class="ri-twitter-line"></i></a>
            <a href="https://facebook.com/#"><i class="ri-facebook-fill"></i></a>
            <a href="https://instagram.com/#"><i class="ri-instagram-line"></i></a>
          </div>
          <p>
            <?php echo $berita->user_bio; ?>
          </p>
        </div>
      </div>



      <div class="col-md-3">
        <?php //include "blog_sidebar.php"; 
        ?>
      </div>
    </div>

  </div>
</section> -->

































<!-- Default Blog -->


<div class="container">
  <div class="row">
    <div class="col-md-9">
      <article class="card">

        <div class="entry-img">
          <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" alt="" class="img-fluid">
        </div>

        <div class="card-body">
          <h2><?php echo $berita->berita_title; ?></h2>


          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"></li>
              <li class="d-flex align-items-center"></li>
              <li class="d-flex align-items-center"></li>
            </ul>
          </div>


          <ul class="list-inline">
            <li class="list-inline-item"><i class="ri-user-3-line"></i> <?php echo $berita->user_name; ?></li>
            <li class="list-inline-item"><i class="ri-calendar-line"></i> <?php echo date('d F Y', $berita->date_created); ?></li>
            <li class="list-inline-item"><i class="ri-eye-line"></i> <?php echo $berita->berita_views; ?> View</li>
          </ul>

          <div class="my-3 entry-post">
            <?php echo $berita->berita_desc; ?>
          </div>
        </div>

        <div class="card-footer">
          <div class="float-left">
            <i class="ri-price-tag-3-line"></i>

            <a href="<?php echo base_url('blog/category/' . $berita->category_slug); ?>"><?php echo $berita->category_name; ?></a>



          </div>

          <div class="float-right share">

            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_whatsapp"></a>
              <a class="a2a_button_pinterest"></a>
              <a class="a2a_button_line"></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>

          </div>

        </div>

      </article>

      <div class="card my-3">
        <div class="card-body">
          <div class="row">
            <div class="col-2">
              <img src="<?php echo base_url('assets/img/avatars/' . $berita->user_image); ?>" class="rounded-circle float-left img-fluid" alt="">
            </div>
            <div class="col-10">
              <h4><?php echo $berita->user_name; ?></h4>

              <ul class="list-inline">
                <li class="list-inline-item"><a href="https://twitters.com/#"><i class="ri-twitter-line"></i></a></li>
                <li class="list-inline-item"><a href="https://facebook.com/#"><i class="ri-facebook-fill"></i></a></li>
                <li class="list-inline-item"><a href="https://instagram.com/#"><i class="ri-instagram-line"></i></a></li>
              </ul>

              <p>
                <?php echo $berita->user_bio; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-3">
      <?php include "blog_sidebar.php"; ?>
    </div>
  </div>

</div>