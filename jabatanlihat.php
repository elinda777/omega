<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $jabatan = new jabatan();

    if(isset($_GET['kd_jabatan'])){
        $kode = $_GET['kd_jabatan'];
        $data_jabatan = $jabatan->get_by_id($kode);
    }
    else
    {
        header('Location: jabatan.php');
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
              <div class="col-md-12">
                  <table>
                    <div class="form-group">
                    <tr>
                      <td>Kode Jabatan</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $kode; ?></td>
                    </tr>
                    <tr>
                      <td>Nama Jabatan</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_jabatan['nm_jabatan']; ?></td>
                    </tr>
                    <tr>
                      <td>Masa Bakti</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_jabatan['masa_bakti']; ?></td>
                    </tr>
                    <tr>
                      <td>Tahun Mulai</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_jabatan['tahun_mulai']; ?></td>
                    </tr>
                    <tr>
                      <td>Tahun Akhir</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_jabatan['tahun_akhir']; ?></td>
                    </tr>
                    </div>
                  </table>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <a class="btn btn-secondary" href="jabatan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
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
