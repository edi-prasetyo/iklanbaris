<div class="container">
  <div class="account-page">


    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
      echo '<div class="alert alert-success alert-dismissable fade show">';
      echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
      echo $this->session->flashdata('message');
      echo '</div>';
    }


    ?>


    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <i class="ri-community-line"></i> Mulai Jual Barang Anda
          </div>

          <div class="card-body">


            <?php
            echo form_open_multipart('myaccount/create');
            ?>

            <div class="form-group row">
              <label class="col-3">Provinsi <span class="text-danger">*</span>
              </label>
              <div class="col-9">
                <select name="province_id" id="province" class="form-control form-control-lg select2" data-live-search="true">
                  <option value="">No Selected</option>
                  <?php foreach ($province as $province) : ?>
                    <option value="<?php echo $province->id; ?>"><?php echo $province->province_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('province_id', '<p class="text-danger">', '</p>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Kategori Iklan <span class="text-danger">*</span>
              </label>
              <div class="col-9">
                <select name="category_id" id="province" class="form-control form-control-lg custom-select" data-live-search="true">
                  <option value="">No Selected</option>
                  <?php foreach ($category as $category) : ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('province_id', '<p class="text-danger">', '</p>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Judul Iklan</label>
              <div class="col-9">
                <input type="text" name="iklan_title" class="form-control form-control-lg" placeholder="Judul Iklan.." value="<?php echo set_value('iklan_title'); ?>">
                <?php echo form_error('iklan_title', '<p class="text-danger">', '</p>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Kondisi Barang</label>
              <div class="col-9">
                <div class="form-check col-6">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="iklan_kondisi" value="Baru">Baru
                  </label>
                </div>
                <div class="form-check col-6">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="iklan_kondisi" value="Bekas">Bekas
                  </label>
                </div>
              </div>

            </div>

            <div class="form-group row">
              <label class="col-3" for="exampleInputEmail1">Merek</label>
              <div class="col-9">
                <input type="text" name="iklan_merek" class="form-control form-control-lg" placeholder="Merek Barang.." value="<?php echo set_value('iklan_merek'); ?>">
                <?php echo form_error('iklan_merek', '<p class="text-danger">', '</p>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Model</label>
              <div class="col-9">
                <input type="text" name="iklan_type" class="form-control form-control-lg" placeholder="Model .." value="<?php echo set_value('iklan_type'); ?>">
                <?php echo form_error('iklan_type', '<p class="text-danger">', '</p>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Harga</label>
              <div class="col-9 row">
                <div class="col-9">
                  <input type="text" name="iklan_price" class="form-control form-control-lg" placeholder="Harga.." value="<?php echo set_value('iklan_price'); ?>">
                  <?php echo form_error('iklan_price', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-3">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="iklan_negotiable" value="Nego">Nego
                  </label><br>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="iklan_negotiable" value="Fix">Fix
                  </label>
                </div>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-3">Gambar</label>
              <div class="col-6">
                <div class="wrap-custom-file col-md-12">
                  <input type="file" name="iklan_image" id="image1" accept=".gif, .jpg, .png">
                  <label for="image1">
                    <span>Pilih Gambar</span>
                    <i class="fa fa-plus-circle"></i>
                  </label>
                </div>
              </div>
            </div>


            <!-- <div class="form-group row">
                <label class="col-3">Gambar</label>
                <div class="col-6">
                  <input type="file" id="myfile" name="iklan_image">
                </div>
              </div> -->



            <div class="form-group row">
              <label class="col-3">Deskripsi Iklan</label>
              <div class="col-9">
                <textarea id="summernote" name="iklan_desc"><?php echo set_value('iklan_desc'); ?></textarea>
                <?php echo form_error('iklan_desc', '<p class="text-danger">', '</p>'); ?>

              </div>
            </div>

            <div class="form-group row">
              <label class="col-3">Kata kunci</label>
              <div class="col-9">
                <input type="text" name="iklan_keywords" class="form-control form-control-lg" placeholder="Mobil Di Jual, Jual kamera etc ..">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-3"></label>
              <div class="col-9">
                <input type="submit" class="btn btn-info btn-block" value="Pasang Iklan">
              </div>
            </div>




            <?php echo form_close() ?>


          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="ri-image-edit-line"></i> Peraturan
          </div>
          <div class="card-body">

            Peraturan Iklan


          </div>
        </div>
      </div>
    </div>
  </div>
</div>