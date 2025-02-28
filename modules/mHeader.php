<div id="header">
    <a href="index.php">
        Toy Shop
    </a>
    <div id="login_nav">
        <?php
            if(isset($_SESSION["MaTaiKhoan"]))
            {
                //Login in
                ?>
                    <p>Hello, <?=$_SESSION["TenHienThi"];?></p>
                    <a href="modules/xlDangXuat.php">Đăng xuất</a>
                    <a href="index.php?a=5">
                        <img src="img/manage_shopping.png"/>
                    </a>
                <?php
            }
            else{
                //login out
                ?>
                    <form name="frmLogin" action="modules/xlDangNhap.php" method="post" onsubmit="return KiemTraDangNhap()">
                        Tài khoản:<input name="txtUS" type="text" id="txtUS" size="12" maxlength="20" width="15">
                        Mật khẩu: <input name="txtPS" type="password" id="txtPS" size="12" maxlength="20" width="15">
                        <input type="submit" value="Đăng nhập">
                        <input type="button" value="Đăng ký" onclick="ChuyenTrangDangKy()"/>
                    </form>
                    <script type="text/javascript">
                        function KiemTraDangNhap() {
                            var us = document.getElementById("txtUS").value.trim();
                            var ps = document.getElementById("txtPS").value.trim();

                            if (us === "" || ps === "") {
                                alert("Vui lòng nhập đầy đủ tài khoản và mật khẩu!");
                                return false; // Ngăn form gửi đi
                            }
                            return true; // Cho phép gửi form nếu đủ dữ liệu
                        }
                        function ChuyenTrangDangKy () {
                            location = "index.php?a=6";
                        }
                    </script>
                <?php
            }
        ?>
    </div>
    
    <img src="img/header_1.png">
    
    <!-- <img src="img/header_2.png" width="748"> -->
</div>