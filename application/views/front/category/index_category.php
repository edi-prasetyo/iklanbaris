<!-- ======= Breadcrumbs Section ======= -->
<div class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Blog</h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><?php echo $title ?></li>
            </ol>
        </div>

    </div>
</div><!-- End Breadcrumbs Section -->

<div class="container my-3">
    <div class="row">

        <?php foreach ($category as $category) { ?>
            <div class="col-md-3">
                <a href="<?php echo base_url('iklan/category/' . $category->category_slug); ?>">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>">
                                </div>
                                <div class="col-6">
                                    <?php echo $category->category_name; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php }; ?>

    </div>
</div>