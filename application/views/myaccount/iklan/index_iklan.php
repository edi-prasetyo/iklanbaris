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

                <a class="btn btn-info btn-sm text-white" href="<?php echo base_url('myaccount/iklan/create'); ?>"><i class="ti-plus"></i> Pasang Iklan</a>

                <?php if (!empty($iklan)) : ?>

                    <div class="card mt-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th scope="col" width="10%"></th>
                                        <th scope="col">#ID</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Status</th>
                                        <th width="27%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($iklan as $iklan) : ?>
                                        <?php if ($iklan->iklan_featured >= date('Y-m-d')) : ?>
                                            <tr style="background-color:#deffee">
                                            <?php elseif ($iklan->iklan_status == "Inactive") : ?>
                                            <tr style="background-color:#ffdede">
                                            <?php else : ?>
                                            <tr>
                                            <?php endif; ?>

                                            <td scope="row">
                                                <div class="img-list-frame">
                                                    <img class="img-fluid" src="<?php echo base_url('assets/img/iklan/' . $iklan->iklan_image); ?>">
                                                </div>
                                            </td>
                                            <td scope="row"><?php echo $iklan->id_iklan; ?></td>
                                            <td>
                                                <?php echo substr($iklan->iklan_title, 0, 20); ?><br>
                                                Dilihat : <?php echo $iklan->iklan_views; ?>

                                            </td>
                                            <td>IDR. <?php echo number_format($iklan->iklan_price, 0, ",", "."); ?></td>
                                            <td>
                                                <?php if ($iklan->iklan_status == "Active") : ?>
                                                    <span class="badge badge-success" ;?>
                                                        <?php echo $iklan->iklan_status; ?>
                                                    <?php elseif ($iklan->iklan_status == "Inactive") : ?>
                                                        <span class="badge badge-danger" ;?>
                                                            <?php echo $iklan->iklan_status; ?>
                                                        <?php endif; ?>

                                            </td>

                                            <td>



                                                <?php if ($iklan->iklan_featured <= date('Y-m-d')) : ?>
                                                    <a class="btn btn-success btn-sm text-white" href="<?php echo base_url('myaccount/get_premium/' . $iklan->id); ?>"> <i class="ri-coupon-3-fill"></i> Sundul</a>
                                                <?php else : ?>
                                                    <span class="btn btn-primary text-white btn-sm"> <i class="ri-vip-crown-fill"></i> <?php $date_format = $iklan->iklan_featured;
                                                                                                                                        $newDate = date("d/m/Y", strtotime($date_format));
                                                                                                                                        echo $newDate; ?></span>
                                                <?php endif; ?>



                                                <a class="btn btn-success btn-sm text-white" href="<?php echo base_url('myaccount/update_iklan/' . $iklan->id); ?>"> <i class="ri-edit-box-line"></i> Edit</a>
                                                <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url('iklan/detail/' . $iklan->iklan_slug); ?>"> <i class="ri-eye-line"></i> View</a>
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
                            Anda Belum memasang Iklan
                        </div>

                    </div>



                <?php endif; ?>



                <div class="pagination col-md-12 text-center">
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