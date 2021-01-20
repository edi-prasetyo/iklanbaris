<div class="container">
    <section class="breadcrumbs mt-3">
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

<div class="container">
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