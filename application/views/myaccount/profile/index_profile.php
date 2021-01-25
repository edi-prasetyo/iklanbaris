<div class="container my-5">

	<?php
	//Notifikasi
	if ($this->session->flashdata('message')) {
		echo $this->session->flashdata('message');
	}
	?>
	<div class="row">

		<div class="col-md-4">
			<div class="card mb-3">

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
			<div class="row">
				<div class="col-sm-6 col-md-6 mb-2">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="display-4 text-center text-primary">
										<i class="ri-store-2-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Total Iklan</p>
										<h4 class="card-title"><?php echo count($iklan_saya); ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 mb-2">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="display-4 text-center text-success">
										<i class="ri-check-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Iklan Aktif</p>
										<h4 class="card-title"><?php echo count($iklan_active); ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-6 mb-2">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="display-4 text-center text-warning">
										<i class="ri-folder-warning-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Iklan Pending</p>
										<h4 class="card-title"><?php echo count($iklan_pending); ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-6 mb-2">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="display-4 text-center text-info">
										<i class="ri-vip-crown-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Paket Premium</p>
										<h4 class="card-title"><?php echo $user->premium_count; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">


				<div class="card-header">
					Info Profile
				</div>

				<div class="card-body">



					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Nama Lengkap</span>
							<?php echo $user->user_name; ?>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Username</span>
							<?php echo $user->username; ?>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Email</span>
							<?php echo $user->email; ?>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Nomor Handphone</span>
							<?php echo $user->user_phone; ?>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Whatsapp</span>
							<?php if ($user->user_whatsapp == 1) : ?>
								<span class="badge badge-success">Aktif</span>
							<?php else : ?>
								<span class="badge badge-danger">Tidak Aktif</span>
							<?php endif; ?>

						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<span class="font-weight-bold">Alamat</span>

							<?php echo $user->user_address; ?>
						</li>
					</ul>
					<hr>


					<div class="font-weight-bold">Biografi</div>

					<?php echo $user->user_bio; ?>


				</div>
			</div>
		</div>
	</div>

</div>