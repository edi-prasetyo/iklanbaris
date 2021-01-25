<div class="container">
  <div class="col-md-5 mx-auto">
    <div class="card o-hidden my-5">
      <div class="card-header login-header">
        <h3 class="text-center mb-4 mt-4">Daftar <i class="ti-arrow-right"></i></h3>
        <p class="text-center mb-4">Buat Akun Gratis, daftar sekarang</p>
      </div>
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="p-5">

            <?php
            echo form_open('auth/register')
            ?>

            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ri-user-add-line"></i> </span>
                </div>
                <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
              </div>
              <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ri-user-search-line"></i> </span>
                </div>
                <input style="text-transform:lowercase" type="text" class="form-control" name="username" placeholder="username" value="<?php echo set_value('username'); ?>">
              </div>
              <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <!-- <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ri-phone-line"></i> </span>
                </div>
                <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
              </div>
              <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
            </div> -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ri-mail-send-line"></i> </span>
                </div>
                <input style="text-transform:lowercase" type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
              </div>
              <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ri-lock-password-line"></i> </span>
                  </div>
                  <input type="password" class="form-control" name="password1" placeholder="Password">
                </div>
                <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="col-sm-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ri-lock-password-line"></i> </span>
                  </div>
                  <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                </div>
              </div>
            </div>
            <div class="submit-btn-area">
              <button type="submit">Daftar <i class="ti-arrow-right"></i></button>
              <div class="login-other row mt-4">
              </div>
            </div>

            <?php echo form_close() ?>
            <hr>
            <div class="text-center">
              <a class="small" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?php echo base_url('auth') ?>">Sudah punya akun? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>