<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $pengeluaran->id; ?>">
    <i class="ti-eye"></i> Lihat
</button>

<div class="modal modal-default fade" id="Edit<?php echo $pengeluaran->id ?>">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail pengeluaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <div class="row">
                    <label class="col-md-4">Tanggal</label>
                    <div class="col-md-8">
                        : <b><?php echo date("d/m/Y", strtotime($pengeluaran->tanggal)); ?></b>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4">Kategory Pengeluaran</label>
                    <div class="col-md-8">
                        : <b><?php echo $pengeluaran->category_name ?></b>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4">Nominal</label>
                    <div class="col-md-8">
                        : <b>

                            <?php if ($pengeluaran->pengeluaran == NULL) : ?>
                                Rp. <?php echo "0"; ?>
                            <?php else : ?>
                                Rp. <?php echo number_format($pengeluaran->pengeluaran, '0', ',', '.') ?>
                            <?php endif; ?>

                        </b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Keterangan</label>
                    <div class="col-md-8">
                        :<b><?php echo $pengeluaran->keterangan ?></b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Foto</label>
                    <div class="col-md-8">
                        : <img src="<?php echo base_url('assets/img/donatur/' . $pengeluaran->foto); ?>" class="img-fluid" />
                    </div>
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->