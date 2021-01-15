
<div class="nav-side-menu">
  <div class="brand"><i class="ri-file-list-line"></i> Menu</div>
  <i class="ri-menu-add-fill fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

  <div class="menu-list">

    <ul id="menu-content" class="menu-content collapse out">
      <li>
        <a href="<?php echo base_url('myaccount');?>">
          <i class="ri-user-line"></i> My Account
        </a>
      </li>

      <li>
        <a href="<?php echo base_url('myaccount/ubah_password');?>"><i class="ri-lock-line"></i> Password </a>
      </li>

      <li data-toggle="collapse" data-target="#new" class="collapsed">
        <a href="#"><i class="ri-shopping-bag-2-line"></i> Transaksi <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="new">
        <li><a href="<?php echo base_url('transaksi');?>">Vector</a></li>
        <li><a href="<?php echo base_url('transaksi');?>">Downlaod</a></li>
      </ul>

    </ul>
  </div>
</div>
