<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();

    if(isset($_GET['kd_pengguna'])){
        $kode = $_GET['kd_pengguna'];
        $data_pengguna = $pengguna->get_by_id($kode);
    }
    else
    {
        header('Location: pengguna.php');
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
              <div class="col-md-12">
                  <table>
                    <div class="form-group">
                    <tr>
                      <td>Kode Pengguna</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $kode; ?></td>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_pengguna['username']; ?></td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_pengguna['password']; ?></td>
                    </tr>
                    <tr>
                      <td>Level</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_pengguna['level']; ?></td>
                    </tr>
                    </div>
                  </table>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <a class="btn btn-secondary" href="pengguna.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
