<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();

    if(isset($_POST['tombol_tambah'])){
        $kd_pengguna = $pengguna->createCode();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $adddata = $pengguna->add_data($kd_pengguna, $username, $password, $level);
        if($adddata){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='pengguna.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='penggunatambah.php'
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
          <h1><i class="fa fa-th-list"></i>Tambah Data Pengguna</h1>
          <p>Form untuk menambahkan data pengguna</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="penggunatambah.php">Tambah Pengguna</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post">
            <div class="tile">
              <div class="form-group">
                <label class="control-label">Username</label>
                <input class="form-control" type="username" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <textarea class="form-control" rows="4" placeholder="Password" name="password"></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Level</label>
                <input class="form-control" type="level" name="level" placeholder="Level">
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit" name="tombol_tambah"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="pengguna.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
