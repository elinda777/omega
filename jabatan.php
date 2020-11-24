<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $jabatan = new jabatan();
    $data_jabatan = $jabatan->show();
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
          <h1><i class="fa fa-th-list"></i> Data Jabatan</h1>
          <p>Tabel untuk menampilkan data jabatan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="jabatan.php">Jabatan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="jabatantambah.php" class="btn btn-primary">Tambah Data Jabatan</a></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Jabatan</th>
                  <th>Nama Jabatan</th>
                  <th>Masa Bakti</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($data_jabatan as $row)
                {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kd_jabatan']."</td>";
                    echo "<td>".$row['nm_jabatan']."</td>";
                    echo "<td>".$row['masa_bakti']."</td>";
                    //echo "<td><img src='../identitas_plg/".$row['foto_ktp']."' width='50' height='80'></td>";
                    echo "<td><a class='btn btn-outline-secondary' href='jabatanubah.php?kd_jabatan=".$row['kd_jabatan']."'>Ubah</a>
                    <a class='btn btn-outline-primary' href='jabatanlihat.php?kd_jabatan=".$row['kd_jabatan']."'>Detail</a>
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
