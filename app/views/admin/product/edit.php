<?php 
    $product = $sharedData['product'];
    $loaisp = $sharedData['loaisp'];
    $hangsx = $sharedData['hangsx'];
?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chỉnh sửa sản phẩm</h3>
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
                        id="tensanpham"
                        value="<?=$product['TenSanPham']?>"
                    
                        />
                        <small id="tensp-notice" class="form-text text-muted">Tên sản phẩm không được để trống</small>
                    </div>
                    <div class="form-group">
                        <label for="username">Tên hãng sản xuất</label>
                        <select class="form-select" id="hangsx">
                            <?php foreach($hangsx as $key => $value): ?>
                                <option value="<?=$value['MaHangSanXuat']?>" <?php if($value['MaHangSanXuat'] == $product['MaHangSanXuat']) echo "selected"; ?>><?=$value['TenHangSanXuat']?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="hangsx-notice" class="form-text text-muted">Tên hãng sản xuất không được để trống</small>
                    </div>
                    <div class="form-group">
                        <label for="">Loại sản phẩm</label>
                        <select class="form-select" id="loaisp">
                            <?php foreach($loaisp as $key => $value): ?>
                                <option value="<?=$value['MaLoaiSanPham']?>" <?php if($value['MaLoaiSanPham'] == $product['MaLoaiSanPham']) echo "selected"; ?>><?=$value['TenLoaiSanPham']?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="loaisp-notice" class="form-text text-muted">Loại sản phẩm không được để trống</small>
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Số lượng tồn</label>
                        <input
                        type="number"
                        class="form-control"
                        id="soluongton"
                        min="0"
                        value="<?=$product['SoLuongTon']?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Số lượng bán</label>
                        <input
                        type="number"
                        class="form-control"
                        id="soluongban"
                        min="0"
                        value="<?=$product['SoLuongBan']?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Giá bán (đ)</label>
                        <input
                        type="number"
                        class="form-control"
                        id="giaban"
                        min="0"
                        value="<?=$product['GiaSanPham']?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Mô tả sản phẩm</label>
                        <textarea class="form-control" rows="3" id="mota"><?=$product['MoTa']?></textarea>
                        <small id="mota-sp" class="form-text text-muted">Mô tả sản phẩm không được để trống</small>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="text-start">
                        <img id="imgsp" src="/Toy_children/public/assets/img/<?=$product['HinhURL']?>" class="rounded img-thumbnail w-50 h-50" alt="...">
                    </div>
                    <div class="input-group mb-2 mt-4">
                        <input type="file" class="form-control" id="inputGroupFile01">
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <a href="/Toy_children/admin/product" class="btn btn-danger">Quay lại</a>
                    <button type="button" class="btn btn-primary" id="updateProduct" data-id="<?=$product['MaSanPham']?>">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</div>