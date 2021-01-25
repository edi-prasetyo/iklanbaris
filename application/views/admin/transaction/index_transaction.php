<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<!-- Progress Table start -->
<div class="my-3">
  <div class="card">
    <div class="card-header">
      <div class="form-row d-flex justify-content-between align-items-center">

        <?php echo $title; ?>

        <?php echo form_open('admin/transaction'); ?>

        <div class="col-sm-12 my-1 row">

          <div class="col-8">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-search"></i></div>
              </div>
              <input type="text" class="form-control" name="transaction_code" placeholder="Cari Transaksi">
            </div>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary">Cari</button>

          </div>

        </div>
        <?php echo form_close(); ?>



      </div>
    </div>

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

    <div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="text-uppercase">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode</th>
            <th scope="col">Member</th>
            <th scope="col">Whatsapp</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Pembayaran</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($transaction as $transaction) : ?>

            <tr>
              <th scope="row"><?php echo $no; ?></th>
              <td><?php echo $transaction->transaction_code; ?></td>
              <td><?php echo $transaction->user_name; ?></td>
              <td><?php echo $transaction->user_phone; ?></td>
              <td><?php echo $transaction->transaction_product; ?></td>
              <td>IDR. <?php echo number_format($transaction->transaction_price, 0, ",", "."); ?></td>
              <td>
                <?php if ($transaction->transaction_status == 'Pending') : ?>
                  <span class="badge badge-warning"><?php echo $transaction->transaction_status; ?></span>
                <?php elseif ($transaction->transaction_status == 'Process') : ?>
                  <span class="badge badge-primary"><?php echo $transaction->transaction_status; ?></span>
                <?php elseif ($transaction->transaction_status == 'Decline') : ?>
                  <span class="badge badge-danger"><?php echo $transaction->transaction_status; ?></span>
                <?php else : ?>
                  <span class="badge badge-success"><?php echo $transaction->transaction_status; ?></span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?php echo base_url('admin/transaction/view/' . $transaction->id); ?>" class="text-primary"><i class="fas fa-edit"></i></a>

              </td>
            </tr>

          <?php $no++;
          endforeach;  ?>

        </tbody>
      </table>
    </div>

    <div class="card-footer my-0">

      <div class="pagination">
        <?php if (isset($pagination)) {
          echo $pagination;
        } ?>
      </div>

    </div>
  </div>
</div>
<!-- Progress Table end -->