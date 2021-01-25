<div class="card">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">

        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/menu/create'); ?>" class="btn btn-rounded btn-info text-white">Tambah Menu</a>

    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('message');
        echo '</div>';
    }

    ?>

    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Url</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach ($list_menu as $menu) { ?>
                <tr>
                    <td><?php echo $menu->menu_name; ?></td>
                    <td><?php echo $menu->menu_url; ?></td>
                    <td><?php echo $menu->menu_location; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/menu/update/') . $menu->id; ?>" class="btn btn-info btn-sm text-white"> Ubah</a>
                        <?php include "delete_menu.php"; ?>
                    </td>
                </tr>

            <?php }; ?>
        </table>
    </div>
</div>