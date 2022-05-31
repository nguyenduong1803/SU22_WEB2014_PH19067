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
function getProductById($id)
{
    $list = [];
    $sql = "SELECT * FROM `hanghoa` WHERE maHangHoa={$id}";
    $result = db_select($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($list, $row);
        }
    }
    return $list;
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
function getUserById ($id){
    $sql="SELECT * FROM `khachHang` WHERE `makh`={$id} Limit 1";
    $kq = db_select($sql);
    $list =[];
    if($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()){
            array_push($list, $row);
        }
    }
    return $list;
}
function getComment ($id){
    $sql="SELECT * FROM `binhluan` WHERE maHangHoa = $id";
    $kq = db_select($sql);
    $list =[];
    if($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()){
            array_push($list, $row);
        }
    }
    return $list;
}
function joinUserCmt ($maKh){
    $sql="SELECT * FROM `khachhang` inner join `binhluan` on binhluan.maKh = `khachHang`.maKh where binhluan.maKh =$maKh limit 1";
    $kq = db_select($sql);
    $user =[];
    if($kq->num_rows > 0) {
        while ($row = $kq->fetch_assoc()){
            array_push($user, $row);
        }
    }
    return $user;
}