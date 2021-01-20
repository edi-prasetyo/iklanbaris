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


				<div class="card-header">
					Info Profile
				</div>

				<div class="card-body">

					<?php
					//Notifikasi
					if ($this->session->flashdata('message')) {
						echo $this->session->flashdata('message');
					}
					?>

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