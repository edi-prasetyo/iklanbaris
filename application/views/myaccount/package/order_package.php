<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <?php echo $title; ?> <b><?php echo $package->package_name; ?></b><br>
            </div>
            <div class="card-body">
                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }


                ?>
                Total Pembayaran<br>
                <?php $sub = substr($package->package_price, -3);
                $total =  random_string('numeric', 3);
                $hasil =  $package->package_price + $total;
                $no = substr($hasil, -3);
                ?>

                <span class="display-4"> IDR. <?php echo number_format($hasil, 0, ",", "."); ?></span>
                <br><span class="mb-3">Pilih Metode Pembayaran</span>
                <?php echo form_open('myaccount/package/order/' . $package->id); ?>
                <div class="row my-3">
                    <?php foreach ($bank as $bank) : ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img class="img-fluid" src=" <?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="bank_id" value="<?php echo $bank->id; ?>"><?php echo $bank->bank_name; ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                    <?php echo form_error('bank_id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <?php $id = $this->session->userdata('id');
                $user = $this->user_model->user_detail($id);
                ?>

                <input type="hidden" name="transaction_user" value="<?php echo $user->user_name; ?>">
                <input type="hidden" name="transaction_product" value="<?php echo $package->package_name; ?>">
                <input type="hidden" name="transaction_count" value="<?php echo $package->package_post; ?>">
                <input type="hidden" name="transaction_price" value="<?php echo $hasil; ?>">
                <button type="submit" class="btn btn-success btn-block">Order Sekarang</button>
                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>