<div class="container my-5">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <i class="ri-user-follow-line"></i> Update Informasi Akun
                </div>

                <?php
                echo form_open_multipart('myaccount/profile/update');
                ?>

                <div class="card-body">

                    <div class="row">

                        <div class="col-3 mb-3">
                            <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" width="70%" class="img-fluid">
                        </div>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="file" name="user_image">

                            </div>

                        </div>

                        <div class="col-3">
                            Nama
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_name" placeholder="Nama" value="<?php echo $user->user_name; ?>">
                                <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                        </div>
                        <div class="col-3">
                            Username
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Nama" value="<?php echo $user->username; ?>" readonly>
                                <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                        </div>
                        <div class="col-3">
                            Email
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>" readonly>
                            </div>

                        </div>
                        <div class="col-3">
                            Biografi
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <textarea class="form-control" name="user_bio" placeholder="Biografi"><?php echo $user->user_bio; ?></textarea>
                                <?php echo form_error('user_bio', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>



                        <div class="col-12">
                            <h3>Contact Info</h3>
                            <hr>
                        </div>

                        <div class="col-3">
                            Handphone
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_phone" placeholder="No. Handphone" value="<?php echo $user->user_phone; ?>">

                            </div>

                        </div>

                        <div class="col-5">
                            <label class="form-check-label my-auto">
                                <input type="radio" class="form-check-input" name="user_whatsapp" value="1" <?php if ($user->user_whatsapp == "1") {
                                                                                                                echo "checked";
                                                                                                            } ?>>Aktifkan Whatsapp
                            </label>
                            <label class="form-check-label my-auto">
                                <input type="radio" class="form-check-input" name="user_whatsapp" value="0" <?php if ($user->user_whatsapp == "0") {
                                                                                                                echo "checked";
                                                                                                            } ?>>Nonaktifkan Whatsapp
                            </label>
                        </div>

                        <div class="col-3">
                            Alamat
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <textarea class="form-control" name="user_address" placeholder="Alamat"><?php echo $user->user_address; ?></textarea>

                            </div>
                        </div>



                        <div class="col-12">
                            <h3>Sosial Media</h3>
                            <hr>
                        </div>


                        <div class="col-3">
                            Facebook
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_facebook" placeholder="Url Facebook" value="<?php echo $user->user_facebook; ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            Instagram
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_instagram" placeholder="Url Instagram" value="<?php echo $user->user_instagram; ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            Youtube
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_youtube" placeholder="Url Youtube" value="<?php echo $user->user_youtube; ?>">
                            </div>
                        </div>

                        <div class="col-3">
                            Twitter
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_twitter" placeholder="Url Twitter" value="<?php echo $user->user_twitter; ?>">
                            </div>
                        </div>



                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Update Profile
                            </button>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>



    </div>

</div>