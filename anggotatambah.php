<?php
    error_reporting();
    //autoload class
    spl_autoload_register(function ($class_name) {
      include 'kelas/'.$class_name.'.php';
    });

    $anggota = new anggota();

    if(isset($_POST['tombol_tambah'])){
        $kd_anggota = $anggota->createCode();
        $nm_anggota = $_POST['nm_anggota'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $foto = $_FILES['foto']['name'];
        $tipe_file = $_FILES['foto']['type'];
        $tmp = $_FILES['foto']['tmp_name'];

        $fotobaru = $kd_anggota.'_'.$nm_anggota.'_'.date('dmYHis').'.'.'jpg';
        // Set path folder tempat menyimpan fotonya
        $path = "uploads/".$fotobaru;
        // Proses upload
        $foto = $fotobaru;

        $upload = move_uploaded_file($tmp, $path);


        if($tipe_file == "image/jpeg")
        {
          $im_src = imagecreatefromjpeg($path);
          $src_width = imageSX($im_src);
          $src_height= imageSY($im_src);
        }
        else if($tipe_file == "image/png")
        {
          $im_src = imagecreatefrompng($path);
          $src_width = imageSX($im_src);
          $src_height= imageSY($im_src);
        }

        //Simpan dalam ukuran medium 320px
        $dst_width = 400;
        $dst_height = 300;

        $im = imagecreatetruecolor($dst_width,$dst_height);
        imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

        //menyimpan gambar
          imagejpeg($im,$path);
          imagedestroy($im_src);
          imagedestroy($im);

        $adddata = $anggota->add_data($kd_anggota, $nm_anggota, $alamat, $telepon, $foto);
        if($adddata){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='anggota.php'
          </script>
          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='anggotatambah.php'
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
          <form method="post" enctype="multipart/form-data">
            <div class="tile">
              <div class="form-group">
                <label class="control-label">Nama Anggota</label>
                <input class="form-control" type="nm_anggota" name="nm_anggota" placeholder="Nama Anggota">
              </div>
              <div class="form-group">
                <label class="control-label">Alamat</label>
                <textarea class="form-control" rows="4" placeholder="Alamat" name="alamat"></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Telepon</label>
                <input class="form-control" type="telepon" name="telepon" placeholder="Telepon">
              </div>
              <div class="form-group row">
                      <label for="foto">Foto Anggota</label>
          				<div">
          				<input type="file" name="foto" class="form-control" id="foto" onchange="readURL(this)">
          				<img id="blah" src="#" alt="your image" />
                      </div>
                  </div>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit" name="tombol_tambah"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="anggota.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
  <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

        $("#foto").change(function() {
        readURL(this);
        });
   </script>

</html>
