<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();

?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" id="top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>"><i class="ri-key-2-fill"></i> Admin</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"><i class="ri-menu-3-line"></i></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav">
        <li class="nav-item active"> <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">Dashboard </a> </li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/province'); ?>"> Provinsi </a></li>

        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/iklan'); ?>"> Iklan </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/category'); ?>"> Kategori </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/berita'); ?>"> Blog </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/user'); ?>"> Member </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/report'); ?>"> Report </a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pengaturan
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('admin/meta') ?>"><i class="ti-user"></i> Website</a>
            <a class="dropdown-item" href="<?php echo base_url('admin/meta/logo'); ?>"><i class="ti-lock"></i> Logo</a>
            <a class="dropdown-item" href="<?php echo base_url('admin/meta/favicon'); ?>"><i class="ti-lock"></i> Favicon</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="ti-power-off"></i>Pengaturan Iklan</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti-user"></i> <?php echo $user->user_name; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('admin/myaccount') ?>"><i class="ti-user"></i> Akun Saya</a>
            <a class="dropdown-item" href="<?php echo base_url('admin/myaccount/ubah_password'); ?>"><i class="ti-lock"></i> Ubah Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="ti-power-off"></i> Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5 mt-5 py-5">