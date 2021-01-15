<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container">
    <div class="col-md-5 mx-auto" style="margin-top: 130px;">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-header login-header">
              <h3 class="text-center mb-4 mt-4">Sign In <i class="ti-arrow-right"></i></h3>
            <p class="text-center mb-4">Hello there, Sign in and start managing your Account</p>
          </div>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">

                      <?php
                      //Notifikasi
                      if ($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');

                      }


                      ?>
                    </div>
                    <?php

                    echo form_open('auth')
                    ?>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-mail-check-line"></i> </span>
                        </div>
                        <input style="text-transform:lowercase" type="email" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>">

                      </div>
                      <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">

                    </div>
                      <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="submit-btn-area">
                          <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                          <div class="login-other row mt-4">
                          </div>
                      </div>

                    <?php echo form_close() ?>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                    </div>
                    <!-- <div class="text-center">
                        <a class="small" href="<?php echo base_url('auth/register') ?> ">Create an Account!</a>
                    </div> -->
                </div>

            </div>
        </div>
    </div>

</div>
