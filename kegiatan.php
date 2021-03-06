<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $kegiatan = new kegiatan();
    $data_kegiatan = $kegiatan->show();
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
          <h1><i class="fa fa-th-list"></i> Data Kegiatan</h1>
          <p>Tabel untuk menampilkan data kegiatan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="kegiatan.php">Kegiatan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="kegiatantambah.php" class="btn btn-primary">Tambah Data Kegiatan</a></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kegiatan</th>
                  <th>Nama Kegiatan</th>
                  <th>Deskripsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($data_kegiatan as $row)
                {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kd_kegiatan']."</td>";
                    echo "<td>".$row['nm_kegiatan']."</td>";
                    echo "<td>".$row['deskripsi']."</td>";
                    //echo "<td><img src='../identitas_plg/".$row['foto_ktp']."' width='50' height='80'></td>";
                    echo "<td><a class='btn btn-outline-secondary' href='kegiatanubah.php?kd_kegiatan=".$row['kd_kegiatan']."'>Ubah</a>
                    <a class='btn btn-outline-primary' href='kegiatanlihat.php?kd_kegiatan=".$row['kd_kegiatan']."'>Detail</a>
                    </td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
    <?php
      include "linkjs.php";
    ?>
  </body>
</html>
