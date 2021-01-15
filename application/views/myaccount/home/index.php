<div class="container my-5">
	<div class="row">

		<div class="col-md-4 mb-2">
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
			<div class="row">


				<div class="col-sm-6 col-md-6 mb-2">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="display-4 text-center text-success">
										<i class="ri-store-2-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Iklan Aktif</p>
										<h4 class="card-title">13</h4>
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
										<h4 class="card-title">1</h4>
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
										<h4 class="card-title">0</h4>
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
									<div class="display-4 text-center text-danger">
										<i class="ri-mail-line"></i>
									</div>
								</div>
								<div class="col col-stats">
									<div class="numbers">
										<p class="card-category">Pesan</p>
										<h4 class="card-title">1303</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>