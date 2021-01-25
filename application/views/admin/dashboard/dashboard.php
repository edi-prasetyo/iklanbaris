<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($transaction); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/transaction'); ?>" style="color:#333;text-decoration:none;">
                                <span class="mr-2 text-muted"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-muted">Lihat Data Transaksi</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ri-newspaper-line fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Member</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($list_user); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/user'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-muted mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-muted">Lihat Data Member</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ri-user-follow-line fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Iklan</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php echo count($count_iklan); ?>
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/iklan'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-muted mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-muted">Lihat Data Iklan</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-credit-card fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Invoice Example -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between bg-info text-white">
                <h6 class="m-0 font-weight-bold">Transaksi Terbaru</h6>
                <a class="m-0 float-right btn btn-danger text-white btn-sm" href="<?php echo base_url('admin/transaction'); ?>">View More <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>User</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th width="10%"></th>

                            <!-- <th>Action</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi_baru as $transaksi_baru) : ?>

                            <tr>


                                <td><?php echo $transaksi_baru->transaction_user; ?></td>
                                <td>IDR. <?php echo number_format($transaksi_baru->transaction_price, 0, ",", "."); ?></td>
                                <td>
                                    <?php if ($transaksi_baru->transaction_status == "Decline") : ?>
                                        <span class="badge badge-danger"><?php echo $transaksi_baru->transaction_status; ?></span>
                                    <?php elseif ($transaksi_baru->transaction_status == "Pending") : ?>
                                        <span class="badge badge-warning"><?php echo $transaksi_baru->transaction_status; ?></span>
                                    <?php elseif ($transaksi_baru->transaction_status == "Process") : ?>
                                        <span class="badge badge-info"><?php echo $transaksi_baru->transaction_status; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-success"><?php echo $transaksi_baru->transaction_status; ?></span>
                                    <?php endif; ?>
                                </td>


                                <td><a href="<?php echo base_url('admin/transaction/view/' . $transaksi_baru->id); ?>" class="btn btn-info text-white btn-sm">Lihat</a></td>



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Message From Customer-->
    <div class="col-xl-4 col-lg-5 ">
        <div class="list-group">
            <span class="list-group-item list-group-item-action bg-info text-white">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">Iklan Terbaru</h6>

                </div>

            </span>
            <?php foreach ($iklan_terbaru as $iklan_terbaru) : ?>
                <a href="<?php echo base_url('admin/iklan/view/' . $iklan_terbaru->id); ?> " class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1"><?php echo $iklan_terbaru->iklan_title; ?></h6>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <small class="text-muted"><i class="ri-price-tag-3-line"></i> <?php echo $iklan_terbaru->category_name; ?></small>
                        <small class="text-muted"><i class="ri-user-line"></i> <?php echo $iklan_terbaru->user_name; ?></small>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>















</div>
<!--Row-->