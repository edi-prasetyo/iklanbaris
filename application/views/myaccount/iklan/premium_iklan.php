<div class="container my-5">
    <div class="card">
        <div class="card-header">
            Iklan Premium
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-2">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/iklan/' . $iklan->iklan_image); ?>">
                </div>

                <div class="col-md-7">
                    ID IKLAN : <b><?php echo $iklan->id_iklan; ?></b><br>
                    Judul Iklan : <b><?php echo $iklan->iklan_title; ?></b><br>
                    Status Iklan :
                    <?php if ($iklan->iklan_status == "Active") : ?>
                        <span class="badge badge-success">
                            <?php echo $iklan->iklan_status; ?></span>
                    <?php elseif ($iklan->iklan_status == "Inactive") : ?>
                        <span class="badge badge-danger">
                            <?php echo $iklan->iklan_status; ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 border-left text-center">



                    <div class="border-scoop">
                        Paket Tersedia <br> <span class="display-4"> <?php echo $iklan->premium_count; ?></span>
                    </div>
                    <?php if ($iklan->iklan_status == "Inactive") : ?>
                        <button class="btn btn-success btn-block my-2 text-white" disabled><i class="ri-coupon-3-fill"></i> Gunakan</button>
                    <?php else : ?>
                        <?php echo form_open('myaccount/iklan/get_premium/' . $iklan->id); ?>
                        <input type="hidden" value="<?php echo $iklan->id; ?>" name="iklan_id">
                        <button type="submit" class="btn btn-success btn-block my-2 text-white"><i class="ri-coupon-3-fill"></i> Gunakan</button>
                        <?php echo form_close(); ?>
                    <?php endif; ?>
                </div>





            </div>
        </div>

    </div>
</div>