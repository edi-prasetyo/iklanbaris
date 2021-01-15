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


  <div class="container">
    <div class="col-md-7 mx-auto">
      <div class="card body-success">
        <div class="card-header order-success">
          <div class="row">
            <div class="col-md-2 text-center">
              <h1 class="display-2"><i class="ri-secure-payment-line"></i></h1>
            </div>
            <div class="col-md-10 align-middle">
              <h3><span class="align-middle">Konfirmasi Transaksi #<?php echo $transaksi->transaction_code;?></span></h3>
              <p style="font-size:13px;">Masukan kode transasksi dan email dengan benar</p>
            </div>
          </div>
        </div>
        <div class="card-body body-success">
<?php echo form_open_multipart('transaksi/konfirmasi/'.$transaksi->transaction_code);?>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>Transfer Ke Rekening</label>
                <select class="form-control form-control-chosen" name="payment_bank" value="">
                  <?php foreach ($bank as $bank) :?>
                    <option value="<?php echo $bank->bank_name;?>"><?php echo $bank->bank_name;?> - <?php echo $bank->bank_number;?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Dari Rekening Bank</label>
                <input type="text" class="form-control" name="bank_name" placeholder="Nama Bank .." value="<?php echo set_value('bank_name'); ?>">
                <?php echo form_error('bank_name', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor Rekening</label>
                <input type="text" class="form-control" name="bank_number" placeholder="Nomor Rekening" value="<?php echo set_value('bank_number'); ?>">
                <?php echo form_error('bank_number', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Atas Nama</label>
                <input type="text" class="form-control" name="bank_account" placeholder="Nama Bank .." value="<?php echo set_value('bank_account'); ?>">
                <?php echo form_error('bank_account', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Transfer</label>
                <input type="date" name="date_payment" class="form-control" placeholder="Tanggal" id="id_tanggal_bayar">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload Foto</label>
                <div class="input-group mb-3">
                  <input type="file" name="bukti_transfer">
                </div>
              </div>
            </div>

            <div class="col-md-6">
            <button type="submit" class="btn btn-warning btn-block">Kirim</button>
            </div>

          </div>
          <?php echo form_close();?>
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
