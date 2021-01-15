<?php if ($this->session->userdata('id')) : ?>


  <div class="container my-5">
    <div class="row">


      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <i class="ri-lock-2-line"></i> Ubah Password
          </div>

          <?php
          echo form_open_multipart('myaccount/ubah_password');
          ?>

          <div class="card-body">


            <div class="row">

              <div class="col-md-3">Password Baru</div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="password1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="col-md-3">Ulangi Password</div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
              </div>

              <div class="col-3">

              </div>
              <div class="col-7">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Update Password
                </button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>



    </div>
  </div>


<?php else : ?>

  <?php redirect('auth'); ?>

<?php endif; ?>