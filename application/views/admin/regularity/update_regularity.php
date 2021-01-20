<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $regularity->id; ?>">
    <i class="fa fa-edit"></i> Edit
</button>

<div class="modal modal-default fade" id="Edit<?php echo $regularity->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Peraturan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Error warning
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                echo form_open(base_url('admin/regularity/update/' . $regularity->id));

                ?>

                <div class="form-group">
                    <label>Nama Peraturan</label>
                    <input type="text" class="form-control" name="regularity_name" value="<?php echo $regularity->regularity_name ?>">
                </div>

                <div class="form-group">
                    <label>Rules Tipe <span class="text-danger">*</span>
                    </label>

                    <select name="regularity_type" class="form-control custom-select">
                        <option value="Buyer" <?php if ($regularity->regularity_type == "Buyer") {
                                                    echo "selected";
                                                }; ?>>Pembeli</option>
                        <option value="Seller" <?php if ($regularity->regularity_type == "Seller") {
                                                    echo "selected";
                                                }; ?>>Penjual</option>
                    </select>

                </div>



                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->