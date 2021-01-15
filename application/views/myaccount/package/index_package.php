<?php
//Notifikasi
if ($this->session->flashdata('message')) {
	echo $this->session->flashdata('message');}
?>
<div class="row justify-content-center align-items-center">
						<div class="col-md-3 pl-md-0">
							<div class="card card-pricing">
								<div class="card-header">
									<h4 class="card-title">Basic</h4>
									<div class="card-price">
										<span class="price">IDR. 50.000</span>
										<span class="text">/tahun</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li>
											<span class="name-specification">Jumlah Post Iklan</span>
											<span class="status-specification">50 Iklan</span>
										</li>
										<li>
											<span class="name-specification">Masa Aktif Post</span>
											<span class="status-specification">1 Tahun</span>
										</li>
										<li>
											<span class="name-specification">Masa Aktif Iklan</span>
											<span class="status-specification">1 Tahun</span>
										</li>

									</ul>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary btn-block"><b>Order</b></button>
								</div>
							</div>
						</div>
						<div class="col-md-3 pl-md-0 pr-md-0">
							<div class="card card-pricing card-pricing-focus card-primary">
								<div class="card-header">
									<h4 class="card-title">Professional</h4>
									<div class="card-price">
										<span class="price">IDR. 100.000</span>
										<span class="text">/tahun</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li>
											<span class="name-specification">Jumlah Iklan</span>
											<span class="status-specification">100 Iklan</span>
										</li>
                    <li>
											<span class="name-specification">Masa Aktif Post</span>
											<span class="status-specification">1 Tahun</span>
										</li>

										<li>
											<span class="name-specification">Masa Aktif Iklan</span>
											<span class="status-specification">1 tahun</span>
										</li>

									</ul>
								</div>
								<div class="card-footer">
									<button class="btn btn-light btn-block"><b>Order</b></button>
								</div>
							</div>
						</div>
						<div class="col-md-3 pr-md-0">
							<div class="card card-pricing">
								<div class="card-header">
									<h4 class="card-title">Unlimited</h4>
									<div class="card-price">
										<span class="price">IDR. 300.000</span>
										<span class="text">/Tahun</span>
									</div>
								</div>
								<div class="card-body">
									<ul class="specification-list">
										<li>
											<span class="name-specification">Jumlah Iklan</span>
											<span class="status-specification">Unlimited</span>
										</li>
										<li>
											<span class="name-specification">Masa Aktif Post</span>
											<span class="status-specification">1 Tahun</span>
										</li>
										<li>
											<span class="name-specification">Masa Aktif Iklan</span>
											<span class="status-specification">1 Tahun</span>
										</li>

									</ul>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary btn-block"><b>Order</b></button>
								</div>
							</div>
						</div>
					</div>
