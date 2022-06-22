<?php
if (file_exists("lib/template.php")) {
    require("lib/template.php");
    get_header();
    $path = isset($_GET['page']) ? $_GET['page'] : "home";
    $paths = "pages/" . $path . ".php";
    if ($path === "admin" && isset($_SESSION['username']) && $_SESSION['role'] === "admin") {
        require $paths;
    } else if ($path !== "admin") {
        if (file_exists($paths)) {
            require $paths;
        } else {
            echo "không tìm thấy trang";
        }
    }else{
        echo "không tìm thấy trang";

    }


    get_footer();
}
