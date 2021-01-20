<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <?php
        //Form Open
        echo form_open(base_url('admin/faq/create/'));
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Pertanyaan</label>

            <div class="col-lg-9">
                <input type="text" class="form-control" name="faq_answer" placeholder="Pertanyaan">
                <?php echo form_error('faq_answer', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Jawaban</label>

            <div class="col-lg-9">
                <textarea class="form-control" id="summernote" name="faq_question" placeholder="Jawaban"></textarea>
                <?php echo form_error('faq_question', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status
            </label>
            <div class="col-lg-9">
                <select name="faq_status" class="form-control custom-select">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
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