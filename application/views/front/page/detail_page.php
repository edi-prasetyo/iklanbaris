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

<div class="container my-2">
    <div class="card">
        <div class="card-body">
            <h2><?php echo $title; ?></h2>
            <?php echo $page->page_desc; ?>

        </div>
    </div>
</div>