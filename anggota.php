<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $anggota = new anggota();
    $data_anggota = $anggota->show();
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
          <h1><i class="fa fa-th-list"></i> Data Anggota</h1>
          <p>Tabel untuk menampilkan data anggota</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="anggota.php">Anggota</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="anggotatambah.php" class="btn btn-primary">Tambah Data Anggota</a></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Anggota</th>
                  <th>Nama Anggota</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($data_anggota as $row)
                {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kd_anggota']."</td>";
                    echo "<td>".$row['nm_anggota']."</td>";
                    echo "<td>".$row['alamat']."</td>";
                    echo "<td>".$row['telepon']."</td>";
                    //echo "<td><img src='../identitas_plg/".$row['foto_ktp']."' width='50' height='80'></td>";
                    echo "<td><a class='btn btn-outline-secondary' href='anggotaubah.php?kd_anggota=".$row['kd_anggota']."'>Ubah</a>
                    <a class='btn btn-outline-primary' href='anggotalihat.php?kd_anggota=".$row['kd_anggota']."'>Detail</a>
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
