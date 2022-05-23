<?php
if(file_exists("lib/template.php")){
    require("lib/template.php");
    get_header();
    $path = isset($_GET['page']) ?$_GET['page']:"home";
    $paths = "pages/".$path.".php";
    if(file_exists($paths)){
        require $paths;
    }else{
        echo "không tìm thấy trang";
    }
    get_footer();
}

 ?>




  