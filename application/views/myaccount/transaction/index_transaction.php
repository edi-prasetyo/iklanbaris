<?php if ($this->session->userdata('id')) : ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?>


                <?php if (!empty($transaction)) : ?>

                    <div class="card mt-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Paket</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Status</th>
                                        <th width="27%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaction as $transaction) : ?>

                                        <td><?php echo date('d/m/Y', $transaction->date_created); ?></td>
                                        <td><?php echo $transaction->transaction_code; ?></td>
                                        <td><?php echo $transaction->transaction_product; ?></td>
                                        <td>IDR. <?php echo number_format($transaction->transaction_price, 0, ",", "."); ?></td>
                                        <td>
                                            <?php if ($transaction->transaction_status == "Decline") : ?>
                                                <div class="badge badge-danger"> Batal</div>
                                            <?php elseif ($transaction->transaction_status == "Process") : ?>
                                                <div class="badge badge-info"> Proses</div>
                                            <?php elseif ($transaction->transaction_status == "Pending") : ?>
                                                <div class="badge badge-warning"> Pending</div>
                                            <?php elseif ($transaction->transaction_status == "Success") : ?>
                                                <div class="badge badge-success"> Sukses</div>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($transaction->transaction_status == "Pending") : ?>
                                                <a class="btn btn-success btn-sm text-white" href="<?php echo base_url('myaccount/transaction/confirm/' . $transaction->id); ?>"> <i class="ri-edit-box-line"></i> Konfirmasi</a>
                                                <a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('myaccount/transaction/decline/' . $transaction->id); ?>"> <i class="ri-delete-bin-line"></i> Batalkan</a>
                                            <?php else : ?>

                                            <?php endif; ?>
                                        </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>



                <?php else : ?>

                    <div class="card my-2">
                        <div class="card-body display-5 text-center">
                            Anda Belum Transaksi
                        </div>

                    </div>



                <?php endif; ?>



                <div class="pagination col-md-12 text-center my-3">
                    <?php if (isset($pagination)) {
                        echo $pagination;
                    } ?>
                </div>

            </div>
        </div>
    </div>




<?php else : ?>

    <?php redirect('auth'); ?>


<?php endif; ?>