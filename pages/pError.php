<h1>Error 404</h1>
<?php
    if(isset($_GET["id"]))
    {
        switch($_GET["id"]) {
            case 1:
                echo "Tên đăng nhập và mật khẩu không tồn tại";
                break;
        }
    }
?>