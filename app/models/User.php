<?php

class User extends Model{

 public function login($no_induk, $role) {
        // Jika tabel kamu dipisah (tabel 'guru' dan tabel 'siswa')
        $table = ($role == 'guru') ? 'guru' : 'siswa';
        
        // Sesuaikan nama kolom no_induk di tabel kamu (misal: 'no_induk', 'nip', atau 'nisn')
        $query = "SELECT * FROM users WHERE no_induk = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([$no_induk]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function getSiswa(){
    // Murni menggunakan ? tanpa kutip satu
    $query = "SELECT * FROM users WHERE role = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute(["siswa"]); 
    
    // Wajib fetchAll karena data siswa ada banyak di database
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

}