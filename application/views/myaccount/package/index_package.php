<div class="container my-5">


	<?php
	//Notifikasi
	if ($this->session->flashdata('message')) {
		echo $this->session->flashdata('message');
	}
	?>

	<div class="row">

		<div class="col-md-12">
			<?php foreach ($transaction_user as $transaction_user) : ?>
				<?php if ($transaction_user->transaction_status == "Pending") : ?>
					<div class="card">
						<table class="table">
							<thead>
								<tr>

									<th scope="col">Paket</th>
									<th scope="col">Status</th>
									<th width="35%" scope="col"><a class="btn btn-info btn-sm text-white pull-right" href="<?php echo base_url('myaccount/transaction'); ?>"><i class="ri-file-list-3-line"></i> Riwayat Transaksi</a></th>
								</tr>
							</thead>
							<tbody>
								<tr>

									<td><?php echo $transaction_user->transaction_product; ?></td>
									<td>
										<div class="badge badge-warning"> <?php echo $transaction_user->transaction_status; ?></div>
									</td>
									<td>
										<a href="<?php echo base_url('myaccount/transaction/decline/' . $transaction_user->id); ?>" class="btn btn-danger btn-sm text-white">Batalkan transaction</a>
										<a href="<?php echo base_url('myaccount/transaction/confirm/' . $transaction_user->id); ?>" class="btn btn-success btn-sm text-white">Konfirmasi Pembayaran</a>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<div class="main-heading">PILIH PAKET </div>
		</div>
	</div>
	<div class="row">


		<?php foreach ($package as $package) : ?>
			<div class="col-lg-4">
				<div class="price-box">
					<div class="">
						<div class="price-label"><?PHP echo $package->package_name; ?></div>
						<div class="price">IDR. <?PHP echo number_format($package->package_price, 0, ",", "."); ?></div>
						<div class="price-info">.</div>
					</div>
					<div class="info">
						<ul>
							<li><i class="fas fa-check"></i><?php echo $package->package_post; ?> Post Premium Iklan</li>

						</ul>
						<?php if ($transaction_user == NULL || $transaction_user->transaction_status == "Success" || $transaction_user->transaction_status == "Decline") : ?>
							<a href="<?php echo base_url('myaccount/package/order/' . $package->id); ?>" class="btn btn-info btn-block text-white">Beli Paket</a>

						<?php elseif ($transaction_user->transaction_status == "Pending") : ?>
							<a href="" class="btn btn-info btn-block text-white" data-toggle="modal" data-target="#exampleModal">Beli Paket</a>


						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

	</div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Maaf saat ini anda masih memiliki transaction yang belum di selesaikan! Silahkan selesaikan transaction anda atau batalkan transaction
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>