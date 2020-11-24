<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $mushola = new mushola();

    if(isset($_GET['kd_mushola'])){
        $kode = $_GET['kd_mushola'];
        $data_mushola = $mushola->get_by_id($kode);
    }
    else
    {
        header('Location: mushola.php');
    }

    if(isset($_POST['tombol_ubah'])){
        $kd_mushola = $kode;
        $nm_mushola = $_POST['nm_mushola']; 
        $alamat_mushola = $_POST['alamat_mushola'];

        $status_update = $mushola->update($kd_mushola, $nm_mushola, $alamat_mushola);
        if($status_update){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='mushola.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='musholaubah.php'
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
          <h1><i class="fa fa-th-list"></i>Tambah Data Mushola</h1>
          <p>Form untuk menambahkan data mushola</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="musholaubah.php">Tambah Mushola</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post">
            <div class="tile">

              <div class="form-group">
                <label class="control-label">Nama Mushola</label>
                <input class="form-control" type="nm_mushola" name="nm_mushola" value="<?php echo $data_mushola['nm_mushola']; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Alamat Mushola</label>
                <textarea class="form-control" rows="4" name="alamat_mushola"><?php echo $data_mushola['alamat_mushola']; ?></textarea>
              </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit" name="tombol_ubah"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ubah</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="mushola.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
