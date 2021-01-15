<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2><?php echo $title ?></h2>
            <ol>
                <li><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                <li><?php echo $title ?></li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs Section -->

<div class="margin-top container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2><?php echo $title; ?></h2>
                <?php echo $page->page_desc; ?>

            </div>
        </div>
    </div>
</div>