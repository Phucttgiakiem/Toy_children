<?php
    require_once str_replace("controllers","models/",__DIR__) ."ProductModel.php";
    require_once str_replace("controllers","models/",__DIR__) ."CategoryModel.php";
    require_once str_replace("controllers","models/",__DIR__) ."admin/HangSXModel.php";
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
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
           // Kiểm tra nếu tham số 'id' có trong URL
           $product = null;
            if (isset($_GET['id'])) {
                $id = $_GET['id'];  // Lấy id từ query string

                // Lấy thông tin sản phẩm từ model
            }
            // cập nhật số lượt xem
            $this->productModel->gettotalwatcher($id);

            $product = $this->productModel->getOneProduct($id);

            $content_page = str_replace("controllers","views/",__DIR__) ."/Product/detailproduct.php";
                  
            $this->render("/views/layouts/main",['content_page' => $content_page,"detailpr"=>$product,'totalitem'=>$totalitem]);

        }
        public function Getnewlistproduct (){
            $page =(int)$_GET['page'];
            $offset = ($page - 1)*8;
            $products = $this->productModel->getAllProduct($offset);
            header('Content-Type: application/json');
            echo json_encode(array("product"=>$products,"page"=>$page));
        }
        public function Categoryproduct ($companys = null,$typeproduct = null){
            // Kiểm tra nếu có giá trị 'search' trong $_POST
            $search = isset($_POST['search']) ? $_POST['search'] : '';
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $products = $this->productModel->getAllProductwithrequire($companys,$typeproduct,$search);
            $typeproducts = $this->CategoryModel->getAllCategory();
            $companys = $this->CompanyModel->getHangSX();

            $content_page = str_replace("controllers","views/",__DIR__) ."Product/category.php";
            $this->render("/views/layouts/main",[
                "products"=>$products,"Companys"=>$companys,"typeproducts"=>$typeproducts,
                "content_page"=>$content_page,'totalitem'=>$totalitem]);
        }
    }
?>