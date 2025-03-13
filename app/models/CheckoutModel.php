<?php 
    class CheckoutModel extends Database {
        public function other ($id,$giohang,$totalprice,$Diachigiaohang,$Ghichu){
            //tạo mã đơn đặt hàng định dạng YYmmddxxxx
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $ngayLap = date("Y-m-d H:i:s");
            $ngayLaprutgon = date("Y-m-d");
            $sql = "SELECT MaDonDatHang FROM DonDatHang WHERE NgayLap like '$ngayLaprutgon%' ORDER BY MaDonDatHang DESC LIMIT 1";
            $stmt = $this->fetchOne($sql);

            $sttMaDonDatHang = 0;
            if($stmt != null)
            {
                $sttMaDonDatHang = substr($stmt["MaDonDatHang"],6,3);
            }
            $sttMaDonDatHang += 1;
            $sttMaDonDatHang = sprintf("%03s",$sttMaDonDatHang);
            $maDonDatHang = date("d").date("m").substr(date("Y"),2,2).$sttMaDonDatHang;

            $sql = "INSERT INTO DonDatHang(MaDonDatHang,NgayLap,TongThanhTien,MaTaiKhoan,MaTinhTrang,DiaChiGiaoHang,GhiChu) VALUES (?,?,?,?,?,?,?)";
            $params = [$maDonDatHang,$ngayLap,(int)$totalprice,(int)$id,1,$Diachigiaohang,$Ghichu];
            $stmt = $this->execute($sql,$params);
            if(!$stmt){
                return 1;
            }
            $i = 0;
            foreach($giohang as $item){
                $sql = "INSERT INTO ChiTietDonDatHang(MaChiTietDonDatHang,SoLuong,GiaBan,MaDonDatHang,MaSanPham) VALUES (?,?,?,?,?)";
                $sttChiTietDonDatHang = sprintf("%02s",$i);
                $maChiTietDonDatHang = $maDonDatHang.$sttChiTietDonDatHang;
                $params = [$maChiTietDonDatHang,(int)$item->quantity,(int)$item->price,$maDonDatHang,(int)$item->id];
                $stmt2 = $this->execute($sql,$params);
                if(!$stmt2){
                    $sql = "DELETE FROM ChiTietDonDatHang WHERE MaDonDatHang = $maDonDatHang";
                    $this->execute($sql);
                    $sql = "DELETE FROM DonDatHang WHERE MaDonDatHang = $maDonDatHang";
                    $this->execute($sql);
                    return 2;
                }
                $i++;
            }
            return 0;
        }
    }
?>