<div class="sidebar card">
            <!-- <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>

            </div> -->

            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                  <?php foreach($category_sidebar as $category_sidebar){?>
                <li><a href="<?php echo base_url('blog/category/'.$category_sidebar->category_slug);?>"><?php echo $category_sidebar->category_name;?></a></li>
                  <?php };?>
              </ul>

            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
                <?php foreach ($recent_post as $recent_post) {?>
                    <div class="post-item clearfix">
                <img src="<?php echo base_url('assets/img/artikel/' .$recent_post->berita_gambar);?>" alt="">
                <h4><a href="<?php echo base_url('blog/detail/' .$recent_post->berita_slug);?>"><?php echo substr($recent_post->berita_title, 0 ,30);?></a></h4>
                <i class="ri-calendar-line"></i> <?php echo date('d F Y', $berita->date_created);?>
              </div>
                <?php };?>


            </div><!-- End sidebar recent posts-->



          </div><!-- End sidebar -->
