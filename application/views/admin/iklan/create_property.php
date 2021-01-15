

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?> <?php echo $category->category_name;?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/iklan/property/'.$category->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Judul Iklan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="iklan_title" placeholder="Judul Berita" value="<?php echo set_value('iklan_title'); ?>">
                <?php echo form_error('iklan_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <!-- <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar 1 <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="file1">
                </div>
            </div>
        </div> -->


        <?php for ($i=1; $i <=3 ; $i++) :?>
			<input type="file" name="file<?php echo $i;?>"><br/>
		<?php endfor;?>




        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Berita
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
