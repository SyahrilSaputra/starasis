  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header animated fadeInDown">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <div class="card card-info card-outline">
              <center><h1 class="m-0 text-dark" style="text-shadow: 2px 2px 4px #17a2b8;"><i class="fal fa-desktop-alt mt-2"></i> <br>DAFTAR SISTEM AKADEMIK MADRASAH (SIAKAD)</h1> </center>
              <hr>
                <div class="row ml-2 mr-2">

          <?php foreach ($daftar_aplikasi as $field): ?>
          <div class="col-12 col-sm-6 col-md-3">
            <?php if ($field->jenis_link_app == 'eksternal'){ ?>
            <a href="<?= $field->link_app ?>" target="_blank" style="color:black;">
            <?php }else{ ?>
            <a href="<?= base_url($field->link_app) ?>" target="_blank" style="color:black;">
            <?php } ?>
            <div class="info-box">
              <span class="info-box-icon bg-<?= $field->warna_app ?> elevation-1"><i class="fas <?= $field->icon_app ?>"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-<?= $field->warna_app ?>" ><b><?= $field->nama_app ?></b></span>
                <font size="1" style="text-shadow: 2px 2px 4px #827e7e"><?= $field->deskripsi_app ?></font>
              </div>
            </div></a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <?php endforeach ?>

        </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="animated fadeInUp content">
      <div class="container-fluid">
        <!-- Info boxes -->
        
        <!-- /.row -->
        <div class="row">
           <!-- /.col -->
          <div class="col-md-6">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title text-info" ><i class="fas fa-image "></i> SLIDESHOW</h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
                <?php
                 $slideshow = $this->db->query("SELECT * FROM mst_slideshow ORDER BY id_slideshow DESC");
                 $i = 0;
                 ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                  <?php foreach($slideshow->result_array() as $data_slideshow) {  
                       if($i == 1) {
                        $active = 'active';
                      } else {
                        $active = "";
                      }
                      ?>
                      
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></li>
                    <?php $i++; } ?>
                  </ol>
                  <div class="carousel-inner">
                    <?php
                   
                    $no  = 1;
                    foreach($slideshow->result_array() as $data_slideshow) { 
                      if($no == 1) {
                        $active = 'active';
                      } else {
                        $active = "";
                      }
                      ?>
                      <div class="carousel-item <?php echo $active; ?>">
                        <img class="d-block w-100" src="<?php echo base_url().'upload/'.$data_slideshow['file_gambar']; ?>" >
                      </div>
                    <?php $no++; } ?>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title text-info"><i class="fa fa-history"></i> Log Aktivitas</h3>
                <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      
                    </div>
              </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr class="bg-teal">
                      <th style="width: 10px">No.</th>
                      <th>IP</th>
                      <th>Nama</th>
                      <th>Level</th>
                      <th style="width: 40px">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; foreach($log_login->result_array() as $data) { ?>
                    <tr class="text-xs">
                      <td><?php echo $no; ?></td>
                      <td class="text-danger"><?php echo $data['ipaddress']; ?></td>
                      <td><?php echo $data['username']; ?></td>
                      <td class="text-cyan" ><?php echo $data['hak_akses']; ?></td>
                      <td><div style="width:140px"><?php echo date("d-m-Y H:i:s",strtotime($data['tanggal'])); ?></div></td>
                    </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
         
        </div>

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 