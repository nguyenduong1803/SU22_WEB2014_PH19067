<?php
require "database/get.php";
require "database/add.php";
if (isset($_GET['listId']) && isset($_GET['q']) && isset($_GET['phone'])) {
    $today = date("Y-m-d");
    $phone = $_GET['phone'];
    $userId = $_SESSION['id'];
    $listQuantity = explode(',', $_GET['q']);
    $listId = $_GET['listId'];
    echo $today;
    $sqlID = "SELECT maHoaDon FROM `hoadon` WHERE maKh='$userId'  and soDienThoai ='{$phone}' LIMIT 1;";
    $resultBill = db_select($sqlID);
    var_dump($resultBill);
    echo "<br>bill <br>";
    if ($resultBill->num_rows > 0) {
        while ($row = $resultBill->fetch_assoc()) {
            $billId = $row['maHoaDon'];
        }
    }
    echo  "<br>bill:".$billId;
    $products = getProductByListId($listId);
    $values = [];
    (array)$getCookie = json_decode($_COOKIE['list'], true);
    foreach ($products as $key => $value) {
        $money = $value['donGia'] * (100 - $value['mucGiamGia']) / 100;
        $productId = $value['maHangHoa'];
        array_push($values, "( '$productId', '$listQuantity[$key]', '$money', '$billId')");
        echo $productId.'<br>';
    }
    $listValue = implode(',', $values);
    $slqInsert = "INSERT INTO `chitiethd` ( `maHangHoa`, `soLuong`, `soTien`, `maHoaDon`) VALUES {$listValue}";
    echo $listValue.'<br>';
    db_insert($slqInsert);
    $newArr = array_unique($getCookie);
    unset($getCookie['6']);
    unset($getCookie['4']);

    var_dump($newArr);
    var_dump($getCookie);
    setcookie("list", json_encode($newArr));
    // header("Location:?page=checkout");
}
