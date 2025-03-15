<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/UserModel.php";
    require_once str_replace("controllers","models/",__DIR__) ."/ProductModel.php";
    class UserController extends Controller {
        private $userModel;
        private $productModel;
        public function __construct(){
            $this->userModel = new UserModel();
            $this->productModel = new ProductModel();
        }
        public function Index (){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page =  str_replace("controllers","views/",__DIR__) ."/user/login.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
        }
        public function Register(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page =  str_replace("controllers","views/",__DIR__) ."/user/register.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
        }
        public function Forgotpass (){
            $content_page =  str_replace("controllers","views/",__DIR__) ."/user/forgotpass.php";
            $this->render("/views/layouts/main",['content_page' => $content_page]);
        }
        public function handlegetpass (){
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
            $newpass = isset($_POST["newpass"]) ? trim($_POST["newpass"]) : "";
            header('Content-Type: application/json');
            if($email != "" && $newpass != ""){
                $rs = $this->userModel->handlegetpass($email,$newpass);
                if($rs == 0){
                    echo json_encode(array("errCode" => 0,"Notification" => "Lấy lại mật khẩu thành công"));
                }else if($re == 1){
                    echo json_encode(array("errCode" => 1,"Notification" => "Tạo mật khẩu thất bại"));
                }else {
                    echo json_encode(array("errCode" => 2,"Notification" => "Email không tồn tại trên hệ thống thành công"));
                }
            }
        }
        public function handleregister () {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $numberphone = $_POST['numberphone'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $address = $_POST['address'];
            $rs = $this->userModel->handleregister($username,$pass,$fullname,$address,$numberphone,$email);
            header('Content-Type: application/json');
            if($rs == 1){
                echo json_encode(array("errCode" => 0,"Notification" => "Tạo tài khoản thành công"));
            }else {
                if($rs == 2){
                    echo json_encode(array("errCode" => -1,"Notification" => "Không thể tạo được tài khoản, thử lại !!!"));
                }
                else {
                    echo json_encode(array("errCode" => 1,"Notification" => "Tên đăng nhập đã trùng với tài khoản khác"));
                }
            }
        }
        public function handlelogin () {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rs = $this->userModel->handleaccount($username,$password);
            header('Content-Type: application/json');
            if($rs){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();  // Khởi tạo session nếu chưa được khởi tạo
                }
                $_SESSION["MaTaiKhoan"] = $rs["MaTaiKhoan"];
                $_SESSION["MaLoaiTaiKhoan"] = $rs["MaLoaiTaiKhoan"];
                $_SESSION["TenHienThi"] = $rs["TenHienThi"];
                $_SESSION["LoaiTaiKhoan"] = (int)$rs["MaLoaiTaiKhoan"];
                if ($rs['MaLoaiTaiKhoan'] == 2) {
                    echo json_encode(array("errCode" => 1, "Notification" => "Đăng nhập thành công", "redirect" => "/Toy_children/admin/Dashboard"));
                } 
                else
                echo json_encode(array("errCode"=>1,"Notification" => "Chúc bạn có trải nghiệm mua sắm vui vẻ"));
            }
            else {
                echo json_encode(array("errCode"=>0,"Notification" => "Tên đăng nhập hoặc mật khẩu không đúng"));
            }
        }
        public function handlelogout (){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            if(isset($_SESSION["MaTaiKhoan"]) && isset($_SESSION["MaLoaiTaiKhoan"]) && isset($_SESSION["TenHienThi"])){
                unset($_SESSION["MaTaiKhoan"]);
                unset($_SESSION["MaLoaiTaiKhoan"]);
                unset($_SESSION["TenHienThi"]);
                unset( $_SESSION["LoaiTaiKhoan"]);
            }
            $offset = 0;
            $products = $this->productModel->getAllProduct($offset);
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page =  str_replace("controllers","views/",__DIR__) ."/home/index.php";
            $this->render("/views/layouts/main",['product'=>$products,'content_page' => $content_page,'totalitem'=>$totalitem]);
        }
    }
?>