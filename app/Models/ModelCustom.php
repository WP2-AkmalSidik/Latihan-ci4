<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
class ModelCustom
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getData()
    {
        $buiulder = $this->db->table("posts");
        // $buiulder->select("authors.first_name, posts.author_id, posts.id, posts.title");
        $buiulder->select("*"); //select * from posts;
        // $buiulder->select("id, first_name, last_name, email");
        // $buiulder->where("id", 1); //select * from posts where id = "1";
        // $buiulder->where("id = '1' and author_id = '2'"); //select * from posts where id = "1" and author_id = "1";
        // $buiulder->where("id", 1);
        // $buiulder->orWhere("id", 2); //select * from posts where id = "1" or author_id = "1";
        //Mencari menggunaka LIKE
        // $buiulder->like("id",27); //select * from posts where title like "odit";
        // Mengurutkan Sesuai Kebutuhan
        $buiulder->orderBy("id", "desc"); //"ASC" , "DESC"
        // $buiulder->selectMin("date", "tanggal");
        //selectAvg, selectSum, selectCount
        // $buiulder->join("authors","authors.id = posts.author_id");
        $data = $buiulder->get()->getResult();
        // $sql = $buiulder->getCompiledSelect();
        return $data;
    }
    public function prosesTransaksi() //Transaksi ini berguna untuk menghindari kepincangan daata 
    {
        //Memindahkan saldo atau tranfer
        $this->db->transBegin();
        $sql1 = "update transaksi set saldo = saldo - 1000 where nama_user ='Akml'";
        $this->db->query($sql1);
        $sql2 = "update transaksi set saldo = saldo + 1000 where nama_user ='Chandra'";
        $this->db->query($sql2);
        if ($this->db->transStatus() == false){
            $this->db->transRollback();
        }  else {
            $this->db->transCommit();
        }
        //Menguodate jumlah saldo bisa tambah bisa kurang tergantung update nya
        // $sql1 = "Update Transaksi set saldo = '11000' where nama_user = 'Akml'";
        // $this->db->query($sql1);
    }
}