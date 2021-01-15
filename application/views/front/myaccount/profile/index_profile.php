<div class="container my-5">
	<div class="row">

		<div class="col-md-4">
			<div class="card card-profile card-secondary">
				<div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
					<div class="profile-picture">
						<div class="avatar avatar-xl">
							<img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" alt="..." class="avatar-img rounded-circle img-fluid">
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="user-profile text-center">
						<div class="name"><?php echo $user->user_name; ?></div>
						<div class="job"><?php echo $user->user_phone; ?></div>
						<div class="desc"><?php echo $user->user_bio; ?></div>
						<div class="social-media">
							<a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
								<span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
							</a>
							<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
							</a>
							<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
							</a>
							<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
							</a>
						</div>
						<div class="view-profile">
							<a href="<?php echo base_url('myaccount/profile/update'); ?>" class="btn btn-secondary btn-block">Ubah Profile</a>
						</div>
					</div>
				</div>

			</div>
		</div>


		<div class="col-md-8">
			<div class="card card-with-nav">

				<?php
				//Notifikasi
				if ($this->session->flashdata('message')) {
					echo $this->session->flashdata('message');
				}
				?>
				<div class="card-header">
					<div class="row row-nav-line">
						<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
							<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Informasi</a> </li>
						</ul>
					</div>
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