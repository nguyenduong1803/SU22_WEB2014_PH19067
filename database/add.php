<?php
// require "connect.php";

// insert USER

function db_insert($sql)
{
    $conn = new mysqli("localhost", "root", "", "xshop");
    // global $conn;
    if ($conn->connect_error) {
        echo "kết nối thất bại";
    } else {
        if ($conn->query($sql)===true) {
            echo "đã thêm vào danh sách";
        } else {
            echo "thất bại". mysqli_error($conn);
        }
    }
}
