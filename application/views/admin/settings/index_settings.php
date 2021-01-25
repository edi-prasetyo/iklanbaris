<div class="card shadow">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/settings/update/' . $settings->id); ?>" class="btn btn-info btn-sm text-white">Ubah Pengaturan</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-4">Moderasi Iklan</div>
                    <div class="col-md-8">:
                        <?php if ($settings->moderation == "Pending") : ?>
                            <div class="badge badge-success">Active</div>
                        <?php else : ?>
                            <div class="badge badge-danger">Nonaktif</div>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="col-md-4">Jangka Waktu Iklan Premium</div>
                    <div class="col-md-8">: <?php echo $settings->premium_range; ?> Hari</div>

                </div>
            </div>
            <div class="col-md-4">

            </div>

        </div>
    </div>
</div>