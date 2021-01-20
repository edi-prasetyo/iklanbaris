<div class="container my-3">
  <div class="row">
    <div class="col-12">
      <?php
      //Notifikasi
      if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success alert-dismissable fade show">';
        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
        echo $this->session->flashdata('message');
        echo '</div>';
      }
      echo validation_errors('<div class="alert alert-warning">', '</div>');

      ?>
      <div class="card">
        <div class="card-header">
          <?php echo $title; ?>
        </div>
        <div class="card-body">

          <div class="row">

            <div class="col-md-6">
              Customer
              <address>
                <strong><?php echo $transaction->user_name; ?></strong><br>
                <?php echo $transaction->user_address; ?><br>

                Phone: <?php echo $transaction->user_phone; ?><br>

              </address>
            </div>
            <div class="col-md-6 text-right">

              <br>
              <b>Order ID :</b> #<?php echo $transaction->transaction_code; ?><br>
              <b>Tanggal Order : </b> <?php echo date('d F Y', $transaction->date_created); ?>
            </div>


            <div class="col-md-12 table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $transaction->transaction_product; ?></td>
                    <td>IDR. <?php echo number_format($transaction->transaction_price, 0, ",", "."); ?></td>
                    <td>
                      <?php if ($transaction->transaction_status == "Pending") : ?>
                        <div class="badge badge-warning"> <?php echo $transaction->transaction_status; ?></div>
                      <?php elseif ($transaction->transaction_status == "Process") : ?>
                        <div class="badge badge-primary"> <?php echo $transaction->transaction_status; ?></div>
                      <?php elseif ($transaction->transaction_status == "Decline") : ?>
                        <div class="badge badge-danger"> <?php echo $transaction->transaction_status; ?></div>
                      <?php else : ?>
                        <div class="badge badge-success"> <?php echo $transaction->transaction_status; ?></div>
                      <?php endif; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <?php if ($transaction->transaction_status == "Pending") : ?>
              <div class="col-md-12">
                <div class="alert alert-danger"> Belum di Konfirmasi</div>
              </div>
            <?php elseif ($transaction->transaction_status == "Process") : ?>

              <div class="col-md-4">
                <img class="img-fluid" src="<?php echo base_url('assets/img/struk/' . $transaction->transaction_image); ?>">
              </div>
              <div class="col-md-8">
                <a class="btn btn-primary btn-block text-white" href="<?php echo base_url('admin/transaction/success/' . $transaction->id); ?>">Konfirmasi</a>
                <a class="btn btn-danger btn-block text-white" href="<?php echo base_url('admin/transaction/decline/' . $transaction->id); ?>">Decline</a>
              </div>

            <?php elseif ($transaction->transaction_status == "Success") : ?>
              <div class="col-md-4">
                <img class="img-fluid" src="<?php echo base_url('assets/img/struk/' . $transaction->transaction_image); ?>">
              </div>
            <?php else : ?>
              <img class="img-fluid" src="<?php echo base_url('assets/img/struk/' . $transaction->transaction_image); ?>">

            <?php endif; ?>

          </div>
        </div>


      </div>
    </div>
  </div>
</div>