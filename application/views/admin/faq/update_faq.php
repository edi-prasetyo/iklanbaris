<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <?php
        //Form Open
        echo form_open(base_url('admin/faq/update/' . $faq->id));
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Pertanyaan</label>

            <div class="col-lg-9">
                <input type="text" class="form-control" name="faq_answer" value="<?php echo $faq->faq_answer; ?>">
                <?php echo form_error('faq_answer', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Jawaban</label>

            <div class="col-lg-9">
                <textarea class="form-control" id="summernote" name="faq_question"><?php echo $faq->faq_question; ?></textarea>
                <?php echo form_error('faq_question', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status
            </label>
            <div class="col-lg-9">
                <select name="faq_status" class="form-control custom-select">
                    <option value="Active" <?php if ($faq->faq_status == "Active") {
                                                echo "selected";
                                            }; ?>>Active</option>
                    <option value="Inactive" <?php if ($faq->faq_status == "Inactive") {
                                                    echo "selected";
                                                }; ?>>Inactive</option>
                </select>
            </div>

        </div>



        <div class="form-group row">
            <label class="col-lg-3"></label>
            <div class="col-lg-9">
                <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
            </div>
        </div>


        <?php
        //Form Close
        echo form_close();
        ?>

    </div>
</div>