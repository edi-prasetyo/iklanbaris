<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<!-- ======= Breadcrumbs Section ======= -->
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
  <?php if ($this->session->userdata('id')) : ?>
    <!-- Progress Table start -->
    <div class="row">

      <div class="col-md-3">

        <?php include "side_menu.php";?>


      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header order-success">
            <i class="ri-shopping-bag-2-line"></i> <?php echo $title;?>
          </div>
          <div class="card-body">


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

            <div class="single-table">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thead class="text-uppercase">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Kode</th>
                      <th scope="col">Produk</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Pembayaran</th>
                      <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($transaksi as $transaksi):?>

                      <tr>
                        <th scope="row"><?php echo $no;?></th>
                        <td><?php echo $transaksi->transaction_code;?></td>

                        <td><?php echo $transaksi->product;?></td>
                        <td>IDR. <?php echo number_format($transaksi->price, '0', ',', '.');?></td>
                        <td>


                          <?php if ($transaksi->payment_status == 'Belum') :?>
                            <span class="badge badge-danger">Belum</span>
                          <?php elseif($transaksi->payment_status == 'Proses'):?>
                            <span class="badge badge-warning"><?php echo $transaksi->payment_status;?></span>
                          <?php else:?>
                            <span class="badge badge-success"><?php echo $transaksi->payment_status;?></span>
                          <?php endif;?>

                        </td>


                        <td>

                          <?php if($transaksi->payment_status == 'Belum') :?>
                            <?php echo form_open('transaksi/detail');?>
                            <input type="hidden" name="transaction_code" value="<?php echo $transaksi->transaction_code;?>">
                            <input type="hidden" name="email" value="<?php echo $transaksi->email;?>">
                            <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                            <?php echo form_close();?>

                            <?php elseif($transaksi->payment_status == 'Proses') :?>
                              <?php echo form_open('transaksi/detail');?>
                              <input type="hidden" name="transaction_code" value="<?php echo $transaksi->transaction_code;?>">
                              <input type="hidden" name="email" value="<?php echo $transaksi->email;?>">
                              <button type="submit" class="btn btn-primary btn-sm">Lihat</button>
                              <?php echo form_close();?>
                            <?php else: ?>
                              <?php echo form_open('transaksi/detail');?>
                              <input type="hidden" name="transaction_code" value="<?php echo $transaksi->transaction_code;?>">
                              <input type="hidden" name="email" value="<?php echo $transaksi->email;?>">
                              <button type="submit" class="btn btn-primary btn-sm">Download</button>
                              <?php echo form_close();?>

                            <?php endif;?>

                        </td>
                      </tr>

                    <?php $no++; endforeach;   ?>

                  </tbody>
                </table>
              </div>

              <div class="pagination text-center ml-3">
                <?php if (isset($pagination)) {
                  echo $pagination;
                } ?>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- Progress Table end -->

      

    </div>

  <?php else:?>

    <div class="col-md-5 mx-auto">
        <div class="card mt-5">
          <div class="card-header login-header">
              <h3 class="text-center mb-4 mt-4">Cek Order <i class="ti-arrow-right"></i></h3>
            <p class="text-center mb-4">Silahkan Masukan kode Transaksi dan email untuk cek Order Anda</p>
          </div>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                    echo form_open('transaksi/detail')
                    ?>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-secure-payment-line"></i> </span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="transaction_code" placeholder="Kode Transaksi..." value="<?php echo set_value('transaction_code'); ?>">

                      </div>
                      <?php echo form_error('transaction_code', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-mail-send-line"></i> </span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="email" placeholder="Email..">

                    </div>
                      <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="submit-btn-area">
                          <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                          <div class="login-other row mt-4">
                          </div>
                      </div>

                    <?php echo form_close() ?>
                    <hr>


                </div>

            </div>
        </div>
    </div>

  <?php endif;?>


</div>
