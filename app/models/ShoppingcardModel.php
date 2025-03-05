<?php 
    // require_once "itemShoppingcard.php";
    class ShoppingcardModel{
        
        public function additem ($item,$giohang){
            if($giohang && count($giohang) > 0){
                $position = -1;
                for($i = 0; $i < count($giohang);$i++){
                    if($giohang[$i]->$id == $item->$id){
                        $position = $i;
                        break;
                    }
                }
                if($position == -1){
                    arr_push($giohang,$item);
                }else {
                    $giohang[$position]->quantity += $item->quantity;
                    $giohang[$position]->totalprice = $giohang[$position]->quantity*$giohang[$position]->price;
                }
            }
            else {
                $giohang = array();
                array_push($giohang,$item);
            }
            return $giohang;
        }
        public function delete ($id,$giohang){
            for($i = 0; $i < count($giohang);$i++){
                if($giohang[$i]->id == $id){
                    array_splice($giohang,$i,1);
                    break;
                }
            }
            return $giohang;
        }
        public function update($item,$giohang){
            for($i = 0 ; $i < count($giohang);$i++){
                if($giohang[$i]->id == $item->id){
                    $giohang[$i]->quantity = $item->quantity;
                    $giohang[$i]->totalprice = $giohang[$i]->quantity*$giohang[$i]->price;
                }
            }
            return $giohang;
        }
    }
?>