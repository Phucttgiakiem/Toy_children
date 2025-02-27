<div id="header">
    <a href="index.php">
        Toy Shop
    <a>
    <div id="login_nav">
        <?php
            if(isset($_SESSION["MaTaiKhoan"]))
            {
                //Login in
                ?>
                    Hello, <?php echo $_SESSION["TenHienThi"];?>
                    <a href="modules/xlDangXuat.php">Đăng xuất</a>
                    <a href="index.php?a=5">
                        <img src="img/manage_shopping.png" height="20"/>
                    </a>
                <?php
            }
            else{
                //login out
                ?>
                    <form name="frmLogin" action="modules/xlDangNhap.php" method="post" onsubmit="return KiemTraDangNhap()">
                        Tài khoản:<input name="txtUS" type="text" id="txtUS" size="12" maxlength="20" width="15">
                        Mật khẩu: <input name="txtPS" type="password" id="txtPS" size="12" maxlength="20" width="15">
                    </form>
                    <script type="text/javascript">
                        function ChuyenTrangDangKy () {
                            location = "index.php?a=6";
                        }
                    </script>
                <?php
            }
        ?>
    </div>
    <img src="img/header_1.png" width="748">
    <img src="img/header_2.png" width="748">
</div>