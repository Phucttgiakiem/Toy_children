<?php 
    class PagenotfoundController extends Controller {
        public function index() {
            $content_page = "../app/views/admin/PageEmpty/404.php";
            $this->render("/views/admin/dashboard",['content_page' => $content_page]);
        }
    }
?>