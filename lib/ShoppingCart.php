<?php 
    class Product {
        var $id;
        var $num;
    }
    class ShoppingCart {
        var $listProduct;
        public function _construct() {
            $this->listProduct = array();
        }
        public function update($id,$newNum){
            for($i = 0; $i < count($this->listProduct);$i++){
                if($this->listProduct[$i] == $id){
                    $this -> listProduct[$i]->num = $newNum;
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
                
                for($i = 0; $i < count($this -> listProduct); $i++){
                    if($this->listProduct[$i]->id == $id)
                        break;
                }
                if($i == count($this->thisProduct)) {
                    // mean that shopping cart has been cleared but It has not products to add.  
                    // add new item
                    $p = new Product();
                    $p->id = $id;
                    $p->num = 1;
                    $this->listProduct[] = $p;
                }else {
                    $this->listProduct[$i]->num++;
                }
            }
        }
    }
?>