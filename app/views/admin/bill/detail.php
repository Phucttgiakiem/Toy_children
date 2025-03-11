<?php
    $infobill = $sharedData['infobill'];
    $detailbill = $sharedData['detailbill'];
    $tinhtrang = $sharedData['Tinhtrang'];

?>
<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chi tiết đơn hàng</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin đơn đặt hàng</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="form-group">
                        <label for="email2">Tên người đặt hàng</label>
                        <input
                        type="text"
                        class="form-control"
                        id="fullname"
                        value="<?=$infobill['TenHienThi']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Tên đăng nhập</label>
                        <input
                        type="text"
                        class="form-control"
                        id="username"
                        value="<?=$infobill['TenDangNhap']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Địa chỉ</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$infobill['DiaChi']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Email</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$infobill['Email']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Điện thoại</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$infobill['DienThoai']?>"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="disableinput">Tổng tiền đơn hàng</label>
                        <input
                        type="text"
                        class="form-control"
                        id="disableinput"
                        value="<?=$infobill['TongThanhTien']?> đ"
                        disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"
                        >Tình trạng đơn hàng</label
                        >
                        <select
                        class="form-control"
                        id="exampleFormControlSelect1"
                        <?php if($infobill['MaTinhTrang'] == 4) echo "disabled readonly"?>
                        >
                        <?php 
                            foreach ($tinhtrang as $key => $value) {
                                if ($value['MaTinhTrang'] == $infobill['MaTinhTrang']) {
                                    echo "<option value='".$value['MaTinhTrang']."' selected>".$value['TenTinhTrang']."</option>";
                                }else{
                                    echo "<option value='".$value['MaTinhTrang']."'>".$value['TenTinhTrang']."</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <button class="btn btn-success" id="update-status-bill" data-id="<?=$infobill['MaDonDatHang']?>">Cập nhật trạng thái</button>
                    <a href="/Toy_children/admin/Bill" class="btn btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Danh sách mặt hàng đã mua</div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình</th>
                    <th>Số sản phẩm mua</th>
                    <th>Giá bán</th>
                    <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                        $stt = 1;
                        foreach ($detailbill as $key => $value) {
                            echo "<tr>";
                            echo "<th scope='row'>".$stt."</th>";
                            echo "<td>".$value['TenSanPham']."</td>";
                            echo "<td><img src='/Toy_children/public/assets/img/".$value['HinhURL']."' width='50px' height='50px'></td>";
                            echo "<td>".$value['SoLuong']."</td>";
                            echo "<td>".$value['GiaBan']." đ</td>";
                            echo "<td>".$value['SoLuong']*$value['GiaBan']." đ</td>";
                            echo "</tr>";
                            $stt++;
                        }
                    ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

