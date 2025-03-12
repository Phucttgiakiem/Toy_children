<?php
    require_once "../app/models/ProductModel.php";
    require_once "../app/models/CategoryModel.php";
    require_once "../app/models/admin/HangSXModel.php";
    class ProductController extends Controller {
        private $productModel;
        private $CategoryModel;
        private $CompanyModel;
        public function __construct(){
            $this->productModel = new ProductModel();
            $this->CategoryModel = new CategoryModel();
            $this->CompanyModel = new HangSXModel();
        }
        public function Detailproduct($id = null){
           // Kiểm tra nếu tham số 'id' có trong URL
           $product = null;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];  // Lấy id từ query string

                // Lấy thông tin sản phẩm từ model
            }
            $product = $this->productModel->getOneProduct($id);
                  
            $this->render("/views/Product/detailproduct",["detailpr"=>$product]);
        }
        public function Getnewlistproduct (){
            $page =(int)$_GET['page'];
            $offset = ($page - 1)*8;
            $products = $this->productModel->getAllProduct($offset);
            header('Content-Type: application/json');
            echo json_encode(array("product"=>$products,"page"=>$page));
        }
        public function Categoryproduct ($companys = null,$typeproduct = null){
            
            $products = $this->productModel->getAllProductwithrequire($companys,$typeproduct);
            $typeproducts = $this->CategoryModel->getAllCategory();
            $companys = $this->CompanyModel->getHangSX();

            $content_page = "../app/views/Product/category.php";
            $this->render("/views/layouts/main",[
                "products"=>$products,"Companys"=>$companys,"typeproducts"=>$typeproducts,
                "content_page"=>$content_page]);
        }
    }
?>