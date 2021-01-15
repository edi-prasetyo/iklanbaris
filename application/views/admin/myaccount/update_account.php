<div class="row">


    <div class="col-md-9">
        <div class="card">

            <?php
            echo form_open_multipart('admin/myaccount/update');
            ?>

            <div class="card-body">
                <h2>Ubah Profile, <?php echo $user->user_name; ?></h2>

                <div class="row">

                    <div class="col-md-2">
                        <img id="blah" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" class="img img-thumbnail img-fluid">
                    </div>
                    <div class="col-md-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="user_image">
                            <label class="custom-file-label" for="customFile"><i class="ti-camera"></i> Ubah Foto</label>
                        </div>




                    </div>

                    <div class="col-md-2">
                        Nama
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_name" placeholder="Nama" value="<?php echo $user->user_name; ?>">
                            <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                    </div>
                    <div class="col-md-2">
                        Email
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>" readonly>
                        </div>

                    </div>
                    <div class="col-md-2">
                        Phone
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_phone" placeholder="No. Handphone" value="<?php echo $user->user_phone; ?>">
                            <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                    </div>
                    <div class="col-md-2">
                        Bio
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea class="form-control" name="user_bio" placeholder="Biografi"><?php echo $user->user_bio; ?></textarea>

                        </div>
                    </div>
                    <div class="col-md-2">
                        Alamat
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea class="form-control" name="user_address" placeholder="Alamat"><?php echo $user->user_address; ?></textarea>
                            <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        Facebook Url
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_facebook" placeholder="Facebook Url" value="<?php echo $user->user_facebook; ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        Twitter Url
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_twitter" placeholder="Twitter Url" value="<?php echo $user->user_twitter; ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        Instagram Url
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_instagram" placeholder="Instagram Url" value="<?php echo $user->user_instagram; ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        Youtube Url
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_youtube" placeholder="Youtube Url" value="<?php echo $user->user_youtube; ?>">
                        </div>
                    </div>

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Update Profile
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
