<div class="container my-5">
	<div class="row">

		<div class="col-md-4">
			<div class="card">

				<div class="card-body">
					<div class="profile-picture">
						<div class="img-avatar">
							<img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" alt="..." class="img-fluid">
						</div>
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><?php echo $user->user_name; ?></li>
					<li class="list-group-item"><?php echo $user->user_phone; ?></li>
					<li class="list-group-item"><?php echo $user->user_address; ?></li>
					<li class="list-group-item"> <a href="<?php echo base_url('myaccount/profile/update'); ?>" class="btn btn-info text-white btn-block">Ubah Profile</a>
					</li>
				</ul>


			</div>
		</div>


		<div class="col-md-8">
			<div class="card">

				<?php
				//Notifikasi
				if ($this->session->flashdata('message')) {
					echo $this->session->flashdata('message');
				}
				?>
				<div class="card-header">
					Info Profile
				</div>

				<div class="card-body">
					<div class="row mt-3">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Nama Lengkap</label>
								<?php echo $user->user_name; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Email</label>
								<?php echo $user->email; ?>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-4">
							<div class="form-group form-group-default">
								<label>Agent Property</label>
								<?php echo $user->company_name; ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-group-default">
								<label>Nomor HP</label>
								<?php echo $user->user_phone; ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-group-default">
								<label>Whatsapp</label>
								<?php echo $user->user_whatsapp; ?>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12">
							<div class="form-group form-group-default">
								<label>Alamat</label>
								<?php echo $user->user_address; ?>
							</div>
						</div>
					</div>
					<div class="row mt-3 mb-1">
						<div class="col-md-12">
							<div class="form-group form-group-default">
								<label>Biografi</label>
								<?php echo $user->user_bio; ?>
							</div>
						</div>
					</div>
					<div class="text-right mt-3 mb-3">

					</div>

				</div>
			</div>
		</div>
	</div>

</div>