<?php 
    require_once 'Database.php';
class Model {
protected static $db_conn = null;
    public $db;

    public function __construct()
    {
        // Jika belum ada koneksi sama sekali, buat baru satu kali saja
        if (self::$db_conn === null) {
            $database = new Database();
            self::$db_conn = $database->conn;
        }
        $this->db = self::$db_conn;
        

    }
}

