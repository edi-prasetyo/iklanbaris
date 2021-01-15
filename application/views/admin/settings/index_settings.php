<div class="card shadow">
    <div class="card-header">
        <?php echo $title; ?>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <a href="<?php echo base_url('admin/settings/update/' . $settings->id); ?>" class="btn btn-rounded btn-info btn-lg">Ubah Profil</a>
                <hr>
                <div class="row">
                    <div class="col-md-3">Judul Web</div>
                    <div class="col-md-9">: <?php echo $settings->moderation; ?></div>
                    <hr>
                    <div class="col-md-3">Tagline</div>
                    <div class="col-md-9">: <?php echo $settings->premium_range; ?></div>

                </div>
            </div>
            <div class="col-md-4">

            </div>

        </div>
    </div>
</div>