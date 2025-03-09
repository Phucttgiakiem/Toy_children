<?php 
    $loaisp = $sharedData['loaisp'];
?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chỉnh sửa loại sản phẩm</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin loại sản phẩm</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="form-group">
                        <label for="email2">Tên loại sản phẩm</label>
                        <input
                        type="text"
                        class="form-control"
                        id="tenloaisanpham"
                        value="<?=$loaisp['TenLoaiSanPham']?>"
                    
                        />
                        <small id="tenlsp-notice" class="form-text text-muted">Tên loại sản phẩm không được để trống</small>
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <a href="/Toy_children/admin/typeproduct" class="btn btn-danger">Quay lại</a>
                    <button type="button" class="btn btn-primary" id="updatetypeProduct" data-id="<?=$loaisp['MaLoaiSanPham']?>">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</div>