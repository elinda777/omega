<?php

	if(isset($_POST['tombol_ubah'])){
        $kd_kue = $_POST['kd_kue'];
        $nm_kue = $_POST['nm_kue'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];
        $foto_kue = $_FILES['foto_kue']['name'];
        $tipe_file = $_FILES['foto_kue']['type'];
        $tmp = $_FILES['foto_kue']['tmp_name'];

        if(empty($foto_kue))
        {
          $status_update1 = $kue->update($kd_kue,$nm_kue,$harga,$berat,$stok,$deskripsi);
          if($status_update1)
          {
            ?>
            <script type="text/javascript">
              alert('Data Berhasil Diubah');
              document.location='kuekering.php'
            </script>
            <?php
          }
          else
          {
            ?>
            <script type="text/javascript">
              alert('Data Gagal Diubah');
              document.location='kuekeringubah.php'
            </script>
            <?php
          }
        }
        else
        {
          $fotobaru = $kd_kue.'_'.$nm_kue.'_'.date('dmYHis').'.'.'jpg';
          // Set path folder tempat menyimpan fotonya
          $path = "uploads/".$fotobaru;
          // Proses upload
          $foto_kue = $fotobaru;

          if(move_uploaded_file($tmp, $path))
          {
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

            //proses untuk perubahan ukuran
            $im = imagecreatetruecolor($dst_width,$dst_height);
            imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

            //menyimpan gambar
              imagejpeg($im,$path);
              imagedestroy($im_src);
              imagedestroy($im);
            unlink("../uploads/".$data_kue['foto_kue']); // Hapus file foto sebelumnya yang ada di folder images
            $status_update2 = $kue->update_gambar($kd_kue,$nm_kue,$harga,$berat,$stok,$foto_kue,$deskripsi);
            if($status_update2)
            {
              ?>
              <script type="text/javascript">
                alert('Data Berhasil Diubah');
                document.location='kuekering.php'
              </script>
              <?php
            }
            else
            {
              ?>
              <script type="text/javascript">
                alert('Data Gagal Diubah');
                document.location='kuekeringubah.php'
              </script>
              <?php
            }
          }
        }
      }
?>

//form
  <form method="post"enctype="multipart/form-data">
    <div class="form-group row">
        <label for="foto_kue">Foto Kue</label>
			<div class="col-sm-7">
			<img src="uploads/<?php echo $data_kue['foto_kue']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
			<input type="file" name="foto_kue" class="form-control" id="foto_kue" onchange="readURL(this)">
			<img id="blah" src="#" alt="your image" />
			</div>
    </div>
  </form>
  
//js event onchange
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

        $("#foto_kue").change(function() {
        readURL(this);
        });
   </script>