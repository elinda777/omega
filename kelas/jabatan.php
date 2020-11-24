<?php
class jabatan
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "ipnu";
        $username = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function createCode()
    {
        $kode = 0;
        $kodejab = "";
        $bulan = date('ym');

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_jabatan, 6, 3)),0)+1 as kode from jabatan");
        $query ->execute();
        $data = $query->fetch();

        if ($data['kode']=="")
        {
            $kode=0;
        }
        else
        {
            $kode = $data['kode'];
        }

        if ($kode > 0 && $kode < 9)
        {
            $kodejab = "J".$bulan."00".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodejab = "J".$bulan."0".$kode;
        }
        else if ($kode >=90 && $kode < 998)
        {
            $kodejab = "J".$bulan.$kode;
        }
        return $kodejab;
    }

    public function add_data($kd_jabatan, $nm_jabatan, $masa_bakti)
    {
        $data = $this->db->prepare('INSERT INTO jabatan (kd_jabatan,nm_jabatan,masa_bakti) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_jabatan);
        $data->bindParam(2, $nm_jabatan);
        $data->bindParam(3, $masa_bakti);
        
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from jabatan");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_jabatan){
        $query = $this->db->prepare("SELECT * from jabatan where kd_jabatan=?");
        $query->bindParam(1, $kd_jabatan);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_jabatan)
    {
      $query = $this->db->prepare("SELECT a.kd_jabatan from jabatan a, pengguna b
        where a.kd_jabatan=b.kd_pengguna and a.kd_jabatan=?");
      $query->bindParam(1, $kd_jabatan);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_jabatan,$nm_jabatan,$masa_bakti){ //disini kan ada 2 parameter bebs
        $query = $this->db->prepare('UPDATE jabatan set nm_jabatan=?, masa_bakti=? where kd_jabatan=?');

        $query->bindParam(1, $nm_jabatan);
        $query->bindParam(2, $masa_bakti);
        $query->bindParam(3, $kd_jabatan); //jangan lupa bismilah dulu sblm nge run biar berkah
        $query->execute();
        return $query->rowCount();
    }
}
?>
