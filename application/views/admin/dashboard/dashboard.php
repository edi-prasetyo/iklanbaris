<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Iklan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($count_iklan); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/iklan'); ?>" style="color:#333;text-decoration:none;">
                                <span class="mr-2 text-muted"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-muted">Lihat Data Iklan</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ri-store-2-line fa-2x text-success"></i>
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
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Berita</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php echo count($berita); ?>
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/berita'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-muted mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-muted">Lihat Data Berita</span>
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
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Iklan Terbaru</h6>
                <a class="m-0 float-right btn btn-danger text-white btn-sm" href="<?php echo base_url('admin/iklan'); ?>">View More <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Kategori</th>

                            <!-- <th>Action</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($iklan_terbaru as $iklan_terbaru) : ?>

                            <tr>


                                <td><?php echo $iklan_terbaru->iklan_title; ?></td>
                                <td><?php echo $iklan_terbaru->iklan_status; ?></td>
                                <td><span class="badge badge-success"><?php echo $iklan_terbaru->category_name; ?></span></td>


                                <!-- <td><a href="<?php echo base_url('admin/dashboard/view/' . $kas->id); ?>" class="btn btn-primary btn-sm">Detail</a></td> -->



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Message From Customer-->
    <div class="col-xl-4 col-lg-5 ">
        <div class="card">
            <div class="card-header py-3 bg-primary d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-light">Report</h6>
            </div>
            <div class="card-body">
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                            problem I've been having.</div>
                        <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a href="#">
                        <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                        </div>
                        <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </div>
                        <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                            ducimus qui blanditiis
                        </div>
                        <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                    </a>
                </div>

            </div>
            <div class="card-footer text-center">
                <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>















</div>
<!--Row-->