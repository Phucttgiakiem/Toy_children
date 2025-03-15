<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/itemShoppingcard.php";
    require_once str_replace("controllers","models/",__DIR__) ."/ShoppingcardModel.php";
    require_once str_replace("controllers","models/",__DIR__) ."/admin/accountModel.php";
    require_once str_replace("controllers","models/",__DIR__) ."/CheckoutModel.php";
    class CheckoutController extends Controller {
        private $itemshopping;
        private $lsshoppingcard;
        private $useraccount;
        private $checkoutbill;
        public function __construct(){
            $this->itemshopping = new itemShoppingcard();
            $this->lsshoppingcard = new ShoppingcardModel();
            $this->useraccount = new accountModel();
            $this->checkoutbill = new CheckoutModel();
        }
        public function createitem ($id,$img,$name,$price,$quantity,$totalprice){
            $this->itemshopping->id = $id;
            $this->itemshopping->img = $img;
            $this->itemshopping->name = $name;
            $this->itemshopping->price = (int) $price;
            $this->itemshopping->quantity = (int) $quantity;
            $this->itemshopping->totalprice = $totalprice;
        }
        public function cardshopping () {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            $content_page = str_replace("controllers","views/",__DIR__) ."shoppingcard/shoppingcard.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,'shopping_card'=>$shoppingcard,'totalitem'=>$totalitem]);
        }
        public function Additem (){
            $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];

            $shoppingcard = $this->lsshoppingcard->Additem($this->itemshopping,$shoppingcard);
            $_SESSION["GioHang"] = serialize($shoppingcard);
            echo json_encode(array("Notification" => "đã thêm sản phẩm vào giỏ hàng"));
        }
        public function Updateitem (){
          //  $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];

            $shoppingcard = $this->lsshoppingcard->update($_POST['id'],$_POST['quantity'],$shoppingcard);
            $_SESSION["GioHang"] = serialize($shoppingcard);
            $totalitem = 0;
            $idsp = $_POST['id'];
            $total_bill = 0;
            foreach($shoppingcard as $item){
                $total_bill += $item->totalprice;
                if($idsp == $item->id){
                    $totalitem = $item->totalprice;
                }
            }
            header('Content-Type: application/json');
            echo json_encode(array("Notification" => "đã cập nhật số lượng sản phẩm","tongsanpham"=>$totalitem,"tongdonhang"=>$total_bill));
        }
        public function Deleteitem(){
           // $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
           if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];

            $shoppingcard = $this->lsshoppingcard->delete($_POST['id'],$shoppingcard);
            $_SESSION["GioHang"] = serialize($shoppingcard);
            $total_bill = 0;
            if(count($shoppingcard) > 0){
                foreach($shoppingcard as $item){
                    $total_bill += $item->totalprice;
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode(array("Notification" => "đã xóa sản phẩm khỏi giỏ hàng","tongdonhang"=>$total_bill));
        }
        public function checkoutbill (){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $content_page = "";
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $totalitem = count($shoppingcard);
            if(isset($_SESSION["MaTaiKhoan"])){
                $content_page = str_replace("controllers","views/",__DIR__) ."/shoppingcard/checkoutbill.php";
                $id = (int)$_SESSION["MaTaiKhoan"];
                $stmt = $this->useraccount->getOneuser($id);
                $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem,
                    'shoppingcard' => $shoppingcard, 'accountinfo' => $stmt
                ]);
            }else {
                $content_page = str_replace("controllers","views/",__DIR__) ."/user/login.php";
                $this->render("/views/layouts/main",['content_page' => $content_page,'totalitem'=>$totalitem]);
            }
        }
        public function createbill (){
            $totalbill = isset($_POST["totalpricebill"]) ? explode(" ",str_replace(",", "", $_POST["totalpricebill"]))[0] : 0;
            $diachigiaohang = isset($_POST["diachi"]) ? $_POST["diachi"] : "";
            $note = isset($_POST["note"]) ? $_POST["note"] : "";
            if (session_status() == PHP_SESSION_NONE) {
                session_start();  // Khởi tạo session nếu chưa được khởi tạo
            }
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $id = (int)$_SESSION["MaTaiKhoan"];
            $stmt = $this->checkoutbill->other($id,$shoppingcard,$totalbill,$diachigiaohang,$note);
            $totalitem = count($shoppingcard);
            header('Content-Type: application/json');
            if($stmt == 1 || $stmt == 2){
                echo json_encode(array("errCode"=>$stmt,"Notification" => "Tạo đơn hàng thất bại, vui lòng thử lại","totalitem"=>$totalitem ));
            }else {
                unset($_SESSION["GioHang"]);
                echo json_encode(array("errCode"=>$stmt,"Notification" => "Tạo đơn hàng thành công","totalitem"=>0));
            }
        }
    }
?>