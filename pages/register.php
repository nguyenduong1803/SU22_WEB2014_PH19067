<?php

$state = false;
$error = [];
if (isset($_POST['sub'])) {
    $state = true;
    if (
        !isset($_POST['email']) || !isset($_POST['password']) ||
        !isset($_POST['username']) || !isset($_POST['password2'])
    ) {
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $password2 = $_POST['password2'];
        $file = $_FILES['files'];
        // var_dump($file) ;
    }
}
function isValidEmail($email)
{
    return preg_match('/\A[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}\z/', $email)
        && preg_match('/^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/', $email) && $email !== "";
}
function isPass($pass)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass) && $pass !== "";
}
function isRequired($element)
{
    return !$element ? true : false;
}
$notifyE = "";
$confirm = "";
$notifyPass = "";
$notifyUser = "";

if ($state === true) {
    // username
    if (isRequired($username)) {
        $notifyUser = "Vui lòng nhập thông tin username";
    } else if (strlen($username) < 6) {
        $notifyUser =  "Vui lòng điền username lớn hơn 6 kí tự";
    }
    //    pass2
    if (isRequired($password2)) {
        $confirm = "Vui lòng nhập thông tin";
    } else if ($password !== $password2) {
        $confirm = "Mật khẩu không trùng khớp";
    }
    // email
    if (isRequired($email)) {
        $notifyE =  "Vui lòng điền đủ thông tin email";
    } else if (!isValidEmail($email)) {
        $notifyE = "Vui lòng nhập đúng email";
    }
    // password
    if (isRequired($password)) {
        $notifyPass = "Vui lòng điền đủ thông tin";
    } else
     if (!isPass($password)) {
        $notifyPass = "Mật khẩu phải dài hơn 8 kí tự gồm chữ hoa chữ thường số";
    }
    if ($_FILES['files']["tmp_name"] === "") {
        $error['file'] = "Vui lòng chọn file";
    }
}

?>
<style>
    .form__conatiner {
        padding: 1px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }
</style>
<div class="form__conatiner">

    <form class="form" method="POST" enctype="multipart/form-data">
        <h2>Register Form</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder=" username">
            <span class="notify"> <?php echo $notifyUser; ?> </span>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder=" email">
            <span class="notify"> <?php echo $notifyE; ?> </span>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
            <span class="notify"> <?php echo $notifyPass;   ?> </span>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="password">
            <span class="notify"> <?php echo $confirm  ?> </span>
        </div>
        <div>
            <input type="file" class="mb-3 file" name="files" class="form-control" id="exampleInputEmail1">
            <span class="notify"> <?php echo !empty($error['file']) ? $error['file'] : ""; ?> </span>
        </div>
        <button type="submit" name="sub" class="btn btn-primary btns">Submit</button>
        <div class="state">
            <?php
            if ($state === true) {
                if ($notifyE === "" && $notifyUser === "" && $notifyPass === "" && $confirm === "") {
                    if (count($error) > 0 && !empty($error)) {
                        echo "thêm thất bại";
                    } else {
                        require "lib/uploadFile.php";
                        require "database/add.php";
                        if (handlerFile($_FILES['files'])) {
                            $path = handlerFile($_FILES['files']);
                            // insert Products
                            var_dump($path);
                            move_uploaded_file($_FILES['files']['tmp_name'],$path);
                            $user = "INSERT INTO `khachhang` ( `tenKh`, `matKhau`, `hinhAnh`, `email`) 
                        VALUES ( '{$username}', '{$password}', '{$path}', '{$email}')";
                            db_insert($user);
                        }
                    }

                    // echo "Đăng ký thành công <br>";
                    // require "database/add.php";
                    // $user = "INSERT INTO `user` (`name`, `email`, `password`,`more`)
                    //         VALUES ('{$username}','{$email}' ,'{$password}','no')";
                    // db_insert($user);
                    // echo '<script language="javascript" type="text/javascript">
                    //          function OpenPopupCenter(pageURL, title, w, h) {
                    //              var left = (screen.width - w) / 2;
                    //              var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
                    //              var targetWin = window.open(pageURL, title, "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=" + w + ", height=" + h + ", top=" + top + ", left=" + left);
                    //          } OpenPopupCenter("pages/login.php","Đăng nhập",400,450)
                    //      </script>';
                } else {
                    echo "đăng ký thất bại";
                }
            }

            ?>
    </form>

</div>