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
  <div class="row">
    <?php foreach ($page as $page) : ?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><a href="<?php echo base_url('page/detail/' . $page->page_slug); ?>"> <?php echo substr($page->page_title, 0, 25); ?>..</a></h5>
            <p class="card-text"><?php echo substr($page->page_desc, 0, 100); ?></p>
            <a href="<?php echo base_url('page/detail/' . $page->page_slug); ?>" class="card-link">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>