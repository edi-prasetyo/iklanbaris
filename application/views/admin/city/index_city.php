
<div class="row">

<div class="col-md-4">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $province->province_name;?></h6>

        </div>
        <div class="card-body">

          <?php
          //Form Open
          echo form_open(base_url('admin/province/city/'.$province->id));
          ?>

          <div class="form-group">
             <label>Nama Kota</label>
               <input type="text" class="form-control" name="city_name" placeholder="Nama Kota" required="required">
          </div>


          <div class="form-group">
               <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
          </div>


         <?php
         //Form Close
         echo form_close();
          ?>

        </div>
      </div>
    </div>


    <div class="col-md-8">
        <div class="card">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List kota <?php echo $province->province_name;?></h6>

            </div>
            <div class="card-body">

              <?php
              //Notifikasi
              if ($this->session->flashdata('message')) {
                  echo '<div class="alert alert-success">';
                  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>';
                  echo $this->session->flashdata('message');
                  echo '</div>';
              }
              echo validation_errors('<div class="alert alert-warning">', '</div>');

              ?>

              <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th width="5%">No</th>
                              <th>Nama Provinsi</th>
                              <th>Permalink</th>

                              <th width="25%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1;
                          foreach ($city as $city) : ?>
                              <tr>
                                  <td class="text-info"><?php echo $no; ?></td>
                                  <td><?php echo $city->city_name; ?></td>
                                  <td><?php echo $city->city_slug; ?></td>
                                  <td>
                                      <a href="<?php echo base_url('admin/province/delete_city/'.$city->id);?>" class="btn btn-sm btn-warning"><i class="ti-trash"></i> Delete</a>
                                      <?php include "update_city.php"; ?>

                                  </td>
                              </tr>
                          <?php $no++;
                          endforeach; ?>

                      </tbody>
                  </table>
              </div>

            </div>
          </div>
        </div>


  </div>
