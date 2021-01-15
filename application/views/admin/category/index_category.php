<!-- Invoice Example -->
<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
<div class="row">

    <div class="col-md-4">
        <div class="card">
            <?php
            echo $this->session->flashdata('message');
            if (isset($error_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>

            <div class="card-header">
                <h6 class="m-0 font-weight-bold">Tambah Kategori</h6>

            </div>
            <div class="card-body">
                <?php
                //Form Open
                echo form_open_multipart(base_url('admin/category/create'));
                ?>

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori">
                    <?php echo form_error('category_name', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Status Berita <span class="text-danger">*</span>
                    </label>

                    <select name="category_type" class="form-control form-control-chosen">
                        <option value="Blog">Blog</option>
                        <option value="Iklan">Iklan</option>
                    </select>

                </div>

                <div class="form-group">
                    <label class="col-lg-12 col-form-label">Upload icon <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input type="file" name="category_image">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


            </div>

        </div>
    </div>




    <div class="col-md-8 mb-4">




        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><?php echo $title; ?></h6>

            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Tipe</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($category as $category) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo $category->category_name; ?></td>
                                <td><?php echo $category->category_type; ?></td>

                                <td>

                                    <a href="<?php echo base_url('admin/category/update/' . $category->id); ?>" class="btn btn-sm btn-info"><i class="ti-pecil"></i> Edit</a>

                                    <?php include "delete_category.php"; ?>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">

                <div class="pagination col-md-12 text-center">
                    <?php if (isset($pagination)) {
                        echo $pagination;
                    } ?>
                </div>
            </div>
        </div>
    </div>

</div>