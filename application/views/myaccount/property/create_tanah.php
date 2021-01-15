<div class="text-center">
    <?php
    echo $this->session->flashdata('message');
    if (isset($error_upload)) {
        echo '<div class="alert alert-warning">' . $error_upload . '</div>';
    }
    ?>
</div>

<div class="row justify-content-md-center">



    <?php
    echo form_open_multipart('myaccount/property/tanah');
    ?>



    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header order-success">


                </div>


                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <h3> <i class="ri-community-line"></i> Basic Information</h3>
                            <hr>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Property <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="property_title" placeholder="Judul Property" value="<?php echo set_value('property_title'); ?>">
                                <?php echo form_error('property_title', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Market <span class="text-danger">*</span><?php echo form_error('property_market', '<small class="text-danger">', '</small>'); ?>
                                </label>
                                <select name="property_market" class="form-control custom-select">
                                    <option value="">--Pilih Status--</option>
                                    <option value="Dijual" <?php echo set_select('property_market',  'Dijual'); ?>>Dijual</option>
                                    <option value="Disewa" <?php echo set_select('property_market',  'Disewa'); ?>>Disewa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Luas Tanah <span class="text-danger">* ( Dalam M<sup>2</sup> )</span>
                                </label>
                                <input type="text" class="form-control" name="property_surfacearea" placeholder="Luas Tanah" value="<?php echo set_value('property_surfacearea'); ?>">
                                <?php echo form_error('property_surfacearea', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sertifikat <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="property_certificate" placeholder="Tipe Sertifikat" value="<?php echo set_value('property_certificate'); ?>">
                                <?php echo form_error('property_certificate', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nego <span class="text-danger">*</span> <?php echo form_error('property_negotiable', '<small class="text-danger">', '</small>'); ?>
                                </label>
                                <select name="property_negotiable" class="form-control custom-select">
                                    <option value="">--Pilih Status Nego--</option>
                                    <option value="Nego" <?php echo set_select('property_negotiable',  'Nego'); ?>>Nego</option>
                                    <option value="Fix" <?php echo set_select('property_negotiable',  'Fix'); ?>>Fix</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga Property<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="formattedNumberField" name="property_price" placeholder="Harga Property" value="<?php echo set_value('property_price'); ?>">
                                <?php echo form_error('property_price', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h3> <i class="ri-map-pin-line"></i> Lokasi</h3>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Provinsi <span class="text-danger">*</span><?php echo form_error('province_id', '<small class="text-danger">', '</small>'); ?>
                                </label>
                                <select name="province_id" id="province1111" class="form-control custom-select">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($province as $province) : ?>
                                        <option value="<?php echo $province->id; ?>" <?php echo set_select('province_id',  $province->id); ?>><?php echo $province->province_name; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kota <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="property_city" placeholder="Kota" value="<?php echo set_value('property_city'); ?>">
                                <?php echo form_error('property_city', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="property_address" placeholder="Alamat" value="<?php echo set_value('property_address'); ?>">
                                <?php echo form_error('property_address', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <h3> <i class="ri-map-pin-line"></i> Info lainnya</h3>
                            <hr>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="property_desc"><?php echo set_value('property_desc'); ?></textarea>
                                <?php echo form_error('property_desc', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>


                        <div class="form-group wrap-custom-file">
                            <input type="file" name="property_image" id="image0">
                            <label for="image0">
                                <span>Pilih gambar</span>
                                <i class="ti-plus"></i>
                            </label>
                        </div>
                        <?php for ($i = 1; $i <= 3; $i++) : ?>

                            <div class="form-group wrap-custom-file">
                                <input type="file" name="images<?php echo $i; ?>" id="image<?php echo $i; ?>">
                                <label for="image<?php echo $i; ?>">
                                    <span>Pilih gambar</span>
                                    <i class="ti-plus"></i>
                                </label>
                            </div>


                        <?php endfor; ?>




                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kata Kunci<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="property_keywords" placeholder="Kata Kunci" value="<?php echo set_value('property_keywords'); ?>">
                                <?php echo form_error('property_keywords', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>


                    </div>

                </div>
            </div>



        </div>

        <div class="col-md-8">

            <button class="btn btn-primary btn-lg btn-block" type="submit"> Pasang Iklan </button>

        </div>



    </div>




    <?php echo form_close(); ?>
</div>