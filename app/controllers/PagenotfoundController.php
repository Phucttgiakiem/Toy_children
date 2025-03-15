<?php 
    class PagenotfoundController extends Controller {
        public function index() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = "../app/views/PageEmpty/404.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,"totalitem" => $totalitem]);
        }
    }
?>