<?php

function db_search($sql)
{
    $conn = new mysqli("localhost", "root", "", "xshop");
    if ($conn->connect_error) {
        echo "kết nối thất bại";
    } else {
        $result = mysqli_query($conn,$sql);  
    }
    mysqli_close($conn);
    return $result;
}

?>