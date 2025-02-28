<?php 
    class Product {
        var $id;
        var $num;
    }
    class ShoppingCart {
        var $listProduct;
        public function __construct() {
            $this->listProduct = array();
        }
        public function update($id,$newNum){
            for($i = 0; $i < count($this->listProduct);$i++){
                if ($this->listProduct[$i]->id == $id) {  // Sửa lỗi kiểm tra id
                    $this->listProduct[$i]->num = $newNum;
                }
            }
        }
        public function delete($id){
            for($i = 0; $i < count($this -> listProduct);$i++){
                if($this->listProduct[$i]->id == $id)
                    array_splice($this->listProduct,$i,1);
            }
        }
        public function add($id){
            if(count($this->listProduct) == 0){
                // empty shopping cart
                $p = new Product();
                $p->id = $id;
                $p->num = 1;
                $this->listProduct[] = $p;
            }else {
                //the shopping cart had item
                //check item existed in shopping cart ?
                //if shopping cart had it then updated one for quantity
                // if shopping cart hadn't it then add it for shopping cart
                // echo "Đã vào hàm add!<br>";
                // var_dump($this->listProduct);
                //exit;
                $poinarr = -1;
                for($i = 0; $i < count($this->listProduct); $i++){
                    if($this->listProduct[$i]->id == $id){
                        $poinarr = $i;
                        break;
                    }
                }
                if ($poinarr == -1) {
                    // Sản phẩm chưa có trong giỏ hàng, thêm mới
                    $p = new Product();
                    $p->id = $id;
                    $p->num = 1;
                    array_push($this->listProduct, $p); // Dùng [] thay vì index
                } else {
                    // Sản phẩm đã có, tăng số lượng
                    $this->listProduct[$poinarr]->num++;
                }
            }
        }
    }
?>