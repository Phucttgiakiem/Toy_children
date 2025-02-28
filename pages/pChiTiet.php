<h1>Thông tin chi tiết sản phẩm</h1>
<?php
    if(isset($_GET["id"]))
        $id = $_GET["id"];
    else 
        DataProvider::ChangeURL("index.php?a=404");

    $sql = "SELECT s.MaSanPham, s.TenSanPham, s.GiaSanPham,s.SoLuongTon,s.SoLuocXem,s.HinhURL,s.MoTa,h.TenHangSanXuat,l.TenLoaiSanPham FROM
    SanPham s,HangSanXuat h, LoaiSanPham l WHERE s.BiXoa = 0 AND s.MaHangSanXuat = h.MaHangSanXuat AND s.MaLoaiSanPham = l.MaLoaiSanPham AND s.MaSanPham = $id";
    $result = DataProvider::ExecuteQuery($sql);
    $row = mysqli_fetch_array($result);

    if($row == null)
        DataProvider::ChangeURL("index.php?a=404");
?>
<div id="chitietsp">
    <div id="chitietleft">
        <img src="images/<?=$row["HinhURL"];?>" alt="">
    </div>
    <div id="chitietright">
        <div>
            <span class="label">Tên sản phẩm:</span>
            <span class="productname"><?php echo $row["TenSanPham"];?></span>
        </div>
        <div>
            <span class="label">Giá:</span>
            <span class="price"><?php echo $row["GiaSanPham"]; ?> đ</span>
        </div>
        <div>
            <span class="label">Hãng sản xuất:</span>
            <span class="factory"><?php echo $row["TenHangSanXuat"];?></span>
        </div>
        <div>
            <span class="label">Số lượng:</span>
            <span class="data"><?php echo $row["SoLuongTon"];?>sản phẩm</span>
        </div>
        <div>
            <span class="label">Số lượt xem:</span>
            <span class="data"><?php echo $row["SoLuocXem"] + 1; ?>lượt</span>
        </div>
        <div class="giohang">
            <?php
                if(isset($_SESSION["MaTaiKhoan"]))
                {
                    ?>
                        <a href="index.php?a=5&id=<?php echo $row["MaSanPham"]; ?>">
                            <img src="img/shopping_cart.png" width="32">
                        </a>
                    <?php
                }
            ?>
        </div>
    </div>
    <div id="mota">
        <?php echo $row["MoTa"]; ?>
    </div>
</div>
<?php
    // update viewer quantity at Database
    $SoLuotXem = $row["SoLuocXem"] + 1;
    $sql = "UPDATE SanPham SET SoLuocXem = $SoLuotXem
            WHERE MaSanPham = $id";
    DataProvider::ExecuteQuery($sql);
?>