<div class="wtaotaikhoan">
    <h1>Tạo tài khoản mới</h1>
    <form action="pages/TaoTaiKhoan/xlTaoTaiKhoan.php" method="post" onsubmit="return KiemTra()">
        <div>
            <input type="text" id="us" name="us" placeholder="Tên đăng nhập">
            <span class="err" id="eUS"></span>
        </div>
        <div>
            <input type="password" id="ps" name="ps" placeholder="Mật khẩu">
            <span class="err" id="ePS"></span>
        </div>
        <div>
            <input type="password" id="rps" placeholder="Nhập lại mật khẩu"/>
            <span class="err" id="eRPS"></span>
        </div>
        <div>
            <input type="text" id="name" name="name" placeholder="Tên hiển thị">
            <span class="err" id="eNAME"></span>
        </div>
        <div>
            <input type="text" id="add" name="add" placeholder="Địa chỉ">
            <span class="err" id="eADD"></span>
        </div>
        <div>
            <input type="text" id="tel" name="tel" placeholder="Điện thoại">
            <span class="err" id="eTEL"></span>
        </div>
        <div>
            <input type="text" id="mail" name="mail" placeholder="Email">
            <span class="err" id="eMail"></span>
        </div>
        <div>
            <span class="label"></span>
            <input type="submit" value="Đăng ký"/>
        </div>
    </form>
</div>
<script type="text/javascript">
    function KiemTra() {
        var co = true;
        var control = document.getElementById('us');
        var err = document.getElementById('eUS');
        if(control.value == ""){
            co = false;
            err.innerHTML = "Tên đăng nhập không được rỗng";
        }
        else 
        {
            err.innerHTML = "";
        }
        control = document.getElementById('ps');
        err = document.getElementById('ePS');
        if(control.value == "")
        {
            co = false;
            err.innerHTML = "Mật khẩu không được rỗng";
        }
        else
        {
            err.innerHTML = "";
        }
        control1 = document.getElementById('rps');
        err = document.getElementById('eRPS');
        if(control1.value == ""){
            co = false;
            err.innerHTML = "Nhập lại mật khẩu không được rỗng"
        }else {
            if(control.value != control1.value)
            {
                co = false;
                err.innerHTML = "Nhập lại mật khẩu không trùng";
            }
            else
            {
                err.innerHTML = "";
            }
        }
        control = document.getElementById('name');
        err= document.getElementById('eNAME');
        if(control.value == "")
        {
            co = false;
            err.innerHTML = "Tên hiển thị không được rỗng";
        }
        else
        {
            err.innerHTML = "";
        }
        control = document.getElementById('add');
        err = document.getElementById('eADD');
        if(control.value == "")
        {
            co = false;
            err.innerHTML = "Địa chỉ không được rỗng";
        }
        else
        {
            err.innerHTML = "";
        }
        control = document.getElementById('tel');
        err = document.getElementById('eTEL');
        if(control.value == "")
        {
            co = false;
            err.innerHTML = "Số điện thoại không được rỗng";
        }
        else
        {
            err.innerHTML = "";
        }
        control = document.getElementById('mail');
        err = document.getElementById('eMail');
        if(control.value == "")
        {
            co = false;
            err.innerHTML = "Email không được rỗng";
        }
        else 
        {
            err.innerHTML = "";
        }
        return co;
    }
</script>
<?php   
    if(isset($_GET["err"]))
    {
        ?>
            <div>
                <span class="err">Tên đăng nhập đã tồn tại</span>
        </div>
        <?php
    }
?>