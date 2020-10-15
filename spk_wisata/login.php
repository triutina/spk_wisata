<?php include 'partials/header.php';?>

<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php if ($_GET['error_login']==1): ?>
                         <div class="alert alert-danger">
                            Anda Harus Login Terlebih Dahulu !
                        </div>
                    <?php endif ?>
                    <form method="post" action="model/do_login.php">
                    	<label>Enter Username : </label>
                        <input type="text" name="username" class="form-control" />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control" />
                        <hr />
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Login </button>&nbsp;
                   	</form>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>SELAMAT DATANG DI SISTEM PENDUKUNG KEPUTUSAN
                        <br/>PEMILIHAN DESTINASI WISATA DI JAKARTA
                        <br/>DENGAN MENGGUNAKAN METODE SIMPLE ADDITIVE WEIGHTING </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'partials/footer.php';?>