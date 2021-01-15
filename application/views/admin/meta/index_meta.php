<div class="card shadow">
    <div class="card-header">
        <h3><?php echo $title; ?></h3>
        <hr>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <a href="<?php echo base_url('admin/meta/update/' . $meta->id); ?>" class="btn btn-rounded btn-info btn-lg">Ubah Profil</a>
                <hr>
                <div class="row">
                    <div class="col-md-3">Judul Web</div>
                    <div class="col-md-9">: <?php echo $meta->title; ?></div>
                    <hr>
                    <div class="col-md-3">Tagline</div>
                    <div class="col-md-9">: <?php echo $meta->tagline; ?></div>
                    <hr>
                    <div class="col-md-3">Deskripsi Web</div>
                    <div class="col-md-9">: <?php echo $meta->description; ?></div>
                    <hr>
                    <div class="col-md-3">Keywords</div>
                    <div class="col-md-9">: <?php echo $meta->keywords; ?></div>
                    <hr>
                    <div class="col-md-3">Email</div>
                    <div class="col-md-9">: <?php echo $meta->email; ?></div>
                    <hr>
                    <div class="col-md-3">Telepon</div>
                    <div class="col-md-9">: <?php echo $meta->telepon; ?></div>
                    <hr>
                    <div class="col-md-3">Alamat</div>
                    <div class="col-md-9">: <?php echo $meta->alamat; ?></div>
                    <hr>
                    <div class="col-md-3">Link</div>
                    <div class="col-md-9">: <?php echo $meta->link; ?></div>
                    <hr>
                    <div class="col-md-3">Facebook</div>
                    <div class="col-md-9">: <?php echo $meta->facebook; ?></div>
                    <hr>
                    <div class="col-md-3">Instagram</div>
                    <div class="col-md-9">: <?php echo $meta->instagram; ?></div>
                    <hr>
                    <div class="col-md-3">Youtube</div>
                    <div class="col-md-9">: <?php echo $meta->youtube; ?></div>
                    <hr>
                    <div class="col-md-3">Twitter</div>
                    <div class="col-md-9">: <?php echo $meta->twitter; ?></div>
                    <hr>
                    <div class="col-md-3">Google Meta</div>
                    <div class="col-md-9">: <?php echo $meta->google_meta; ?></div>
                    <hr>
                    <div class="col-md-3">Bing Meta</div>
                    <div class="col-md-9">: <?php echo $meta->bing_meta; ?></div>
                    <hr>
                    <div class="col-md-3">Google Analytics</div>
                    <div class="col-md-9">: <?php echo $meta->google_analytics; ?></div>
                    <hr>
                    <div class="col-md-3">Google Tag</div>
                    <div class="col-md-9">: <?php echo $meta->google_tag; ?></div>
                    <hr>
                    <div class="col-md-3">Map</div>
                    <div class="col-md-9">: <?php echo $meta->map; ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <a href="<?php echo base_url('admin/meta/logo'); ?>" class="btn btn-rounded btn-info btn-lg">Ubah Logo</a>
                <hr>
                <img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>">
                <hr>
                <a href="<?php echo base_url('admin/meta/favicon'); ?>" class="btn btn-rounded btn-info btn-lg">Ubah Favicon</a>
                <hr>
                <img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>">
            </div>

        </div>
    </div>
</div>