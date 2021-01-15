<?php if ($this->session->userdata('id')) : ?>


  <div class="container">
    <div class="account-page">
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Info Akun
            </div>
            <div class="card-body">
              Isi
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row">


            <div class="col-sm-6 col-md-6">
              <div class="card card-stats card-primary card-round">
                <div class="card-body">
                  <div class="row">
                    <div class="col-5">
                      <div class="display-4 text-center text-primary">
                        <i class="ri-honour-line"></i>
                      </div>
                    </div>
                    <div class="col col-stats">
                      <div class="numbers">
                        <p class="card-category">Iklan Aktif</p>
                        <h4 class="card-title">1,294</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
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
                        <h4 class="card-title">1303</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-6">
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
                        <p class="card-category">Iklan Tidak Aktif</p>
                        <h4 class="card-title">1303</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-6">
              <div class="card card-stats card-info card-round">
                <div class="card-body">
                  <div class="row">
                    <div class="col-5">
                      <div class="display-4 text-center text-warning">
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
  </div>



<?php else : ?>

  <?php redirect('auth'); ?>


<?php endif; ?>