<?php 
    global $sharedData;
    $account = $sharedData["accountinfo"];
    $shopping_card = $sharedData['shoppingcard'];
     $total_bill = 0;

?>

<!-- Checkout Page Start -->
<div class="container-fluid py-5" style="margin-top:10rem">
            <div class="container py-5">
                <h1 class="mb-4">Chi tiết đơn hàng</h1>
                <form action="#">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Tên đầu tiên<sup>*</sup></label>
                                        <input id="tendautien" type="text" class="form-control">
                                        <p id="error_firstname" class="form-text text-danger mt-2 d-none">Tên không được bỏ trống</p>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Tên họ<sup>*</sup></label>
                                        <input id="tenho" type="text" class="form-control">
                                        <p id="error_lastname" class="form-text text-danger d-none mt-2">Tên họ không được bỏ trống</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ giao hàng <sup>*</sup></label>
                                <input id="diachigiaohang" type="text" class="form-control" value="<?=$account["DiaChi"] ?>">
                                <p id="error_area" class="form-text text-danger d-none mt-2">Địa chỉ giao hàng không được để trống</p>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Điện thoại<sup>*</sup></label>
                                <input id="dienthoai" type="tel" class="form-control" value="<?=$account["DienThoai"]?>">
                                <p id="error_numberphone" class="form-text text-danger d-none mt-2" >Số điện thoại không được để trống</p>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email<sup>*</sup></label>
                                <input id="email" type="email" class="form-control" value="<?=$account["Email"]?>">
                                <p id="error_email" class="form-text text-danger d-none mt-2" >Email không được để trống</p>
                            </div>
                            <hr>
                            <div class="form-item">
                                <textarea id="ghichu" name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Giá (đ)</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Tổng (đ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                             foreach($shopping_card as $item):
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="<?=strpos($item->img,"Toy_children") ? $item->img:'/Toy_children/'.$item->img ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?=$item->name?></td>
                                            <td class="py-5"><?=number_format($item->price,0, '.', ',')?></td>
                                            <td class="py-5"><?=$item->quantity?></td>
                                            <td class="py-5"><?=number_format($item->totalprice,0, '.', ',')?></td>
                                        </tr>
                                       
                                        <?php 
                                            $total_bill += $item->totalprice;
                                             endforeach;
                                        ?>
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5 px-0">
                                                <div class="py-3">
                                                    <p id="total_bill" class="mb-0 text-dark"><?=number_format($total_bill,0, '.', ',')?> đ</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button id="placeorther" type="button" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" data-id="<?=$account["MaTaiKhoan"]?>">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->

