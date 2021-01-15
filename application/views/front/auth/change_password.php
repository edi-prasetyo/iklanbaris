<div class="container">
    <div class="col-md-6 mx-auto" style="margin-top: 130px;">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900">Change your password?</h1>
                        <h5 class="mb-4"><?php echo $this->session->userdata('reset_email'); ?></h5>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                    $attributes = array('class' => 'user');
                    echo form_open('auth/changepassword', $attributes)
                    ?>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password1" id="password1" placeholder="Enter new Password...">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>

                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Repeat new Password...">
                        <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>


                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Change Password
                    </button>

                    <?php echo form_close() ?>


                </div>

            </div>
        </div>
    </div>

</div>
