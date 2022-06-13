<?php
require "database/select.php";
function getProduct()
{
    $list = [];
    $sql = "SELECT * FROM `hanghoa`";
    $result = db_select($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($list, $row);
        }
    }
    return $list;
}
function getProductbyCate($categoryName)
{
    $list = [];
    $sql = "SELECT * FROM `hanghoa` 
    INNER JOIN loaihang on hanghoa.maLoaiHang = loaihang.maLoaiHang
     WHERE loaihang.tenLoaiHang ='{$categoryName}';";
    $result = db_select($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($list, $row);
        }
    }
    return $list;
}
function getProductById($id)
{
    if (is_array($id) && count($id) > 0) {
        $listID = implode(",", $id);
        $list = [];
        $sql = "SELECT * FROM `hanghoa` WHERE maHangHoa in ({$listID})";
        $result = db_select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($list, $row);
            }
        }
        return $list;
    } elseif ($id) {
        $list = [];
        $sql = "SELECT * FROM `hanghoa` WHERE maHangHoa='{$id}'";
        $result = db_select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($list, $row);
            }
        }
        return $list;
    } else {
        return [];
    }
}
function getProductByListId($list)
{
    $lists = [];
    $sql = "SELECT * FROM `hanghoa` WHERE maHangHoa in ({$list})";
    $result = db_select($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($lists, $row);
        }
    }
    return $lists;
}
function getCategory()
{
    $sqlCate = "SELECT * From `loaihang`";
    $kq = db_select($sqlCate);
    $cateArr = [];
    if ($kq->num_rows > 0) {
        while ($row2 = $kq->fetch_assoc()) {
            array_push($cateArr, $row2);
        }
    }
    return $cateArr;
}
function getUserById($id)
{
    if (is_array($id) && count($id) > 0) {
        $listID = implode(",", $id);
        $list = [];
        $sql = "SELECT * FROM `khachHang` WHERE maKh in ({$listID})";
        $result = db_select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($list, $row);
            }
        }
        return $list;
    } elseif ($id === "*") {
        $list = [];
        $sql = "SELECT * FROM `khachHang`";
        $result = db_select($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($list, $row);
            }
        }
        return $list;
    } else {

        $sql = "SELECT * FROM `khachHang` WHERE `maKh`={$id} Limit 1";
        $kq = db_select($sql);
        $list = [];
        if ($kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                array_push($list, $row);
            }
        }
        return $list;
    }
}
function getComment($id)
{
    $sql = "SELECT * FROM `binhluan` WHERE maHangHoa = $id";
    $kq = db_select($sql);
    $list = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($list, $row);
        }
    }
    return $list;
}
function joinUserCmt($maKh)
{
    $sql = "SELECT * FROM `khachhang` inner join `binhluan` on binhluan.maKh = `khachHang`.maKh where binhluan.maKh =$maKh limit 1";
    $kq = db_select($sql);
    $user = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($user, $row);
        }
    }
    return $user;
}

function getInvoice($id)
{
    if ($id == "*") {
        $sql = "SELECT * FROM `hoadon`";
        $kq = db_select($sql);
        $invoice = [];
        if ($kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                array_push($invoice, $row);
            }
        }
        return $invoice;
    } else {
        $sql = "SELECT * FROM `hoadon` WHERE `maHoaDon`= '{$id}'";
        $kq = db_select($sql);
        $invoice = [];
        if ($kq->num_rows > 0) {
            while ($row = $kq->fetch_assoc()) {
                array_push($invoice, $row);
            }
        }
        return $invoice;
    }
}
function getDetailIvoice($maHd)
{
    $sql = "SELECT * FROM `chitiethd` inner join `hoaDon` on hoaDon.maHoaDon = `chiTiethd`.maHoaDon where chitiethd.maHoaDon ={$maHd}";
    $kq = db_select($sql);
    $invoice = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($invoice, $row);
        }
    }
    return $invoice;
}
function statisticalView()
{
    $sql = "SELECT tenHangHoa,soLuotXem FROM `hangHoa` ORDER BY soLuotXem DESC LIMIT 10;";
    $kq = db_select($sql);
    $products = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($products, $row);
        }
    }
    return $products;
}
function statisticalSold()
{
    $sql = "SELECT sum(chitiethd.soLuong) as quantity,hanghoa.tenHangHoa, count(chitiethd.maHangHoa) 
    FROM chitiethd INNER JOIN hanghoa ON hanghoa.maHangHoa=chitiethd.maHangHoa 
    GROUP by hangHoa.tenHangHoa ORDER by(sum(soLuong))
    DESC LIMIT 5;";
    $kq = db_select($sql);
    $solds = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($solds, $row);
        }
    }
    return $solds;
}
function statisUserBought()
{
    $sql = "SELECT sum(chitiethd.soLuong) as quantity,count(hoadon.maKh) ,khachhang.tenKh 
    FROM chitiethd INNER JOIN hanghoa ON hanghoa.maHangHoa=chitiethd.maHangHoa 
    INNER JOIN hoadon ON hoadon.maHoaDon =chitiethd.maHoaDon 
    INNER JOIN khachhang On hoadon.maKh =khachhang.maKh 
    GROUP by khachhang.tenKh ORDER by(sum(soLuong)) DESC LIMIT 5;";
    $kq = db_select($sql);
    $solds = [];
    if ($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()) {
            array_push($solds, $row);
        }
    }
    return $solds;
}
