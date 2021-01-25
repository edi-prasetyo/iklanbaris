<div class="card mb-3">
  <div class="card-header">Categories</div>
  <div class="sidebar-item categories">
    <ul>
      <?php foreach ($category_sidebar as $category_sidebar) { ?>
        <li><a href="<?php echo base_url('blog/category/' . $category_sidebar->category_slug); ?>"><?php echo $category_sidebar->category_name; ?></a></li>
      <?php }; ?>
    </ul>

  </div><!-- End sidebar categories-->
</div>

<div class="card">
  <div class="card-header">Recent Posts</div>

  <?php foreach ($recent_post as $recent_post) { ?>

    <img class="img-fluid" src="<?php echo base_url('assets/img/artikel/' . $recent_post->berita_gambar); ?>" alt="">
    <div class="card-body">
      <h4><a href="<?php echo base_url('blog/detail/' . $recent_post->berita_slug); ?>"><?php echo substr($recent_post->berita_title, 0, 30); ?></a></h4>
      <i class="ri-calendar-line"></i> <?php echo date('d F Y', $berita->date_created); ?>
    </div>

  <?php }; ?>


</div>