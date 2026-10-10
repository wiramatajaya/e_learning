<?php

class Ujian extends Model {

    // 1. Ambil detail Ujian beserta nama mata pelajaran
    public function getUjianById($id_ujian) {
        $stmt = $this->db->prepare("SELECT u.*, m.nama_mapel 
                                    FROM ujian u 
                                    JOIN mapel m ON u.id_mapel = m.id_mapel 
                                    WHERE u.id_ujian = ?");
        $stmt->execute([$id_ujian]);
        return $stmt->fetch();
    }

public function getMateriById($id_materi) {
    $q="SELECT * FROM materi WHERE id_materi = ?";
        $stmt= $this->db->prepare($q);
        $stmt->execute([$id_materi]);
    return $stmt->fetch();
}

public function getUjianByMateriId ($id_materi) {
    $q="SELECT * FROM ujian WHERE id_materi = ?";
        $stmt= $this->db->prepare($q);
        $stmt->execute([$id_materi]);
    return $stmt->fetch();
}

public function getUjianByMapelId($mapel_id) {
    $q="SELECT * FROM ujian WHERE id_mapel = ?";
        $stmt= $this->db->prepare($q);
        $stmt->execute([$mapel_id]);
    return $stmt->fetchAll();
}


    public function getAllUjian() {
        $stmt = $this->db->prepare("SELECT * FROM ujian");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Ambil semua soal berdasarkan ID Ujian
    public function getSoalByUjian($id_ujian) {
        $stmt = $this->db->prepare("SELECT * FROM bank_soal WHERE id_ujian = ? ORDER BY id_soal ASC");
        $stmt->execute([$id_ujian]);
        return $stmt->fetchAll();
    }

    // 3. Ambil jawaban siswa untuk 1 nomor soal spesifik
    public function getJawabanSiswa($id_user, $id_soal) {
        $stmt = $this->db->prepare("SELECT * FROM jawaban_siswa WHERE id_user = ? AND id_soal = ?");
        $stmt->execute([$id_user, $id_soal]);
        return $stmt->fetch();
    }

    // 4. Ambil semua jawaban siswa dalam 1 ujian
    public function getAllJawabanSiswaByUjian($id_user, $id_ujian) {
        $stmt = $this->db->prepare("
            SELECT js.id_soal, js.jawaban 
            FROM jawaban_siswa js
            JOIN bank_soal bs ON js.id_soal = bs.id_soal
            WHERE js.id_user = ? AND bs.id_ujian = ?
        ");
        $stmt->execute([$id_user, $id_ujian]);
        return $stmt->fetchAll();
    }

    // Alias untuk method di atas
    public function getJawabanSiswaByUjian($id_user, $id_ujian) {
        return $this->getAllJawabanSiswaByUjian($id_user, $id_ujian);
    }

    // 5. Simpan / Update jawaban per nomor (Dipanggil di GuruController / SiswaController)
    public function simpanJawaban($id_user, $id_soal, $jawaban) {
        $existing = $this->getJawabanSiswa($id_user, $id_soal);

        if ($existing) {
            $stmt = $this->db->prepare("UPDATE jawaban_siswa SET jawaban = ? WHERE id_user = ? AND id_soal = ?");
            return $stmt->execute([$jawaban, $id_user, $id_soal]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO jawaban_siswa (id_user, id_soal, jawaban) VALUES (?, ?, ?)");
            return $stmt->execute([$id_user, $id_soal, $jawaban]);
        }
    }

    // Alias jika dipanggil sebagai simpanJawabanPerSoal
    public function simpanJawabanPerSoal($id_user, $id_soal, $jawaban) {
        return $this->simpanJawaban($id_user, $id_soal, $jawaban);
    }

    // 6. Submit Ujian akhir: Hitung skor & Simpan ke tabel `nilai` + Status jawaban
    public function submitDanHitungNilai($id_user, $id_ujian, $jawaban_user = []) {
        try {
            $this->db->beginTransaction();
            $soal_list = $this->getSoalByUjian($id_ujian);
            $total_soal = count($soal_list);
            $jumlah_benar = 0;
            $stmtCekJawaban = $this->db->prepare("SELECT id_jawaban FROM jawaban_siswa WHERE id_user = ? AND id_soal = ?");
            $stmtInsertJawaban = $this->db->prepare("INSERT INTO jawaban_siswa (id_user, id_soal, jawaban, status) VALUES (?, ?, ?, ?)");
            $stmtUpdateJawaban = $this->db->prepare("UPDATE jawaban_siswa SET jawaban = ?, status = ? WHERE id_user = ? AND id_soal = ?");
            foreach ($soal_list as $soal) {
                $id_soal = $soal['id_soal'];
                $jawaban = isset($jawaban_user[$id_soal]) ? $jawaban_user[$id_soal] : null;

                // Jika jawaban tidak dikirim via parameter, cek dari database
                if ($jawaban === null) {
                    $existingJawaban = $this->getJawabanSiswa($id_user, $id_soal);
                    if ($existingJawaban) {
                        $jawaban = $existingJawaban['jawaban'];
                    }
                }
                
                $status = ($jawaban !== null && $jawaban === $soal['jawaban_benar']) ? 'benar' : 'salah';
                if ($status === 'benar') {
                    $jumlah_benar++;
                }

                $stmtCekJawaban->execute([$id_user, $id_soal]);
                $isExist = $stmtCekJawaban->fetch();

                if ($isExist) {
                    $stmtUpdateJawaban->execute([$jawaban, $status, $id_user, $id_soal]);
                } else {
                    $stmtInsertJawaban->execute([$id_user, $id_soal, $jawaban, $status]);
                }
            }

            $skor = ($total_soal > 0) ? ($jumlah_benar / $total_soal) * 100 : 0;
            $stmtCekNilai = $this->db->prepare("SELECT id_nilai FROM nilai WHERE id_user = ? AND id_ujian = ?");
            $stmtCekNilai->execute([$id_user, $id_ujian]);
            $isNilaiExist = $stmtCekNilai->fetch();
            $hasil=["jawaban_benar"=>$jumlah_benar,"total_soal" => $total_soal];
            if ($isNilaiExist) {
                $stmtNilai = $this->db->prepare("UPDATE nilai SET skor = ?, waktu_selesai = CURRENT_TIMESTAMP WHERE id_user = ? AND id_ujian = ?");
                $stmtNilai->execute([$skor, $id_user, $id_ujian]);
            } else {
                $stmtNilai = $this->db->prepare("INSERT INTO nilai (id_user, id_ujian, skor, waktu_selesai) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
                $stmtNilai->execute([$id_user, $id_ujian, $skor]);
            }

            $this->db->commit();
            return $hasil;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    // Alias untuk submitUjian
    public function submitUjian($id_user, $id_ujian, $jawaban_user = []) {
        return $this->submitDanHitungNilai($id_user, $id_ujian, $jawaban_user);
    }

    // 7. Cek apakah siswa sudah kuis
    public function isSudahKuis($id_user, $id_ujian) {
        $stmt = $this->db->prepare("SELECT * FROM nilai WHERE id_user = ? AND id_ujian = ?");
        $stmt->execute([$id_user, $id_ujian]);
        return $stmt->fetch();
    }


    public function getRiwayatUjianBySiswa($id_user) {
        $stmt = $this->db->prepare("
            SELECT 
                u.id_ujian,
                u.judul_ujian AS nama_ujian,
                u.jenis_ujian AS kategori,
                u.id_mapel,
                m.nama_mapel,
                n.skor AS nilai,
                n.waktu_selesai AS tanggal_kumpul,
                (SELECT COUNT(*) FROM bank_soal WHERE id_ujian = u.id_ujian) AS total_soal,
                (SELECT COUNT(*) FROM jawaban_siswa js 
                 JOIN bank_soal bs ON js.id_soal = bs.id_soal 
                 WHERE js.id_user = n.id_user AND bs.id_ujian = u.id_ujian AND js.jawaban IS NOT NULL) AS total_dijawab
            FROM nilai n
            JOIN ujian u ON n.id_ujian = u.id_ujian
            JOIN mapel m ON u.id_mapel = m.id_mapel
            WHERE n.id_user = ?
            ORDER BY n.waktu_selesai DESC
        ");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll();
    }





// Tambah Ujian
    public function tambahUjian($data) {
        $stmt = $this->db->prepare("INSERT INTO ujian (judul_ujian, jenis_ujian, id_mapel, tgl_pelaksanaan, tgl_pengumpulan, wktu_pengerjaan) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['judul_ujian'],
            $data['jenis_ujian'],
            $data['id_mapel'],
            $data['tgl_pelaksanaan'],
            $data['tgl_pengumpulan'],
            $data['wktu_pengerjaan']
        ]);
        return $this->db->lastInsertId();
    }

// Tambah Soal (dengan kolom gambar)
public function tambahSoal($data) {
    $stmt = $this->db->prepare("INSERT INTO bank_soal (id_ujian, pertanyaan, img, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['id_ujian'],
        $data['pertanyaan'],
        $data['img'], // Tambahkan ini
        $data['opsi_a'],
        $data['opsi_b'],
        $data['opsi_c'],
        $data['opsi_d'],
        $data['jawaban_benar']
    ]);
}





}