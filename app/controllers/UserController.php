<?php 
    require_once "../app/models/UserModel.php";
    class UserController extends Controller {
        private $userModel;
        public function __construct(){
            $this->userModel = new UserModel();
        }
        public function Index (){
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = "../app/views/user/login.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
        }
        public function handlelogin () {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rs = $this->userModel->handleaccount($username,$password);
            header('Content-Type: application/json');
            if($rs){
                session_start();
                $_SESSION["MaTaiKhoan"] = $rs["MaTaiKhoan"];
                $_SESSION["MaLoaiTaiKhoan"] = $rs["MaLoaiTaiKhoan"];
                $_SESSION["TenHienThi"] = $rs["TenHienThi"];
                echo json_encode(array("errCode"=>1,"Notification" => "Chúc bạn có trải nghiệm mua sắm vui vẻ"));
            }
            else {
                echo json_encode(array("errCode"=>0,"Notification" => "Tên đăng nhập hoặc mật khẩu không đúng"));
            }
        }
        public function handlelogout (){
            session_start();
            if(isset($_SESSION["MaTaiKhoan"]) && isset($_SESSION["MaLoaiTaiKhoan"]) && isset($_SESSION["TenHienThi"])){
                unset($_SESSION["MaTaiKhoan"]);
                unset($_SESSION["MaLoaiTaiKhoan"]);
                unset($_SESSION["TenHienThi"]);
            }
            $offset = 0;
            $products = $this->productModel->getAllProduct($offset);
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = "../app/views/home/index.php";
            $this->render("/views/layouts/main",['product'=>$products,'content_page' => $content_page,'totalitem'=>$totalitem]);
        }
    }
?>