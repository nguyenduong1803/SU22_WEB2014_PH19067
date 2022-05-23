<?php
function handlerFile($file)
{
    $error = [];
    if (!$file['error']) {
        $path = "public/img/" . $_FILES['files']['name'];
        $fileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif') {
            $error['type'] = "Chỉ upload được file ảnh JPG PNG JPEG GIF";
        }
        if ($file['size'] > 29000000) {
            $error['size'] = "chỉ upload được file nhỏ hơn 20MB";
        }
        // if (file_exists($path)) {
        //     $error['exists'] = "File đã tồn tại";
        // }
        if (empty($error)) {  
            if(move_uploaded_file($file['tmp_name'], $path)){
               return $path;
            }else{
                echo "Upload file không thành công";
            }
            return $path;
        } else {
            foreach ($error as $key => $value) {
                echo $value;
            }
            return false;
        }
    }
}
function handlerFileEdit($file)
{
    $error = [];
    if (!$file['error']) {
        $path = "public/img/" . $_FILES['files']['name'];
        $fileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif') {
            $error['type'] = "Chỉ upload được file ảnh JPG PNG JPEG GIF";
        }
        if ($file['size'] > 29000000) {
            $error['size'] = "chỉ upload được file nhỏ hơn 20MB";
        }    
        if (empty($error)) {  
            if(move_uploaded_file($file['tmp_name'], $path)){
               return $path;
            }else{
                echo "Upload file không thành công";
            }
            return $path;
        } else {
            foreach ($error as $key => $value) {
                echo $value;
            }
            return false;
        }
    }
}
