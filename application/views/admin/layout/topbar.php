<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>





<!-- TopBar -->

<nav class="navbar navbar-expand navbar-light bg-navbar topbar static-top" style="border-left:1px solid #ee5343;border-right:1px solid #ee5343;">

    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">



        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="<?php echo base_url(); ?>" target="blank" id="userDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ti-link"></i>
                <span class="ml-2 d-none d-lg-inline text-white small">Lihat Website</span>
            </a>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $user->user_name; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url('admin/myaccount/update'); ?>">
                    <i class="ti-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Profile
                </a>
                <a class="dropdown-item" href="<?php echo base_url('admin/myaccount/ubah_password'); ?>">
                    <i class="ti-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ganti Password
                </a>


                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
                    <i class="ti-plug fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- Topbar -->


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>"> Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/' . $this->uri->segment(2)) ?>">
                    <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?>
                </a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ol>
    </div>