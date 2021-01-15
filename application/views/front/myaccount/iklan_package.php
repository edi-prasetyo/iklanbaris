<div class="container my-5">

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="main-heading">PILIH PAKET </div>
        </div>
    </div>
    <div class="row">

        <?php foreach ($package as $package) : ?>
            <div class="col-lg-4">
                <div class="price-box">
                    <div class="">
                        <div class="price-label"><?PHP echo $package->package_name; ?></div>
                        <div class="price">IDR. <?PHP echo number_format($package->package_price, 0, ",", "."); ?></div>
                        <div class="price-info">.</div>
                    </div>
                    <div class="info">
                        <ul>
                            <li><i class="fas fa-check"></i><?php echo $package->package_post; ?> Post Premium Iklan</li>

                        </ul>
                        <a href="<?php echo base_url('myaccount/package/1'); ?>" class="plan-btn">Beli Paket</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>