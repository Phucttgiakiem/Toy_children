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

                // Kiểm tra nếu sản phẩm tồn tại
               // if ($product) {
                    // Trả về dữ liệu sản phẩm dưới dạng JSON
                  //  echo json_encode(["detailsp" => $product]);
            }
                    // Nếu không tìm thấy sản phẩm, trả về thông báo lỗi dưới dạng JSON
                  //  echo json_encode(["error" => "Sản phẩm không tồn tại"]);
                  $this->render("/views/Product/detailproduct",["detailpr"=>$product]);
           
               // echo json_encode(["error" => "ID sản phẩm không được cung cấp"]);

            // Đảm bảo rằng header được đặt đúng để trả về JSON
          //  header('Content-Type: application/json');
        }
    }
?>