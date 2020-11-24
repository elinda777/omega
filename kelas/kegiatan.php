<?php
class kegiatan
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
        $kodekeg = "";
        $bulan = date('ym');

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_kegiatan, 6, 3)),0)+1 as kode from kegiatan");
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
            $kodekeg = "K".$bulan."00".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodekeg = "K".$bulan."0".$kode;
        }
        else if ($kode >=90 && $kode < 998)
        {
            $kodekeg = "K".$bulan.$kode;
        }
        return $kodekeg;
    }

    public function add_data($kd_kegiatan, $nm_kegiatan, $deskripsi)
    {
        $data = $this->db->prepare('INSERT INTO kegiatan (kd_kegiatan,nm_kegiatan,deskripsi) VALUES (?, ?, ?)');

        $data->bindParam(1, $kd_kegiatan);
        $data->bindParam(2, $nm_kegiatan);
        $data->bindParam(3, $deskripsi);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from kegiatan");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_kegiatan){
        $query = $this->db->prepare("SELECT * from kegiatan where kd_kegiatan=?");
        $query->bindParam(1, $kd_kegiatan);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_kegiatan)
    {
      $query = $this->db->prepare("SELECT a.kd_kegiatan from kegiatan a, pengguna b
        where a.kd_kegiatan=b.kd_pengguna and a.kd_kegiatan=?");
      $query->bindParam(1, $kd_kegiatan);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_kegiatan,$nm_kegiatan,$deskripsi){
        $query = $this->db->prepare('UPDATE kegiatan set nm_kegiatan=?,deskripsi=? where kd_kegiatan=?');

        $query->bindParam(1, $nm_kegiatan);
        $query->bindParam(2, $deskripsi);
        $query->bindParam(3, $kd_kegiatan);

        $query->execute();
        return $query->rowCount();
    }
}
?>
