<?php 
    global $sharedData;
    $hang = $sharedData["firms"];
    $loaisp = $sharedData["typeproducts"];
?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tạo sản phẩm mới</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin cần điền</div>
            </div>
            <div class="card-body">
            <form id="create_product" action="/Toy_children/admin/Product/createproduct" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="email2">Tên sản phẩm</label>
                            <input
                                type="text"
                                class="form-control"
                                name="nameproduct"
                                value=""
                                required
                            />
                            <div class="invalid-feedback">
                                Tên sản phẩm không được bỏ trống
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Giá sản phẩm</label>
                            <input
                                type="number"
                                class="form-control"
                                name="priceproduct"
                                min="0"
                                value="0"
                                required
                            />
                            <div class="invalid-feedback">
                                Giá sản phẩm không được bỏ trống
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Số lượng tồn</label>
                            <input
                                type="text"
                                class="form-control"
                                name="quatityinhouse"
                                min="0"
                                value="0"
                                required
                            />
                            <div class="invalid-feedback">
                                Số lượng tồn không được bỏ trống
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Số lượng bán</label>
                            <input
                                type="number"
                                class="form-control"
                                name="sellproduct"
                                min = "0"
                                value="0"
                                required
                            />
                            <div class="invalid-feedback">
                                Số lượng bán không được bỏ trống
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Loại sản phẩm</label>
                            <select class="form-select" name="typeproduct" required>
                                <option selected disabled value="">Lựa chọn...</option>
                                <?php 
                                    foreach($loaisp as $key => $value):
                                        $maloai = $value['MaLoaiSanPham'];
                                        $tenloai = $value['TenLoaiSanPham'];
                                        echo "<option value='$maloai'>$tenloai</option>";
                                    endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Tên loại sản phẩm phải được chọn
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email2">Hãng sản xuất</label>
                            <select class="form-select" name="companyname" required>
                                <option selected disabled value="">Lựa chọn...</option>
                                <?php 
                                    foreach($hang as $key => $value):
                                        $mahang = $value['MaHangSanXuat'];
                                        $tenhang = $value['TenHangSanXuat'];
                                        echo "<option value='$mahang'>$tenhang</option>";
                                    endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Tên hãng phải được chọn
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="disableinput">Mô tả sản phẩm</label>
                            <textarea class="form-control" rows="3" name="description" required></textarea>
                            <div class="invalid-feedback">
                                Mô tả sản phẩm không được bỏ trống
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="text-start">
                            <img id="imgPreview" src="/Toy_children/public/assets/img/no_image.jpg" class="rounded img-thumbnail w-50 h-50" alt="...">
                        </div>
                        <div class="input-group mb-2 mt-4">
                            <input type="file" class="form-control" name="fileproduct" id="inputGroupFile02"  accept="image/*">
                        </div>
                    </div>
                </div>
                </div>
                    <div class="card-action">
                        <a href="/Toy_children/admin/Product/Index" class="btn btn-danger">Quay lại</a>
                        <button type="submit" class="btn btn-primary" id="btn-create-pd">Tạo</button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</div>
<script>
    // (function () {
        
    //     'use strict'

        // Lấy tất cả các form có class 'needs-validation'
       // var forms = document.querySelectorAll('.needs-validation')

        // Lặp qua tất cả các form và thêm sự kiện submit
        // Array.prototype.slice.call(forms)
        //     .forEach(function (form) {
        //         form.addEventListener('submit', function (event) {
        //             // Nếu form không hợp lệ
        //             if (!form.checkValidity()) {
        //                 event.preventDefault()  // Ngừng gửi form
        //                 event.stopPropagation()  // Ngừng sự kiện
        //             }
        //             // Thêm lớp 'was-validated' để hiển thị thông báo
        //             form.classList.add('was-validated')
        //         }, false)
        //     })
        // // Lắng nghe sự kiện thay đổi (change) trên input file
        // document.getElementById('inputGroupFile02').addEventListener('change', function(event) {
        //     // Lấy file từ input
        //     const file = event.target.files[0];

        //     // Kiểm tra xem người dùng đã chọn file chưa
        //     if (file) {
        //         // Tạo URL từ tệp được chọn
        //         const reader = new FileReader();

        //         // Khi file được đọc thành công
        //         reader.onload = function(e) {
        //             // Cập nhật thuộc tính src của thẻ img
        //             document.getElementById('imgPreview').src = e.target.result;
        //         };

        //         // Đọc file dưới dạng URL data
        //         reader.readAsDataURL(file);
        //     }
        // });
   // })()
</script>

