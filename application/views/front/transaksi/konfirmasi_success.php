<section>
  <div class="container">
    <div class="col-md-7 mx-auto">
      <div class="card mt-5 body-success">
        <div class="card-header order-success">
          <div class="row">
            <div class="col-md-2 text-center">
              <h1 class="display-2"><i class="ri-checkbox-circle-line"></i></h1>
            </div>
            <div class="col-md-10 align-middle">
              <h3><span class="align-middle">Konfirmasi Berhasil</span></h3>
              <p style="font-size:13px;">Masukan kode transasksi dan email dengan benar</p>
            </div>
          </div>
        </div>
        <div class="card-body body-success text-center">
          <span style="font-size:210px;"> <i class="ri-secure-payment-line"></i></span>
          <p>Terima kasih pembayaran anda akan kami proses</p>
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
  </section>
