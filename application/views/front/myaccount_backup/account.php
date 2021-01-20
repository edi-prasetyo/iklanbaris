<div class="container">
  <div class="account-page">
    <div class="row">


      <div class="col-md-12">
        <div class="card">
          <div class="card-header order-success">
            <i class="ri-folder-user-line"></i> Welcome
            <div class="pull-right">
                <a class="btn btn-info text-white" href="<?php echo base_url('myaccount/add_listing');?>"><i class="ti-plus"></i> Pasang Iklan</a>
            </div>
          </div>


<div class="col-md-3">
  <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" class="img img-thumbnail rounded-circle img-fluid">
</div>
<div class="col-md-9">
  <h2>Hallo, <?php echo $user->user_name; ?></h2>
  <p>Selamat Datang di Web <b><?php echo $meta->title; ?></b></p>
  <a href="<?php echo base_url('myaccount/update'); ?>" class="btn btn-primary btn-user ">
    Ubah Profile
  </a>
  <div class="row" style="line-height:40px;">
    <div class="col-3">
      Nama
    </div>
    <div class="col-9">
      : <?php echo $user->user_name; ?>
    </div>
    <div class="col-3">
      Email
    </div>
    <div class="col-9">
      : <?php echo $user->email; ?>
    </div>
    <?php if ($user->user_phone == NULL) :?>

    <?php else:?>
      <div class="col-3">
        Phone
      </div>
      <div class="col-9">
        : <?php echo $user->user_phone; ?>
      </div>
    <?php endif;?>

    <?php if ($user->user_address == NULL) :?>

    <?php else:?>
      <div class="col-3">
        Alamat
      </div>
      <div class="col-9">
        : <?php echo $user->user_address; ?>
      </div>
    <?php endif;?>
    <div class="col-3">
      Tanggal Join
    </div>
    <div class="col-9">
      :  <?php echo date('d F Y', $user->date_created); ?>, Jam <?php echo date('h:i:s A', $user->date_created); ?>
    </div>

    <?php if ($user->user_phone == NULL) :?>

    <?php else:?>
      <div class="alert alert-secondary mt-3">
        <h4>Biografi</h4>

        <?php echo $user->user_bio; ?>
      </div>
    <?php endif;?>
  </div>
</div>

</div>
</div>
</div>
</div>
</div>
