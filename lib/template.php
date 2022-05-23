<?php

function get_header(){
$path = "inc/header.php";
if(file_exists($path)){
    require "inc/header.php";

}else{
    echo "Không tồn tại file";
}
}
function get_footer(){
    $path = "inc/footer.php";
    if(file_exists($path)){
        require "inc/footer.php"; 
    }else{
        echo "Không tồn tại file";
    }
}
?>