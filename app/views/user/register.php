<div class="container-fluid" style="margin-top:10rem">
    <div class="container py-5">
        <form>
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="res-username">
                <p id="warning-res-username" class="text-danger mb-2" style="display:none">Tên đăng nhập không được để trống<p>
            </div>
            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="res-fullname">
                <p id="warning-res-fullname" class="text-danger mb-2" style="display:none">Họ và tên không được để trống<p>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" id="res-email">
                <p id="warning-res-email" class="text-danger mb-2" style="display:none">Email không được để trống<p>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="res-address">
                <p id="warning-res-address" class="text-danger mb-2" style="display:none">Địa chỉ không được để trống<p>
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="res-numberphone" aria-describedby="emailHelp">
                <p id="warning-numberphone" class="text-danger mb-2" style="display:none">Số điện thoại không được để trống<p>
            </div>
            <div class="mb-3 ">
                <label class="form-label">Mật khẩu</label>
                <div class="position-relative">
                    <input type="password" class="form-control z-1" id="res-pass" placeholder="Mật khẩu phải bao gồm chữ, số và một ký tự đặc biệt">
                    <span id="showpass" class="position-absolute z-2 top-50 end-0 mx-3 translate-middle-y">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span id="hidepass" class="position-absolute z-3 top-50 end-0 mx-3 translate-middle-y" style="display:none">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
                <p id="warning-res-pass" class="text-danger mb-2" style="display:none">Mật khẩu không được để trống<p>
            </div>
            <div class="mb-3 ">
                <label class="form-label">Nhập lại mật khẩu</label>
                <div class="position-relative">
                    <input type="password" class="form-control z-1" id="res-repass">
                    <span id="showpass" class="position-absolute z-2 top-50 end-0 mx-3 translate-middle-y">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span id="hidepass" class="position-absolute z-3 top-50 end-0 mx-3 translate-middle-y" style="display:none">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
                <p id="warning-repass" class="text-danger mb-2" style="display:none">Nhập lại mật khẩu không được để trống<p>
            </div>
            <div class="mb-3">
                <span style="cursor:pointer">Quay lại đăng nhập</span>
            </div>
            <button type="submit" class="btn btn-primary f-register">Đăng ký tài khoản</button>
        </form>
    </div>
</div>