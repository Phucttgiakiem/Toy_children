<?php 
    $account = $sharedData['account'];
?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chi tiết người dùng</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin tài khoản</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="form-group">
                        <label for="email2">Tên tài khoản</label>
                        <input
                        type="text"
                        class="form-control"
                        id="fullname"
                        value="<?=$account['TenDangNhap']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="username">Tên Hiển thị</label>
                        <input
                        type="text"
                        class="form-control"
                        id="username"
                        value="<?=$account['TenHienThi']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Địa chỉ</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$account['DiaChi']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Số điện thoại</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$account['DienThoai']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Email</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$account['Email']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Loại tài khoản</label>
                        <input
                            type="text"
                            class="form-control"
                            id="disableinput"
                            value="<?=$account['TenLoaiTaiKhoan']?>"
                            disabled
                        />
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <a href="/Toy_children/admin/account" class="btn btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
