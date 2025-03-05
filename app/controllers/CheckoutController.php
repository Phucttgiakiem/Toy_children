<?php 
    require_once "../app/models/itemShoppingcard.php";
    require_once "../app/models/ShoppingcardModel.php";
    class CheckoutController extends Controller {
        private $itemshopping;
        private $lsshoppingcard;
        public function __construct(){
            $this->itemshopping = new itemShoppingcard();
            $this->lsshoppingcard = new ShoppingcardModel();
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
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];
            $content_page = "../app/views/shoppingcard/shoppingcard.php";
            $this->render("/views/layouts/main",['content_page' => $content_page,'shopping_card'=>$shoppingcard]);
        }
        public function Additem (){
            $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];

            $shoppingcard = $this->lsshoppingcard->Additem($this->itemshopping,$shoppingcard);
            $_SESSION["GioHang"] = serialize($shoppingcard);
            echo json_encode(array("Notification" => "đã thêm sản phẩm vào giỏ hàng"));
        }
        public function Updateitem (){
          //  $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
            session_start();
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
            session_start();
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
    }
?>