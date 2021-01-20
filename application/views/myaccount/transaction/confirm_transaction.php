<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="text-center"> <?php echo $title; ?></div>
            </div>
            <div class="card-body">

                <?php
                echo $this->session->flashdata('message');
                if (isset($error_upload)) {
                    echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                }
                ?>
                <h3>Detail Transaksi</h3>
                Jumlah yang harus di Transfer
                <div class="display-4 font-weight-bold"> IDR. <?php echo number_format($transaction->transaction_price, 0, ",",  "."); ?></div>
                Upload Bukti Struk Pembayaran : <br>

                <?php echo form_open_multipart('myaccount/transaction/confirm/' . $transaction->id); ?>
                <div class="form-group row mt-3">
                    <div class="col-12">
                        <div class="wrap-custom-file col-md-12">
                            <input type="file" name="transaction_image" id="image1" accept=".gif, .jpg, .png, jpeg">
                            <label for="image1">
                                <span>Foto Struk Transfer</span>
                                <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="Process" name="transaction_status">
                <button type="submit" class="btn btn-success btn-block text-white">Konfirmasi Pembayaran</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>