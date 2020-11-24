<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $anggota = new anggota();

    if(isset($_GET['kd_anggota'])){
        $kode = $_GET['kd_anggota'];
        $data_anggota = $anggota->get_by_id($kode);
    }
    else
    {
        header('Location: anggota.php');
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
          <h1><i class="fa fa-th-list"></i>Tambah Data Anggota</h1>
          <p>Form untuk menambahkan data anggota</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="anggotatambah.php">Tambah Anggota</a></li>
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
                      <td>Kode Anggota</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $kode; ?></td>
                    </tr>
                    <tr>
                      <td>Nama Anggota</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_anggota['nm_anggota']; ?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_anggota['alamat']; ?></td>
                    </tr>
                    <tr>
                      <td>Telepon</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_anggota['telepon']; ?></td>
                    </tr>
                    </div>
                  </table>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <a class="btn btn-secondary" href="anggota.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
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
