<div class="container">

    <div class="card">
        <div class="card-header"><?php echo $title; ?></div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label>ID Iklan : </label> <br> <b><?php echo $report->id_iklan; ?></b><br>
                    <label> Pelapor : </label><br> <b><?php echo $report->user_name; ?></b><br>
                </div>
                <div class="col-6">
                    <label>Judul Iklan :</label> <br> <b><?php echo $report->iklan_title; ?></b><br>

                    <label> Lihat Iklan : </label> <br>
                    <a href="<?php echo base_url('admin/iklan/view/' . $report->iklan_id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                </div>

                <div class="col-12">

                    <label>Isi Laporan : </label><br>

                    <span class="alert alert-danger"><?php echo $report->report_desc; ?></span>
                </div>

            </div>

        </div>
    </div>


</div>