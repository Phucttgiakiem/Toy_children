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
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($shopping_card) > 0){
                  foreach($shopping_card as $item):?>
                    <tr id="<?=$item->id?>">
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="<?=strpos($item->img,"Toy_children") ? $item->img:"/Toy_children/".$item->img ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4"><?=$item->name?></p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4"><?=$item->price?> đ</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="<?=$item->quantity?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4"><?=$item->totalprice?> đ</p>
                        </td>
                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4 dl-sp" data-id="<?=$item->id?>">
                                <i class="fa-solid fa-xmark text-danger"></i>
                            </button>
                            <button class="btn btn-md rounded-circle bg-light border mt-4 ud-sp" data-id="<?=$item->id?>">
                                <i class="fa-solid fa-arrow-up-from-bracket text-warning"></i>
                            </button>
                            <button class="btn btn-md rounded-circle bg-light border mt-4 w-sp" data-id="<?=$item->id?>">
                                <i class="fa-solid fa-info text-success"></i>
                            </button>
                        </td>
                    </tr>
                <?php 
                    $total_bill += $item->totalprice;
                    endforeach;
                }?>
                
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
                                <p class="mb-0">Flat rate: $0.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Tổng</h5>
                        <p class="mb-0 pe-4 Total-bill"><?=$total_bill?> đ</p>
                    </div>
                        <?php 
                            if($total_bill > 0){
                                echo "<a href='/Toy_children/Checkout/checkoutbill' class='btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4' >Proceed Checkout</a>";
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


      