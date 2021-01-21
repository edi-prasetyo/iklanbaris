<div class="container my-5">
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


	<div class="row my-3">
		<div class="col-md-6 mb-3">
			<div class="row">
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-user"></i> Profile
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-panel"></i>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-panel"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-panel"></i>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-panel"></i>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<i class="ti-panel"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>