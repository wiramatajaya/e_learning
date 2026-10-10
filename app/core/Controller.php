<?php

class Controller {
    // Menggunakan nama variabel $view agar lebih universal untuk folder & nama filenya
    public function view($view, $data = []) {
        // Jika ada data yang dikirim, pecah array menjadi variabel mandiri
        if (!empty($data)) {
            extract($data);
        }
        if(isset($_SESSION["role"])){
        require_once 'app/views/layouts/header.php';
        require_once 'app/views/' . $view . '.php';
        require_once 'app/views/layouts/footer.php';
        }else{
            require_once 'app/views/' . $view . '.php';
        }
        
        

    }

    public function model($model) {
        // Keluar dari core/ lalu masuk ke models/
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }
}