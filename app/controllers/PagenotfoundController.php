<?php 
    class PagenotfoundController extends Controller {
        public function index() {
            $content_page = "../app/views/PageEmpty/404.php";
            $this->render("/views/layouts/main",['content_page' => $content_page]);
        }
    }
?>