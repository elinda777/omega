<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $kegiatan = new kegiatan();

    if(isset($_GET['kd_kegiatan'])){
        $kode = $_GET['kd_kegiatan'];
        $data_kegiatan = $kegiatan->get_by_id($kode);
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
          <h1><i class="fa fa-th-list"></i>Tambah Data Kegiatan</h1>
          <p>Form untuk menambahkan data kegiatan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="kegiatantambah.php">Tambah Kegiatan</a></li>
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
                      <td>Kode Kegiatan</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $kode; ?></td>
                    </tr>
                    <tr>
                      <td>Nama Kegiatan</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_kegiatan['nm_kegiatan']; ?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $data_kegiatan['deskripsi']; ?></td>
                    </tr>
                    </div>
                  </table>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <a class="btn btn-secondary" href="kegiatan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
