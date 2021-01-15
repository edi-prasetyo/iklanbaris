<div class="row">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php echo $title; ?>
            </div>
            <div class="card-body">



                <?php
                //Form Open
                echo form_open(base_url('admin/layanan/create'));
                ?>

                <div class="form-group">
                    <label>Judul Layanan</label>

                    <input type="text" class="form-control" name="layanan_title" placeholder="Judul Halaman">
                    <?php echo form_error('layanan_title', '<small class="text-danger">', '</small>'); ?>

                </div>

                <div class="form-group">
                    <label>Ikon Layanan ( Silahkan Masukan Kode Icon Pada data di samping) </label>

                    <input type="text" class="form-control" name="layanan_icon" placeholder="">
                    <?php echo form_error('layanan_icon', '<small class="text-danger">', '</small>'); ?>

                </div>


                <div class="form-group">
                    <label>Deskripsi Layanan <span class="text-danger">*</span>
                    </label>


                    <textarea class="form-control" id="summernote" name="layanan_desc" placeholder="Deskripsi Berita"></textarea>
                    <?php echo form_error('layanan_desc', '<small class="text-danger">', '</small>'); ?>

                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-9">
                        <input type="submit" class="btn btn-primary" name="submit" value="Publish Halaman">
                    </div>
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3>Contoh Kode Icon</h3>
                Masukan Kode Icon Seperti ini / Klik Link untuk melihat galery Icon <br>
                <div class="badge badge-success"> &lt;i class="ri-home-2-line"&gt;&lt;/i&gt; </div><br> <i class="ri-external-link-line"></i> <a href="https://remixicon.com/" target="blank">Remixicon</a> <br>
                <div class="badge badge-primary"> &lt;i class="fas fa-bed"&gt;&lt;/i&gt; </div><br> <i class="ri-external-link-line"></i> <a href="https://fontawesome.com/icons?d=gallery&m=free" target="blank">Font Awesome</a> <br>
                <div class="badge badge-info"> &lt;i class="fe-briefcase"&gt;&lt;/i&gt;</div><br> <i class="ri-external-link-line"></i> <a href="https://feathericons.com/" target="blank">Feather Icon</a> <br>
            </div>
        </div>
    </div>
</div>