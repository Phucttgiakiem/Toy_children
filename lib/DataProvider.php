<?php 
    class DataProvider
    {
        public static function ExecuteQuery($sql){
            try {
                $conn = new mysqli('localhost','root','','BabyShop');
                //Check connection
                if($conn -> connect_error) {
                    throw new Exception("Connection failed ".$conn -> connect_error);
                }
                // set up TABLE with UTF-8 code
                $conn->set_charset("utf8");
                // perform query
                $result = $conn->query($sql);
                return $result;
                // close connection
            } catch (Exception $e){
                die("error: ".$e->getMessage());
            }finally {
                $conn->close();
            }
        }
    }
?>