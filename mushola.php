<?php
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $mushola = new mushola();
    $data_mushola = $mushola->show();
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
          <h1><i class="fa fa-th-list"></i> Data Mushola</h1>
          <p>Tabel untuk menampilkan data mushola</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active"><a href="mushola.php">Mushola</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="musholatambah.php" class="btn btn-primary">Tambah Data Mushola</a></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Mushola</th>
                  <th>Nama Mushola</th>
                  <th>Alamat Mushola</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach($data_mushola as $row)
                {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row['kd_mushola']."</td>";
                    echo "<td>".substr($row['nm_mushola'], 0, 15)."</td>";
                    echo "<td>".substr($row['alamat_mushola'], 0, 20)."</td>";
                    //echo "<td><img src='../identitas_plg/".$row['foto_ktp']."' width='50' height='80'></td>";
                    echo "<td><a class='btn btn-outline-secondary' href='musholaubah.php?kd_mushola=".$row['kd_mushola']."'>Ubah</a>
                    <a class='btn btn-outline-primary' href='musholalihat.php?kd_mushola=".$row['kd_mushola']."'>Detail</a>
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
