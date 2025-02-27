<?php 
    class DataProvider
    {
        public static function ExecuteQuery($sql){
            try {
                $conn = new mysqli('localhost','root','root','BabyShop');
                //Check connection
                if($conn -> connect_error) {
                    throw new Exception("Connection failed ".$conn -> connect_error);
                }
                // set up TABLE with UTF-8 code
                $conn->set_charset("utf8");
                // perform query
                $result = $conn->query($sql);
                // close connection
                $conn->close();
            } catch (Exception $e){
                die("error: ".$e->getMessage());
            }
        }
    }
?>