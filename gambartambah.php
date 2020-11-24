  <?php
  //Tambah data
  if(isset($_POST['tombol_tambah'])){
        $kd_kue = $_POST['kd_kue'];
        $nm_kue = $_POST['nm_kue'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];
        $foto_kue = $_FILES['foto_kue']['name'];
        $tipe_file = $_FILES['foto_kue']['type'];
        $tmp = $_FILES['foto_kue']['tmp_name'];

        $fotobaru = $kd_kue.'_'.$nm_kue.'_'.date('dmYHis').'.'.'jpg';
        // Set path folder tempat menyimpan fotonya
        $path = "uploads/".$fotobaru;
        // Proses upload
        $foto_kue = $fotobaru;

        $upload = move_uploaded_file($tmp, $path);

                //identitas file asli
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

        $adddata = $kue->add_data($kd_kue, $nm_kue, $harga, $berat, $stok, $foto_kue, $deskripsi);
        if($adddata){ ?>
          <script type="text/javascript">
            alert('Data Berhasil Disimpan');
            document.location='kuekering.php'
          </script>

          <?php
        }
        else {
          ?>
          <script type="text/javascript">
            alert('Data Gagal Disimpan');
            document.location='kuekeringtambah.php'
          </script>
          <?php
        }
    }
	?>
	
	
	
	//di elemen form
	<form method="post" enctype="multipart/form-data">
		<div class="form-group row">
            <label for="foto_kue">Foto Kue</label>
				<div">
				<input type="file" name="foto_kue" class="form-control" id="foto_kue" onchange="readURL(this)">
				<img id="blah" src="#" alt="your image" />
            </div>
        </div>
	</form>
	
	//event onchange="readURL(this)" untuk menampilkan gambar yg dipilih
	//image id=bleh -> digunakan untuk meletakkan gambar (kek dikasih tempat)
	
	
	//js buat event onchange="readURL(this)"
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
	