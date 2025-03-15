<?php
    require_once str_replace("controllers","models/",__DIR__) . "\ProductModel.php";
    class HomeController extends Controller {
        private $productModel;
        public function __construct(){
            $this->productModel = new ProductModel();
        }
        public function index(){
            $offset = 0;
            $products = $this->productModel->getAllProduct($offset);
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            
            $content_page = str_replace("controllers","views/",__DIR__) ."/home/index.php";
       
            $this->render("/views/layouts/main",['product'=>$products,'content_page' => $content_page,'totalitem'=>$totalitem]);
        }
        public function PageEmpty(){
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = str_replace("controllers","views/",__DIR__) ."/PageEmpty/404.php";
       
            $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
        }
    }
?>