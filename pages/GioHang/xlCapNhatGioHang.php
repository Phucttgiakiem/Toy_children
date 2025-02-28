<?php
    session_start();
    include "../../lib/DataProvider.php";
    include "../../lib/ShoppingCart.php";

    if(isset($_POST["txtSL"]))
    {
        $sl = $_POST["txtSL"];
        if(is_nan($sl) == false)
        {
            //if quantity is number then handle
            $id = $_POST["hdID"];
            $gioHang = unserialize($_SESSION["GioHang"]);
            if($sl > 0)
            {
                // update new quantity
                $gioHang->update($id,$sl);
                $_SESSION["GioHang"] = serialize($gioHang);
            }
            else
            {
                if($sl == 0){
                    $gioHang->delete($id);
                    $_SESSION["GioHang"] = serialize($gioHang);
                }
            }
            DataProvider::ChangeURL("../../index.php?a=5");
        }
        else
        {
            // If the new quantity is not a number, it will not be processed and will default back to the shopping cart management page.
            DataProvider::ChangeURL("../../index.php?a=5");
        }
    }
    else
    {
        DataProvider::ChangeURL("../../index.php?a=404");
    }
?>