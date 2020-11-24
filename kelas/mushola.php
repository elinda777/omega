<?php
class mushola
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
        $kodemus = "";
        $bulan = date('ym');

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_mushola, 6, 3)),0)+1 as kode from mushola");
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
            $kodemus = "M".$bulan."00".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodemus = "M".$bulan."0".$kode;
        }
        else if ($kode >=90 && $kode < 998)
        {
            $kodemus = "M".$bulan.$kode;
        }
        return $kodemus;
    }

    public function add_data($kd_mushola, $nm_mushola, $alamat_mushola)
    {
        $data = $this->db->prepare('INSERT INTO mushola (kd_mushola,nm_mushola,alamat_mushola) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_mushola);
        $data->bindParam(2, $nm_mushola);
        $data->bindParam(3, $alamat_mushola);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from mushola");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_mushola){
        $query = $this->db->prepare("SELECT * from mushola where kd_mushola=?");
        $query->bindParam(1, $kd_mushola);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_mushola)
    {
      $query = $this->db->prepare("SELECT a.kd_mushola from mushola a, pengguna b
        where a.kd_mushola=b.kd_pengguna and a.kd_mushola=?");
      $query->bindParam(1, $kd_mushola);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_mushola,$nm_mushola,$alamat_mushola){
        $query = $this->db->prepare('UPDATE mushola set nm_mushola=?,alamat_mushola=? where kd_mushola=?');

        $query->bindParam(1, $nm_mushola);
        $query->bindParam(2, $alamat_mushola);
        $query->bindParam(3, $kd_mushola);

        $query->execute();
        return $query->rowCount();
    }
}
?>
