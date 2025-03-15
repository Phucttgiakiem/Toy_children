<?php 
     global $sharedData;
     $shopping_card = $sharedData['shopping_card'];
     $total_bill = 0;
?>
<!-- Single Page Header start -->
<!-- <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div> -->
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table table-shoppingcard">
                <thead>
                    <tr>
                    <th class="text-center" scope="col">Products</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Quantity</th>
                    <th class="text-center" scope="col">Total</th>
                    <th class="text-center" scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($shopping_card) > 0){
                  foreach($shopping_card as $item):?>
                    <tr id="<?=$item->id?>">
                        <td class="d-flex justify-content-center" >
                            <div class="d-flex align-items-center">
                                <img src="<?=strpos($item->img,"Toy_children") ? $item->img:"/Toy_children/".$item->img ?>" class="img-fluid rounded-circle img-shoppingcard" alt="">
                            </div>
                        </td>
                        <td class="text-center align-middle">
                            <a href="/Toy_children/Product/Detailproduct/<?=$item->id?>" class="mb-0 text-dark"><?=$item->name?></a>
                        </td>
                        <td class="text-center align-middle">
                            <p class="mb-0"><?=$item->price?> đ</p>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center input-group quantity m-auto" style="width: max-content;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border btn-shoppingcard" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input id="update-quantity" type="text" class="text-center border-0" value="<?=$item->quantity?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border btn-shoppingcard">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="text-center align-middle">
                            <p id="totalpriceitem" class="mb-0"><?=$item->totalprice?> đ</p>
                        </td>
                        <td class="align-middle">
                            

                                <!-- Các nút button hiển thị theo chiều ngang trên màn hình lớn -->
                                <div class="d-flex justify-content-evenly">
                                <button class="btn btn-md rounded-circle bg-light border dl-sp btn-shoppingcard" data-id="<?=$item->id?>">
                                    <i class="fa-solid fa-xmark text-danger"></i>
                                </button>
                                <button class="btn btn-md rounded-circle bg-light border ud-sp btn-shoppingcard" data-id="<?=$item->id?>">
                                    <i class="fa-solid fa-arrow-up-from-bracket text-warning"></i>
                                </button>
                                </div>
                            
                        </td>
                    </tr>
                <?php 
                    $total_bill += $item->totalprice;
                    endforeach;
                }else {?>
                    <tr>
                        <td colspan="6">Không có sản phẩm trong giỏ hàng</td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Đơn hàng</h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Tạm tính:</h5>
                            <p class="mb-0 subtotal"><?=$total_bill?> đ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Vận chuyển</h5>
                            <div class="">
                                <p class="mb-0">Tỷ giá cố định: $0.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Vận chuyển từ Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Tổng</h5>
                        <p class="mb-0 pe-4 Total-bill"><?=$total_bill?> đ</p>
                    </div>
                        <?php 
                            if($total_bill > 0){
                                echo "<a href='/Toy_children/Checkout/checkoutbill' class='btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4' >Tiến hành thanh toán</a>";
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


      