<?php
    // Helper Function khusus untuk menangani proses upload berkas file
     function prosesUpload($file) {
        $namaFile = $file['name'];
        $ukuranFile = $file['size'];
        $tmpName = $file['tmp_name'];
        
        // Ekstensi yang diperbolehkan
        $ekstensiValid = ['pdf', 'doc', 'docx', 'ppt', 'pptx','jpg','png'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));

        if (!in_array($ekstensiFile, $ekstensiValid)) {
            return false;
        }

        // Validasi Ukuran (Maksimal 5 MegaBytes)
        if ($ukuranFile > 5242880) {
            return false;
        }

        // Generate nama file acak yang unik agar tidak menimpa file bernama sama
        $namaFileBaru = uniqid() . '.' . $ekstensiFile;
        
        // Folder tujuan penyimpanan file (pastikan folder 'uploads' sudah kamu buat)
        $targetDir = 'public/uploads/' . $namaFileBaru;

        if (move_uploaded_file($tmpName, $targetDir)) {
            return $namaFileBaru;
        }
        return false;
    }