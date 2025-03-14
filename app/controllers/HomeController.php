<?php
    require_once "../app/models/ProductModel.php";
    class HomeController extends Controller {
        private $productModel;
        public function __construct(){
            $this->productModel = new ProductModel();
        }
        public function index(){
            $offset = 0;
            $products = $this->productModel->getAllProduct($offset);
            // if (!isset($_GET['page']) || $_GET['page'] != $page) {
            //     header("Location: /Toy_children/public/index.php?page=1");
            //     exit();
            // }
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = "../app/views/home/index.php";
       
            $this->render("/views/layouts/main",['product'=>$products,'content_page' => $content_page,'totalitem'=>$totalitem]);
        }
        public function PageEmpty(){
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = "../app/views/PageEmpty/404.php";
       
            $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
        }
    }
?>