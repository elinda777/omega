<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $jabatan = new jabatan();

    if(isset($_POST['tombol_tambah'])){
        $kd_jabatan = $jabatan->createCode();
        $nm_jabatan = $_POST['nm_jabatan'];
        $masa_bakti = $_POST['masa_bakti'];
        $adddata = $jabatan->add_data($kd_jabatan, $nm_jabatan, $masa_bakti);
        if($adddata){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='jabatan.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='jabatantambah.php'
          </script>
          <?php
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
     <?php include "head.php"; ?>
  </head>
  <body class="app sidebar-mini">
    <?php
      include "navbar.php";
      include "sidebar.php";
    ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Tambah Data Jabatan</h1>
          <p>Form untuk menambahkan data jabatan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="jabatantambah.php">Tambah Jabatan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post">
            <div class="tile">
              <div class="form-group">
                <label class="control-label">Nama Jabatan</label>
                <input class="form-control" type="nm_jabatan" name="nm_jabatan" placeholder="Nama Jabatan">
              </div>
              <div class="form-group">
                <label class="control-label">Masa Bakti</label>
                <input class="form-control" type="masa_bakti" name="masa_bakti" placeholder="Masa Bakti">
              </div>
              <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit" name="tombol_tambah"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="jabatan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
    <?php
      include "linkjs.php";
    ?>
  </body>
</html>
