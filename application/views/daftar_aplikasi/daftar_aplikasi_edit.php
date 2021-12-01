  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mt-2">
            <h1 class="m-0 text-dark" style="text-shadow: 2px 2px 4px gray;"><i class="nav-icon fas fa-th"></i></i> <?php echo $judul; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home-lg-alt"></i> Home</a></li>
              <li class="breadcrumb-item"><a href=""><?php echo $judul; ?></a></li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.row -->
          <div class="animated fadeInLeft col-md-8">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-ballot"></i> Input <?php echo $judul; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>Daftar_Aplikasi/edit" enctype="multipart/form-data" method="post">

                <?php if ($this->session->flashdata('error')) { ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="fa fa-remove"></i>
                    </button>
                    <span style="text-align: left;"><?php echo $this->session->flashdata('error'); ?></span>
                  </div>
                <?php } ?>

                <div class="card-body">

                  <?php foreach($data_aplikasi as $f): ?>
                    <input type="hidden" name="urutan_lama" value="<?= $f->urutan_app ?>">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Urutan Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="urutan" value="<?= $f->urutan_app ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Nama Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nama" value="<?= $f->nama_app ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Deskripsi Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="deskripsi" value="<?= $f->deskripsi_app ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Icon Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="icon" value="<?= $f->icon_app ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Warna Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="warna" value="<?= $f->warna_app ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Jenis Link Aplikasi</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="jenis_link">
                        <option value="internal" <?php if($f->jenis_link_app == 'internal') {echo 'selected';}else{echo '';} ?> >Internal (cont. controller/method)</option>
                        <option value="eksternal" <?php if($f->jenis_link_app == 'eksternal') {echo 'selected';}else{echo '';} ?>>Eksternal (cont. https://www.kemdikbud.go.id/ atau ../kesiswaan)</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Link Aplikasi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="link" value="<?= $f->link_app ?>" required>
                    </div>
                  </div>
                  <?php endforeach ?>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right ml-3"><i class="fa fa-save"> </i> Simpan</button>
                  <a class="btn btn-danger float-right" href="<?php echo base_url(); ?>Daftar_Aplikasi"><i class="fa fa-undo"> </i> Kembali</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <div class="animated fadeInRight col-md-4">
            <div class="callout callout-info">
              <h4><span class="fa fa-info-circle text-danger"></span> Petunjuk dan Bantuan</h4>
              <ol>
                <li>
                  Isi <b><?php echo $judul; ?></b> selengkap dan sebenar mungkin.
                </li>
                <li>
                  Gunakan <i>button</i>
                  <button class="btn btn-xs btn-info"><span class="fa fa-save"></span> Simpan </button>
                  untuk menambahkan <b><?php echo $judul; ?></b>.
                </li>
              </ol>
              <p>
                Untuk <b>Keterangan</b> dan <b>Informasi</b> lebih lanjut silahkan hubungi <b>Bagian IT (Information &amp; Technology)</b>
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- /.content -->
  </div>


  <?php if ($this->session->flashdata('success')) {
        echo '<script>
                    toastr.options.timeOut = 2000;
                    toastr.success("' . $this->session->flashdata('success') . '");
                    </script>';
    } ?>

  <?php if ($this->session->flashdata('error')) {
        echo '<script>
       toastr.options.timeOut = 2000;
       toastr.error("' . $this->session->flashdata('error') . '");
       </script>';
    } ?>