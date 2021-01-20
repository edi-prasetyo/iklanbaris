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

<div class="container">
    <?php foreach ($faq as $faq) : ?>
        <div class="accordion" id="accordionExample">
            <div class="card my-2">
                <a href="" type="button" data-toggle="collapse" data-target="#<?php echo $faq->collapse; ?>" aria-expanded="true" aria-controls="<?php echo $faq->collapse; ?>">
                    <div class="card-header" id="<?php echo $faq->id; ?>">
                        <h5 class="mb-0">

                            <?php echo $faq->faq_answer; ?>

                        </h5>
                    </div>
                </a>

                <div id="<?php echo $faq->collapse; ?>" class="collapse" aria-labelledby="<?php echo $faq->id; ?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <?php echo $faq->faq_question; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>