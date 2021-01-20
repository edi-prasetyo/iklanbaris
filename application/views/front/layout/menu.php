<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();

?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" id="top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url() ?>"><img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>"></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"><i class="ri-menu-3-line"></i></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav">
        <li class="nav-item active"> <a class="nav-link" href="<?php echo base_url(); ?>">Home </a> </li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('iklan'); ?>"> Iklan </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('category'); ?>"> Kategori </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('blog'); ?>"> Blog </a></li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <?php if ($this->session->userdata('email')) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti-user"></i> <?php echo $user->user_name; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo base_url('myaccount') ?>"><i class="ti-panel"></i> Panel</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/profile') ?>"><i class="ti-user"></i> Akun Saya</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/iklan') ?>"><i class="ri-shopping-bag-line"></i> Iklan Saya</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/package') ?>"><i class="ri-vip-crown-line"></i> Paket Premium</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/transaction') ?>"><i class="ri-file-list-3-line"></i> Riwayat Transaksi</a>

              <div class="dropdown-divider"></div>
              <?php if ($user->role_id == 1) : ?>
                <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">Panel Admin</a>
              <?php endif; ?>
              <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="ti-power-off"></i> Logout</a>
            </div>
          </li>
        <?php } else { ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth') ?>"><i class="ri-login-box-line"></i> Login</a></li>
          <span class="border-left"></span>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth/register') ?>"> Daftar</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>