<?php
    require_once "../app/models/ProductModel.php";
    class HomeController extends Controller {
        private $productModel;
        public function __construct(){
            $this->productModel = new ProductModel();
        }
        public function index(){
            $products = $this->productModel->getAllProduct();
            $this->render('/views/layouts/main',['product'=>$products]);
        }
    }
?>