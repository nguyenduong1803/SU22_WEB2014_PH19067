<?php
$conn="";

function connect(){
    global $conn;
    if(!$conn){
        $conn = new mysqli("localhost", "root", "", "xshop");     
    }
}

?>