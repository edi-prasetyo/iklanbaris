

	  <div class="row justify-content-md-center">

				<?php
				echo form_open_multipart('myaccount/property/update/' .$property->id);
				?>


				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header order-success">
								<i class="ri-community-line"></i> Basic Information

							</div>


							<div class="card-body">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label>Judul Property <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_title" placeholder="Judul Property" value="<?php echo $property->property_title; ?>"  >

										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Jenis Market <span class="text-danger">*</span><?php echo form_error('property_market', '<small class="text-danger">', '</small>'); ?>
											</label>
											<select name="property_market" class="form-control custom-select">
												<option></option>
												<option value="Dijual" <?php if ($property->property_market == 'Dijual') {echo 'selected';}?>>Dijual</option>
												<option value="Disewa">Disewa</option>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Tipe <span class="text-danger">*</span> <?php echo form_error('type_id', '<small class="text-danger">', '</small>'); ?>
											</label>
											<select name="type_id" class="form-control custom-select">
												<option><option>
												<?php foreach ($type as $type):?>
												<option value="<?php echo $type->id;?>" <?php if ($property->type_id == $type->id) {
                                                                        echo 'selected';} ?>><?php echo $type->type_name;?></option>
											<?php endforeach;?>

											</select>
										</div>
									</div>



									<div class="col-md-4">
										<div class="form-group">
											<label>Luas Tanah <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_surfacearea" placeholder="Luas Tanah" value="<?php echo $property->property_surfacearea; ?>">

										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Luas Bangunan <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_buildingarea" placeholder="Luas Bangunan" value="<?php echo $property->property_buildingarea; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Jumlah lantai <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_floor" placeholder="Jumlah Lantai" value="<?php echo $property->property_floor; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Kamar Tidur <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_bed" placeholder="Jumlah Kamar Tidur" value="<?php echo $property->property_bed; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Kamar Mandi <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_bath" placeholder="Jumlah Kamar Mandi" value="<?php echo $property->property_bath; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Kamar Pembantu <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_bed_maid" placeholder="Jumlah Kamar Pembantu" value="<?php echo $property->property_bed_maid; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Kamar Mandi Pembantu <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_bath_maid" placeholder="Jumlah Kamar Mandi Pembantu" value="<?php echo $property->property_bath_maid; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Daya Listrik <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_electrical" placeholder="Daya Listrik" value="<?php echo $property->property_electrical; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Garasi <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_garage" placeholder="Jumlah garasi" value="<?php echo $property->property_garage; ?>">
											<?php echo form_error('property_garage', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Sertifikat <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_certificate" placeholder="Tipe Sertifikat" value="<?php echo $property->property_certificate; ?>">
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="card">
							<div class="card-header order-success">
								<i class="ri-image-edit-line"></i> Informasi Property
							</div>
							<div class="card-body">
								<div class="row">

									<div class="col-md-8">
										<div class="form-group">
											<label>Harga Property<span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_price" placeholder="Harga Property" value="<?php echo $property->property_price; ?>">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Nego <span class="text-danger">*
											</label>
											<select name="property_negotiable" class="form-control custom-select">
												<option></option>
												<option value="Nego"<?php if ($property->property_negotiable == 'Nego') {echo 'selected';}?>>Nego</option>
												<option value="Fix">Fix</option>
											</select>
										</div>
									</div>

									<div class="col-md-12">
									<div class="form-group">
										<label>Deskripsi <span class="text-danger">*</span></label>
										<textarea id="summernote" name="property_desc"><?php echo $property->property_desc; ?></textarea>
									</div>
								</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Kata Kunci<span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_keywords" placeholder="Kata Kunci" value="<?php echo $property->property_keywords; ?>">
										</div>
									</div>


								</div>
							</div>
						</div>


					</div>


						<div class="col-md-4">
						<div class="card">
							<div class="card-header order-success">
								<i class="ri-image-edit-line"></i> Upload Gambar
							</div>
							<div class="card-body">
								<div class="form-group">
									<input type="file" name="property_image" >
                  <img class="img-fluid" src="<?php echo base_url('assets/img/property/'.$property->property_image);?>">
                  <br><br><a class="btn btn-primary" href="">Lihat Semua Gambar</a>
								</div>
							</div>
						</div>



						<div class="card">
							<div class="card-header order-success">
								<i class="ri-map-pin-line"></i> Lokasi
							</div>
							<div class="card-body">
								<div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label>Provinsi <span class="text-danger">*</span><?php echo form_error('province_id', '<small class="text-danger">', '</small>'); ?>
											</label>
											<select name="province_id" id="province1111" class="form-control custom-select">
												<option></option>
												<?php foreach ($province as $province) :?>

												<option value="<?php echo $province->id;?>" <?php if ($property->province_id == $province->id) {
                                                                        echo 'selected';} ?>><?php echo $province->province_name;?></option>
											<?php endforeach;?>

											</select>
										</div>
									</div>


									<div class="col-md-12">
										<div class="form-group">
											<label>Kota <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_city" placeholder="Kota" value="<?php echo $property->property_city; ?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Alamat <span class="text-danger">*</span>
											</label>
											<input type="text" class="form-control" name="property_address" placeholder="Alamat" value="<?php echo $property->property_address; ?>">
											<?php echo form_error('property_address', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>
















								</div>
							</div>
						</div>

						</div>


				<div class="col-md-8">

				<button class="btn btn-primary btn-lg btn-block" type="submit"> Update Iklan </button>

					</div>










				</div>




			<?php echo form_close();?>
		</div>




















</body>
</html>
