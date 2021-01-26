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

<div class="container my-2">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($category as $category) { ?>

                            <div class="col-4">
                                <li>
                                    <a href="<?php echo base_url('iklan/category/' . $category->category_slug); ?>">

                                        <?php echo $category->category_name; ?></a>
                                </li>
                            </div>

                        <?php }; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>