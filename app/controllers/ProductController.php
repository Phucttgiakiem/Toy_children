<?php
    require_once "../app/models/ProductModel.php";
    class ProductController extends Controller {
        private $productModel;
        public function __construct(){
            $this->productModel = new ProductModel();
        }
        public function Detailproduct(){
           // Kiểm tra nếu tham số 'id' có trong URL
           $product = null;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];  // Lấy id từ query string

                // Lấy thông tin sản phẩm từ model
                $product = $this->productModel->getOneProduct($id);
            }
                  
            $this->render("/views/Product/detailproduct",["detailpr"=>$product]);
        }
        public function Getnewlistproduct (){
            $page =(int)$_GET['page'];
            $offset = ($page - 1)*8;
            $products = $this->productModel->getAllProduct($offset);
            header('Content-Type: application/json');
            echo json_encode(array("product"=>$products,"page"=>$page));
        }
    }
?>