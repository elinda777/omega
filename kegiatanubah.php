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
        header('Location: kegiatan.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_kegiatan = $kode;
        $nm_kegiatan = $_POST['nm_kegiatan'];
        $deskripsi = $_POST['deskripsi'];

        $status_update = $kegiatan->update($kd_kegiatan, $nm_kegiatan, $deskripsi);
        if($status_update){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='kegiatan.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='kegiatanubah.php'
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

              <div class="form-group">
                <label class="control-label">Nama Kegiatan</label>
                <input class="form-control" type="nm_kegiatan" name="nm_kegiatan" value="<?php echo $data_kegiatan['nm_kegiatan']; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Deskripsi</label>
                <textarea class="form-control" rows="4" name="deskripsi"><?php echo $data_kegiatan['deskripsi']; ?></textarea>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit" name="tombol_ubah"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ubah</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="kegiatan.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
