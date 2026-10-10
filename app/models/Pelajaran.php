<?php

class Pelajaran extends Model{

    public function getAllPelajaran(){
        $query = "SELECT * FROM mapel";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $mapel = $stmt->fetchAll();
        return $mapel;
    }

    public function getJadwalPelajaran(){
        $query = "SELECT * FROM jadwal_pelajaran";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getJadwalPelajaranByHari($id_hari){
        $query = "SELECT * FROM jadwal_pelajaran WHERE id_hari= ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_hari]);
        return $stmt->fetchAll();
    }
    


    public function insertPelajaran($data) {
        $query = "INSERT INTO mapel (nama_mapel, deskripsi, file_materi) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $data['nama'],
            $data['deskripsi']
        ]);
    }

    public function updatePelajaran($data) {
            $query = "UPDATE mapel SET nama_mapel = ?, deskripsi = ? WHERE id_mapel = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$data['nama_mapel'], $data['deskripsi'], $data['id_mapel']]);
}

}