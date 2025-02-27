<dl>
    <dt>Loại sản phẩm</dt>
    <?php
        $sql = "SELECT * FROM LoaiSanPham WHERE BiXoa = 0";
        $result = DataProvider::ExecuteQuery($sql);
        while($row = mysqli_fetch_array($result))
        {
            ?>
                <dd>
                    <a href="index.php?a=2&id=<?php echo $row["MaLoaiSanPham"];?>">
                        <?php echo $row["TenLoaiSanPham"]; ?>
                    </a>
            <?php
        }
    ?>
</dl>