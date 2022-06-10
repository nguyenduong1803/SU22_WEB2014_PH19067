<?php
if (!isset($_SESSION['username']) && !$_SESSION['username'] === "admin") {
    die("không thể truy cập");
}
require "database/connect.php";
require "database/search.php";

if (isset($_GET['remove'])) {

    $id = (int)$_GET['remove'];
    $sql2 = "SELECT * FROM `hanghoa` WHERE `hanghoa`.`maHangHoa` = {$id}";
    $result = db_search($sql2);
    var_dump($result);
    $img = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['hinhAnh'];
        }
    }
    removeProduct($id, $img);
} else if (isset($_GET['categoryID'])) {

    $id = $_GET['categoryID'];
    db_remove($id, "loaiHang", "maLoaiHang", "manageCategory", "=");
} else if (isset($_REQUEST['q'])) {

    $listID = $_REQUEST['q'];
    $id =  " {$listID}";
    echo $id;
    db_remove($id, "loaiHang", "maLoaiHang", "manageCategory", "in");
} else if (isset($_GET['removeCmt'])) {
    
    $id = $_GET['removeCmt'];
    $productId = $_GET['productId'];
    db_remove($id, "binhluan", "maBinhLuan", "manageComments&&id={$productId}", "=");
} else if (isset($_GET['removeCookie'])) {

    (array)$getCookie = json_decode($_COOKIE['list'],true);
    $index = array_search((int)$_GET['removeCookie'],  (array)$getCookie);
    unset($getCookie[$index]);
    $newArr = array_unique($getCookie);
    setcookie("list", json_encode($newArr));
    header("Location:?page=cart");
}else if (isset($_GET['userRemove'])){

    $id = $_GET['userRemove'];
    db_remove($id, "khachHang", "maKh", "manageUser", "=");
}





function db_remove($id, $table, $nameID, $to, $char)
{
    $conn = new mysqli("localhost", "root", "", "xshop");
    if ($conn->connect_error) {
        echo "kết nối thất bại";
    } else {
        if ($char === "in") {
            $newId = "($id)";
        } else {
            $newId = $id;
        }
        $sql = "DELETE FROM {$table} WHERE `{$table}`.`{$nameID}` $char {$newId}";
        echo $sql;
        if ($conn->query($sql) === true) {
            echo "xóa thành công";
        } else {
            echo "xóa thất bại" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    header("Location:?page={$to}");
}


function removeProduct($id, $img)
{
    $conn = new mysqli("localhost", "root", "", "xshop");
    if ($conn->connect_error) {
        echo "kết nối thất bại";
    } else {
        $sql = "DELETE FROM hanghoa WHERE `hanghoa`.`maHangHoa` = {$id}";
        if ($conn->query($sql) === true) {
            echo "xóa thành công";
            if (file_exists($img)) {
                unlink($img);
            }
        } else {
            echo "xóa thất bại" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    header("Location:?page=manageProduct");
}
