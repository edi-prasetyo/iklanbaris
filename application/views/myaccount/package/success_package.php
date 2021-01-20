<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="display-4 text-center text-success"> <i class="ri-chat-check-fill"></i> </div>
                <div class="text-center"> Transaksi Berhasil</div>
            </div>
            <div class="card-body">
                <h3>Detail Transaksi</h3>
                Jumlah yang harus di Transfer
                <div class="display-4 font-weight-bold"> IDR. <?php echo number_format($last_transaction->transaction_price, 0, ",",  "."); ?></div>
                Rekening Pembayaran : <br>
                <div class="col-md-3">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $last_transaction->bank_logo); ?>">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">Nama Bank <span class="font-weight-bold"><?php echo $last_transaction->bank_name; ?></span> </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Nomor rekening <span class="font-weight-bold"><?php echo $last_transaction->bank_number; ?></span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Atas Nama <span class="font-weight-bold"><?php echo $last_transaction->bank_account; ?></span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Cabang <span class="font-weight-bold"><?php echo $last_transaction->bank_branch; ?></span></li>
                </ul>
                <a href="<?php echo base_url('myaccount/transaction/confirm/' . $last_transaction->id); ?>" class="btn btn-success btn-block text-white">Konfirmasi Pembayaran</a>

            </div>
        </div>
    </div>
</div>