<div class="container-fluid" style="margin-top:10rem">
    <div class="container py-5">
        <form>
            <div class="mb-3">
                <label for="exampleInputusername1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="exampleInputusername1" aria-describedby="emailHelp">
                <p id="warning-usn" class="text-danger mb-2" style="display:none">Tên đăng nhập không được để trống<p>
            </div>
            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <div class="position-relative">
                    <input type="password" class="form-control z-1" id="exampleInputPassword1">
                    <span id="showpass" class="position-absolute z-2 top-50 end-0 mx-3 translate-middle-y">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span id="hidepass" class="position-absolute z-3 top-50 end-0 mx-3 translate-middle-y" style="display:none">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
                <p id="warning-pass" class="text-danger mb-2" style="display:none">Mật khẩu không được để trống<p>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Ghi nhớ đăng nhập</label>
            </div>
            <div class="mb-2">
                <a href="/Toy_children/User/Forgotpass" style="cursor:pointer">Quên mặt khâu</a>
            </div>
            <div class="mb-3">
                <a href="/Toy_children/User/Register" style="cursor:pointer">Đăng ký tài khoản</span>
            </div>
            <button type="submit" class="btn btn-primary f-login">Đăng nhập</button>
        </form>
    </div>
</div>
