<?php
class pengguna
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
        $kodepeng = "";
        $bulan = date('ym');

        $query = $this->db->prepare("SELECT ifnull(max(substring(kd_pengguna, 6, 3)),0)+1 as kode from pengguna");
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
            $kodepeng = "P".$bulan."00".$kode;
        }
        else if ($kode >=9 && $kode < 99)
        {
            $kodepeng = "P".$bulan."0".$kode;
        }
        else if ($kode >=90 && $kode < 998)
        {
            $kodepeng = "P".$bulan.$kode;
        }
        return $kodepeng;
    }

    public function add_data($kd_pengguna, $username, $password, $level)
    {
        $data = $this->db->prepare('INSERT INTO pengguna (kd_pengguna,username,password,level) VALUES (?, ?, ?, ?)');

        $data->bindParam(1, $kd_pengguna);
        $data->bindParam(2, $username);
        $data->bindParam(3, $password);
        $data->bindParam(4, $level);
        $data->execute();
        return $data->rowCount();
    }
    public function show()
    {
        $query = $this->db->prepare("SELECT * from pengguna");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function get_by_id($kd_pengguna){
        $query = $this->db->prepare("SELECT * from pengguna where kd_pengguna=?");
        $query->bindParam(1, $kd_pengguna);
        $query->execute();
        return $query->fetch();
    }

    public function get_kode($kd_pengguna)
    {
      $query = $this->db->prepare("SELECT a.kd_pengguna from pengguna a, pengguna b
        where a.kd_pengguna=b.kd_pengguna and a.kd_pengguna=?");
      $query->bindParam(1, $kd_pengguna);
      $query->execute();
      return $query->fetch();
    }

    public function update($kd_pengguna,$username,$password,$level){ //disini kan ada 2 parameter bebs
        $query = $this->db->prepare('UPDATE pengguna set username=?, password=?, level=? where kd_pengguna=?');

        $query->bindParam(1, $username);
        $query->bindParam(2, $password);
        $query->bindParam(3, $level);
        $query->bindParam(4, $kd_pengguna); //jangan lupa bismilah dulu sblm nge run biar berkah
        $query->execute();
        return $query->rowCount();
    }

    public function get_by_userpass($username,$password){ //disini kan ada 2 parameter bebs
        $query = $this->db->prepare("SELECT * FROM pengguna where username=? and password=?");

        $query->bindParam(1, $username);
        $query->bindParam(2, $password); //jangan lupa bismilah dulu sblm nge run biar berkah
        $query->execute();
        return $query->fetch();
    }

}
?>
