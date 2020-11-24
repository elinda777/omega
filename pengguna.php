<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $pengguna = new pengguna();
    $data_pengguna = $pengguna->show();
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
          <h1><i class="fa fa-th-list"></i> Data Pengguna</h1>
          <p>Tabel untuk menampilkan data pengguna</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="kegiatan.php">Pengguna</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="penggunatambah.php" class="btn btn-primary">Tambah Data Pengguna</a></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Pengguna</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($data_pengguna as $row)
                {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kd_pengguna']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<td>".$row['level']."</td>";
                    //echo "<td><img src='../identitas_plg/".$row['foto_ktp']."' width='50' height='80'></td>";
                    echo "<td><a class='btn btn-outline-secondary' href='penggunaubah.php?kd_pengguna=".$row['kd_pengguna']."'>Ubah</a>
                    <a class='btn btn-outline-primary' href='penggunalihat.php?kd_pengguna=".$row['kd_pengguna']."'>Detail</a>
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
