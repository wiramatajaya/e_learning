
<?php
class Database{
         private $hostname= "localhost";
     private $username= "root";
     private $password= "";
     private $dbname= "e_learning_sd";

    public $conn  ;
    public function __construct()
    {
        {
            $dsn=  "mysql:host=".$this->hostname.";dbname=".$this->dbname.";charset=utf8mb4";
            // Pengaturan tambahan untuk keamanan dan penanganan error
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
                PDO::ATTR_EMULATE_PREPARES   => false,                  
            ];

        try {
            $this->conn= new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Jika gagal, tampilkan pesan error yang aman
            die("Koneksi Gagal: " . $e->getMessage());
        }
            }
    }

}


