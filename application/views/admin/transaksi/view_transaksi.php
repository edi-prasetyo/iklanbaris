<?php $meta = $this->meta_model->get_meta();?>
<div class="container-fluid">
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
      <div class="card p-3 mb-3">
        <div class="row">
          <div class="col-12">
            <h4>
              <b><?php echo $meta->title;?></b><br>
              <span style="font-size:14px;"><?php echo $meta->link;?></span>
              <small class="float-right">Jakarta, <?php echo date('d F Y', $transaksi->date_created); ?></small>
            </h4>
          </div>
        </div>
        <div class="row invoice-info">
          <div class="col-sm-6 invoice-col">
            From
            <address>
              <strong><?php echo $meta->title;?></strong><br>
              <?php echo $meta->alamat;?>
              Phone: <?php echo $meta->telepon;?><br>
              Email: <?php echo $meta->email;?>
            </address>
          </div>
          <div class="col-sm-4 invoice-col">
            Customer
            <address>
              <strong><?php echo $transaksi->user_name;?></strong><br>
              <?php echo $transaksi->user_address;?><br>

              Phone:   <?php echo $transaksi->user_phone;?><br>

            </address>
          </div>
          <div class="col-sm-2 invoice-col text-right">

            <br>
            <b>Order ID:</b> #<?php echo $transaksi->transaction_code;?><br>
          </div>
        </div>
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th width="20%">Gambar</th>
                  <th>Produk</th>
                  <th>Harga</th>
                  <th>Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><img class="img-fluid" src="<?php echo base_url('assets/img/order/vector/'.$transaksi->image);?>"> </td>
                  <td><?php echo $transaksi->product;?></td>
                  <td><?php echo $transaksi->price;?></td>
                  <td><?php echo $transaksi->payment_status;?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <?php if ($transaksi->payment_status == "Belum"):?>


            Belum Ada Pembayaran

          <?php elseif($transaksi->payment_status == "Proses"):?>

            <div class="col-md-6">
              Pembayaran telah di transfer <br>
              Ke Bank : <?php echo $transaksi->payment_bank;?><br>
              Dari Bank : <?php echo $transaksi->bank_name;?><br>
              Atas Nama : <?php echo $transaksi->bank_account;?><br>
              Nomor Rekening  : <?php echo $transaksi->bank_number ;?><br>
              Tanggal Transfer  : <?php echo $transaksi->date_payment ;?><br>
            </div>

            <div class="col-md-6">
              <img class="img-fluid" src="<?php echo base_url('assets/img/struk/' .$transaksi->bukti_transfer);?>">
            </div>
            <a class="btn btn-primary" href="<?php echo base_url('admin/transaksi/lunas/' .$transaksi->id);?>">Lunas</a>


        </div>

      <?php elseif($transaksi->payment_status == "Lunas"):?>
          <h3>  Pembayaran Sudah di lunasi</h3><hr>
            <a class="btn btn-primary" href="<?php echo base_url('admin/transaksi/selesai/' .$transaksi->id);?>">Selesai</a>
      <?php endif;?>

      </div>
    </div>
  </div>
</div>
