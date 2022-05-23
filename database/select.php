<?php


function db_select($sql)
{
    $conn = new mysqli("localhost", "root", "", "xshop");
    if ($conn->connect_error) {
        echo "kết nối thất bại";
    } else {
        $result = $conn->query($sql);  
    }
    mysqli_close($conn);
    return $result;
}
?>