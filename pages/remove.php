<?php
require "database/connect.php";
require "database/search.php";
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
function db_remove($id, $img)
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
    header("Location:?page=admin");
}
db_remove($id, $img);
