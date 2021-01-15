<?php $meta = $this->meta_model->get_meta();?>

<section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        <ol>
          <li><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

<?php if (empty($transaksi)) : ?>

    <div class="container">
      <div class="col-md-7 mx-auto">
        <div class="card body-success">
          <div class="card-header order-success">
            <div class="row">
              <div class="col-md-2 text-center">
                <h1 class="display-2"><i class="ri-error-warning-line"></i></h1>
              </div>
              <div class="col-md-10 align-middle">
                <h3><span class="align-middle">Order tidak di temukan</span></h3>
                <p style="font-size:13px;">Masukan kode transasksi dan email dengan benar</p>
              </div>
            </div>
          </div>
          <div class="card-body body-success text-center">
            <span style="font-size:210px;"> <i class="ri-shopping-bag-line"></i></span>
            <p>Maaf tidak ada order yang bisa di tampilkan, pastikan anda telah menginput kode transaksi dan email dengan benar
              atau hubungi customer service</p>
              <a class="btn btn-success" href="<?php echo base_url('transaksi');?>">Kembali</a>
            </div>
            <div class="card-footer order-success">
              <div class="form-row d-flex justify-content-between align-items-center ">
                Customer Support<br>
                <h5><i class="fab fa-whatsapp"></i> <?php echo $meta->telepon;?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php else: ?>

      <div class="container">
        <div class="col-md-7 mx-auto">
          <div class="card body-success">
            <div class="card-header order-success">
              <div class="row">
                <div class="col-md-2 text-center">
                  <h1 class="display-2"><i class="ri-shopping-basket-line"></i></h1>
                </div>
                <div class="col-md-10 align-middle">
                  <h3><span class="align-middle">Detail Pesanan Anda</span></h3>
                  <p style="font-size:13px;">Simpan Struk Invoice ini untuk dapat melakukan pengecekan status order anda</p>
                </div>
              </div>
            </div>
            <div class="card-body body-success">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <?php echo $transaksi->product;?></br>
                      Customer :</br>
                      <b><?php echo $transaksi->user_name;?></b></br>

                      Kode Transaksi :</br>
                      <b><?php echo $transaksi->transaction_code;?></b></br>

                      Kode Unik :</br>
                      <b><?php echo $transaksi->unique_code;?></b></br>

                      Harga :</br>
                      <b>IDR. <?php echo number_format($transaksi->price, '0', ',', '.');?></b></br>
                      <hr>
                      Total Pembayaran </br>
                      <span style="font-size:30px;"><b>IDR. <?php echo number_format($transaksi->price, '0', ',', '.');?></b></span></br>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  Untuk Pembayaran Silahkan Transfer Ke rekening di bawah ini<br>

                  <?php foreach ($bank as $bank) :?>
                    <div class="row mt-3">
                      <div class="col-4"> <img class="img-fluid" src="<?php echo base_url('assets/img/galery/'.$bank->bank_logo);?>">
                      </div>
                      <div class="col-8">
                        No. rek : <b><?php echo $bank->bank_number;?></b>
                        A.n   : <b><?php echo $bank->bank_account;?></b>
                      </div>
                    </div>
                    <hr>
                  <?php endforeach;?>
                  </div>

<div class="col-md-12">

  <?php if ($transaksi->payment_status == "Belum") :?>
    Status Pembayaran :<br>
    <div class="badge badge-danger">
      <?php echo $transaksi->payment_status;?>
    </div><br>
    Silahkan Lakukan Pembayaran dan mengkonfirmasi pembayaran Anda<br>
    <a class="btn btn-success" href="<?php echo base_url('transaksi/konfirmasi/' .$transaksi->transaction_code);?>">Konfirmasi</a>

  <?php elseif($transaksi->payment_status == "Proses"):?>
    Status Pembayaran :<br>
    <div class="badge badge-warning">
      <?php echo $transaksi->payment_status;?>
    </div><br>
    <div class="alert alert-warning">
      Pembayaran Ada sedang di proses silahkan tunggu beberapa saat akan kami lakukan pengecekan
    </div>

    <?php else:?>
      Status Pembayaran :<br>
      <div class="badge badge-success">
        <?php echo $transaksi->payment_status;?>
      </div><br>

    <?php endif;?>

    <hr>
    <?php if ($transaksi->order_status== "Belum") :?>
      <div class="alert alert-danger">
        Status Order :<br>
        Maaf Pesanan Anda Belum dapat di proses karena belum melakukan pembayaran
      </div>
    <?php elseif($transaksi->order_status== "Proses"):?>
      <div class="alert alert-warning">
        Status Order :<br>
        Pesanan Anda Sedang dalam pengerjaan
      </div>
    <?php elseif($transaksi->order_status== "Selesai"):?>
      <div class="alert alert-success">
        Status Order :<br>
        Pesanan Anda Sudah Selesai
      </div>
    <?php endif;?>

</div>



                </div>
              </div>

              <div class="card-footer order-success">
                <div class="form-row d-flex justify-content-between align-items-center ">
                  Customer Support<br>
                  <h5><i class="fab fa-whatsapp"></i> <?php echo $meta->telepon;?></h5>
                </div>
              </div>


            </div>


          </div>
        </div>




  <?php endif;?>
