<?php 
    session_start();
    include "lib/DataProvider.php";

    //save path current
    $_SESSION["path"] = $_SERVER["REQUEST_URI"];

?>
<html xmls='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Website ToyShop</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div id="wrapper">
        <?php 
            include "modules/mHeader.php";
            include "modules/mSidebar.php";
        ?>
        <div id="content">
            <?php
                $a = 1;
                if(isset($_GET["a"]) == true)
                    $a = $_GET["a"];
                switch($a){
                    case 1:
                        include "pages/pIndex.php";
                        break;
                    case 2:
                        include "pages/pSanPhamTheoHang.php";
                        break;
                    case 3:
                        include "pages/pSanPhamTheoLoai.php";
                    case 4:
                        include "pages/pChiTiet.php";
                        break;
                    case 5:
                        include "pages/GioHang/pIndex.php";
                        break;
                    case 6:
                        include "pages/TaoTaiKhoan/pIndex.php";
                        break;
                    default:
                        include "pages/pError.php";
                        break;

                }
            ?>
        </div>
        <?php include "modules/mFooter.php";?>
    </div>
</body>
</html>