<?php
//Proteksi Halaman Admin
if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {
    is_login();
    //Gabungan Semua layout
    require_once('header.php');
    require_once('menu.php');
    require_once('content.php');
    require_once('footer.php');
} else {
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Akses tidak di berikan Silahkan Login</div> ');
    redirect('auth');
}
