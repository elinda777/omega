<?php
class anggota
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
        $kodeang = "";
        $bulan = date('ym');

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_anggota, 6, 3)),0)+1 as kode from anggota");
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
            $kodeang = "A".$bulan."00".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodeang = "A".$bulan."0".$kode;
        }
        else if ($kode >=90 && $kode < 998)
        {
            $kodeang = "A".$bulan.$kode;
        }
        return $kodeang;
    }

    public function add_data($kd_anggota, $nm_anggota, $alamat, $telepon, $foto)
    {
        $data = $this->db->prepare('INSERT INTO anggota (kd_anggota,nm_anggota,alamat,telepon,foto) VALUES (?, ?, ?, ?, ?)');

        $data->bindParam(1, $kd_anggota);
        $data->bindParam(2, $nm_anggota);
        $data->bindParam(3, $alamat);
        $data->bindParam(4, $telepon);
        $data->bindParam(5, $foto);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from anggota");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_anggota){
        $query = $this->db->prepare("SELECT * from anggota where kd_anggota=?");
        $query->bindParam(1, $kd_anggota);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_anggota)
    {
      $query = $this->db->prepare("SELECT a.kd_anggota from anggota a, pengguna b
        where a.kd_anggota=b.kd_pengguna and a.kd_anggota=?");
      $query->bindParam(1, $kd_anggota);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_anggota,$nm_anggota,$alamat,$telepon,$foto){
        $query = $this->db->prepare('UPDATE anggota set nm_anggota=?,alamat=?,telepon=?,foto=? where kd_anggota=?');

        $query->bindParam(1, $nm_anggota);
        $query->bindParam(2, $alamat);
        $query->bindParam(3, $telepon);
        $query->bindParam(4, $foto);
        $query->bindParam(5, $kd_anggota);

        $query->execute();
        return $query->rowCount();
    }
      
}
?>
