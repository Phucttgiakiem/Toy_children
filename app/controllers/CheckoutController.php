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
            $content_page = "../app/views/shoppingcard/shoppingcard.php";
            $this->render("/views/layouts/main",['content_page' => $content_page]);
        }
        public function Additem (){;
            $this->createitem($_POST['id'], $_POST['img'],$_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['totalprice']);
            session_start();
            $shoppingcard = isset($_SESSION["GioHang"]) ? unserialize($_SESSION["GioHang"]) : [];

            $shoppingcard = $this->lsshoppingcard->Additem($this->itemshopping,$shoppingcard);
            $_SESSION["GioHang"] = serialize($shoppingcard);
            echo json_encode(array("Notification" => "đã thêm sản phẩm vào giỏ hàng"));
        }
    }
?>