<?php 
    require_once "../app/models/ProductModel.php";
    require_once "../app/models/admin/LoaiSPModel.php";
    require_once "../app/models/admin/HangSXModel.php";
    class ProductController extends Controller {
        private $productModel;
        private $loaispModel;
        private $hangsxModel;
        public function __construct(){
            $this->productModel = new ProductModel();
            $this->loaispModel = new LoaiSPModel();
            $this->hangsxModel = new HangSXModel();
        }
        public function index($page = 1) {
            $totalrowtable = $this->productModel->getCountProduct();
            $totalpages = ceil((int)$totalrowtable/5);
            $offset = ((int)$page - 1) * 5;
            $products = $this->productModel->getAllProduct($offset,5);
            $content_page = "../app/views/admin/product/index.php";
            $this->render("/views/admin/dashboard",['products'=>$products,'content_page' => $content_page,
            'totalpages'=>$totalpages,'page'=>$page]);
        }
        public function detail($id) {
            $product = $this->productModel->getOneProduct($id);
            $content_page = "../app/views/admin/product/detail.php";
            $this->render("/views/admin/dashboard",['product'=>$product,'content_page' => $content_page]);
        }
        public function edit($id) {
            $product = $this->productModel->getOneProduct($id);
            $hangsx =  $this->hangsxModel->getHangSX();
            $loaisp = $this->loaispModel->getLoaiSP();
            $content_page = "../app/views/admin/product/edit.php";
            $this->render("/views/admin/dashboard",['product'=>$product,'content_page' => $content_page,'hangsx'=>$hangsx,'loaisp'=>$loaisp]);
        }
    }
?>