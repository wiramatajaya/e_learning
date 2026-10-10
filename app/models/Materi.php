<?php

class Materi extends Model{
    function getAllMateri(){
        $q="SELECT * FROM materi";
        $stmt= $this->db->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getMateriByMapelId($id_mapel,$kelas_id){
        $q="SELECT * FROM materi WHERE id_mapel=? AND kelas_id=?";
        $stmt= $this->db->prepare($q);
        $stmt->execute([$id_mapel,$kelas_id]);
        return $stmt->fetchAll();
    }

        function getAllUjian(){
        $q="SELECT * FROM ujian";
        $stmt= $this->db->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    }        
    
    function getAllCount(){
        $q="SELECT * FROM ujian";
        $stmt= $this->db->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUjianSelesai() {
        $sql = "SELECT COUNT(IF(`tgl_pengumpulan` < CURDATE(), 1, NULL)) AS selesai,COUNT(*) AS total_semua FROM ujian";
        return $this->db->query($sql)->fetch();
    }


    public function getMateriSelesai() {
        $sql = "SELECT COUNT(IF(`tenggat_waktu` < CURDATE(), 1, NULL)) AS selesai,COUNT(*) AS total_semua FROM materi";
        return $this->db->query($sql)->fetch();
    }

    public function insertMateri($data, $filePath="asd", $gambarPath="asd") {
        $q = "INSERT INTO materi 
                (judul, materi, file_path, id_mapel, id_guru, gambar, tenggat_waktu) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($q);
        
        // Pass semua nilai sesuai urutan tanda tanya (?) di atas
        return $stmt->execute([
            $data['judul'],
            $data['materi'],
            $filePath,
            $data['id_mapel'],
            $data['id_guru'],
            $gambarPath,
            $data['tenggat_waktu']
        ]);
    }


public function getMateriById($id_materi) {
    $q="SELECT * FROM materi WHERE id_materi = ?";
        $stmt= $this->db->prepare($q);
        $stmt->execute([$id_materi]);
    return $stmt->fetch();
}




public function updateMateri($data) {
    $query = "UPDATE materi SET judul = ? , materi = ? , file_path = ?  , id_mapel = ?  , gambar = ?  , tenggat_waktu = ?  WHERE id_materi = ? ";
    $stmt=$this->db->prepare($query);
    return $stmt->execute([$data['judul'], $data['materi'], $data['file_path'], $data['id_mapel'], $data['gambar'], $data['tenggat_waktu'], $data['id_materi']]);
}


    
}

