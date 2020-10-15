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
                  Form Edit Alternatif
                  </div>
                  <div class="panel-body">
                      <form method="post" action="model/do_update_alternatif.php" enctype="multipart/form-data">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <?php foreach ($db->select('*','alternatif')->where('id_alternatif='.$_GET['id'])->get() as $val): ?>
                              <input type="hidden" name="id_alternatif" value="<?= $val['id_alternatif']?>">
                              <div class="form-group">
                                  <label for="nama">Nama Alternatif</label>
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $val['nama']?>">
                              </div>
                              <div class="form-group">
                                  <label for="tgl">Tanggal / Bulan / Tahun</label>
                                  <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $val['tgl_didirikan']?>">
                              </div>
                              <div class="form-group">
                                  <label for="foto">Foto</label>
                                  <input type="file" id="foto" name="foto" />
                              </div>
                              <div class="form-group">
                                  <label for="deskripsi">Deskripsi</label>
                                  <textarea class="form-control" rows="8" name="deskripsi"> <?= $val['deskripsi'] ?></textarea>
                              </div>
                              <div class="form-group">
                                  <button class="btn btn-primary">Simpan</button>
                              </div>
                          <?php endforeach ?>
                      </form>
                  </div>
              </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php';?>