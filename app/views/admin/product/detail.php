<?php 
    $product = $sharedData['product'];
?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chi tiết sản phẩm</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin sản phẩm</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="email2">Tên sản phẩm</label>
                        <input
                        type="text"
                        class="form-control"
                        id="fullname"
                        value="<?=$product['TenSanPham']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="username">Tên hãng sản xuất</label>
                        <input
                        type="text"
                        class="form-control"
                        id="username"
                        value="<?=$product['TenHangSanXuat']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Loại sản phẩm</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$product['TenLoaiSanPham']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Số lượng tồn</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$product['SoLuongTon']?> cái"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Số lượng bán</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$product['SoLuongBan']?> cái"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Mô tả sản phẩm</label>
                        <textarea class="form-control" rows="3" disabled><?=$product['MoTa']?></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                <div class="text-center">
                    <img src="/Toy_children/public/assets/img/<?=$product['HinhURL']?>" class="rounded img-thumbnail" alt="...">
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <a href="/Toy_children/admin/product" class="btn btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>