<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $pemasukan->id; ?>">
    <i class="ti-eye"></i> Lihat
</button>

<div class="modal modal-default fade" id="Edit<?php echo $pemasukan->id ?>">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail pemasukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <div class="row">
                    <label class="col-md-4">Tanggal</label>
                    <div class="col-md-8">
                        : <b><?php echo date("d/m/Y", strtotime($pemasukan->tanggal)); ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Nama Donatur</label>
                    <div class="col-md-8">
                        : <b><?php echo $pemasukan->donatur_title ?> <?php echo $pemasukan->donatur_name ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Kategory Donasi</label>
                    <div class="col-md-8">
                        : <b><?php echo $pemasukan->category_name ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Nomor HP</label>
                    <div class="col-md-8">
                        : <b><?php echo $pemasukan->donatur_phone ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Nominal</label>
                    <div class="col-md-8">
                        : <?php if ($pemasukan->nominal == NULL) : ?>
                            Rp. <?php echo '0'; ?>
                        <?php else : ?>
                            Rp. <?php echo number_format($pemasukan->nominal, '0', ',', '.') ?>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Keterangan</label>
                    <div class="col-md-8">
                        : <b><?php echo $pemasukan->keterangan ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Foto</label>
                    <div class="col-md-8">
                        : <img src="<?php echo base_url('assets/img/donatur/' . $pemasukan->foto); ?>" class="img-fluid" />
                    </div>
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->