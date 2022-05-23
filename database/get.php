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
