<?php
    session_start();
    error_reporting(0);
    if(empty($_SESSION['id'])){
        header('location:login.php?error_login=1');
    }
?>
<?php include 'partials/header.php';?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <br/>  
              <div class="panel panel-default">
                  <div class="panel-heading">
                  Form Tambah Data Alternatif
                  </div>
                  <div class="panel-body">
                      <form method="post" action="model/do_insert_alternatif.php" enctype="multipart/form-data">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <div class="form-group">
                              <label for="nama">Nama Alternatif</label>
                              <input type="text" class="form-control" id="nama" name="nama">
                          </div>
                          <div class="form-group">
                              <label for="tgl">Tanggal / Bulan / Tahun</label>
                              <input type="date" class="form-control" id="tgl"/ name="tgl">
                          </div>
                          <div class="form-group">
                              <label for="foto">Foto</label>
                              <input type="file" id="foto" name="foto" />
                          </div>
                          <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <textarea class="form-control" rows="8" name="deskripsi"></textarea>
                          </div>
                          
                          <div class="form-group">
                              <button class="btn btn-primary">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php';?>