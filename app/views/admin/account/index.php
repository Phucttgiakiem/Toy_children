<?php 
    global $sharedData;
    $accounts = $sharedData['account'];
?>
<div class="container">
        <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-between align-items-center px-4 py-2">
                    <h4 class="card-title">Danh sách người dùng</h4>
                </div>
                </div>
                <div class="card-body">
                
                <div
                    class="modal fade"
                    id="addRowModal"
                    tabindex="-1"
                    role="dialog"
                    aria-hidden="true"
                >
                </div> 

                <div class="table-responsive">
                    <table
                    id="add-row"
                    class="display table table-striped table-hover"
                    >
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Tên tài khoản</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th style="width: 10%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($accounts) > 0){
                        $stt = 1;
                        foreach($accounts as $item):
                    ?>
                        <tr>
                            <td><?=$stt ?></td>
                            <td><?=$item['TenDangNhap']?></td>
                            <td><?=$item['DienThoai']?></td>
                            <td><?=$item['DiaChi']?></td>
                            <td>
                            <?php 
                                if($item['BiXoa'] == 1){
                                    echo '<i class="fa-solid fa-lock text-warning"></i>';
                                }else {
                                    echo '<i class="fa-solid fa-lock-open"></i>';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="form-button-action">
                                <a
                                    href="/Toy_children/admin/account/detail/<?=$item['MaTaiKhoan'] ?>"
                                    class="btn btn-link btn-primary btn-lg"
                                    id="Detail"
                                >
                                    <i class="fa-solid fa-circle-info"></i>
                                    
                                </a>
                                <?php
                                    if($item['TenDangNhap'] !== "admin"){
                                    $maTaiKhoan = $item['MaTaiKhoan'];  // Lấy giá trị MaTaiKhoan ra ngoài
                                        echo "<a href='/Toy_children/admin/account/update/$maTaiKhoan'
                                                class='btn btn-link btn-warning btn-lg'>
                                                <i class='fa-solid fa-lock text-danger'></i>
                                            </a>";
                                    }
                                ?>
                                </div>
                            </td>
                        </tr>
                        <?php $stt++; endforeach; } ?>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>