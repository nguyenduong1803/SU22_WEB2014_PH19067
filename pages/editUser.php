<?php
require "./lib/extention.php";
require "./database/get.php";
require "database/add.php";
$state = false;
$error = [];
if (isset($_POST['sub'])) {
    $state = true;
    if (
        !isset($_POST['email']) || !isset($_POST['password']) ||
        !isset($_POST['username']) || !isset($_POST['password2'])
    ) {
    } else {
        // $email = $_POST['email'];
        // $username = $_POST['username'];

        $file = $_FILES['files'];
        // var_dump($file) ;
    }
}

$notifyE = "";
$confirm = "";
$notifyPass = "";
$notifyUser = "";
$oldNotify = "";

if ($state === true) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    // username
    if (isRequired($username)) {
        $notifyUser = "Vui lòng nhập thông tin username";
    } else if (strlen($username) < 6) {
        $notifyUser =  "Vui lòng điền username lớn hơn 6 kí tự";
    }
    // email
    if (isRequired($email)) {
        $notifyE =  "Vui lòng điền đủ thông tin email";
    } else if (!isValidEmail($email)) {
        $notifyE = "Vui lòng nhập đúng email";
    }

    if ($_FILES['files']["tmp_name"] === "") {
        $error['file'] = "Vui lòng chọn file";
    }
}
if (isset($_GET['userEdit'])) {
    $id = $_GET['userEdit'];
    $user = getUserById($id);
}
if (isset($_POST['subPass'])) {
    $password2 = $_POST['password2'];
    $password = $_POST['password'];
    $oldPassword = $_POST['oldPassword'];
    if (isset($_GET['userEdit'])) {
        if ($user[0]['matKhau'] != $oldPassword) {
            $oldNotify = "Vui lòng nhập đúng mật khẩu cũ";
        }
    }
    //    pass2
    if (isRequired($password2)) {
        $confirm = "Vui lòng nhập thông tin";
    } else if ($password !== $password2) {
        $confirm = "Mật khẩu không trùng khớp";
    }
    // password
    if (isRequired($password)) {
        $notifyPass = "Vui lòng điền đủ thông tin";
    } elseif (!isPass($password)) {
        $notifyPass = "Mật khẩu phải dài hơn 8 kí tự gồm chữ hoa chữ thường số";
    }
    if ($confirm == "" || $notifyPass == "" || $oldNotify == "") {
        $sql = "UPDATE `khachhang` SET `matKhau` = '{$password}' WHERE `khachhang`.`maKh` = {$id};";
        db_insert($sql);
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
    <?php
    if (isset($_GET['userEdit'])) {

    ?>
        <form class="form" method="POST" enctype="multipart/form-data">
            <h2>Change infomation</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" value="<?php echo $user[0]['tenKh']; ?>" class="form-control" id="exampleInputEmail1" placeholder=" username">
                <span class="notify"> <?php echo $notifyUser; ?> </span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" name="email" value="<?php echo $user[0]['email']; ?>" class="form-control" id="exampleInputEmail1" placeholder=" email">
                <span class="notify"> <?php echo $notifyE; ?> </span>
            </div>

            <div>
                <input type="file" class="mb-3 file" name="files" class="form-control" id="exampleInputEmail1">
                <span class="notify"> <?php echo !empty($error['file']) ? $error['file'] : ""; ?> </span>
            </div>
            <button type="submit" name="sub" class="btn btn-primary btns">Edit</button>
            <div class="state">
                <?php
                if ($state === true) {
                    if ($notifyE === "" && $notifyUser === "" && $notifyPass === "" && $confirm === "") {
                        if (count($error) > 0 && !empty($error)) {
                            echo "thêm thất bại";
                        } else {
                            require "lib/uploadFile.php";

                            if (handlerFile($_FILES['files'])) {
                                $path = handlerFile($_FILES['files']);
                                // insert Products
                                move_uploaded_file($_FILES['files']['tmp_name'], $path);
                                $sql = "UPDATE `khachhang` SET `email` = '{$email}',`tenKh` ='{$username}' ,`hinhAnh`='$path' WHERE `khachhang`.`maKh` = {$id};";
                                db_insert($sql);
                                echo "Cập nhật thành công";
                            }
                        }
                    } else {
                        echo "đăng ký thất bại";
                    }
                }

                ?>
        </form>
    <?php } ?>

</div>
<form class="form" method="POST">
    <h2>Change password</h2>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Old Password</label>
        <input type="password" name="oldPassword" class="form-control" placeholder="Old password">
        <span class="notify"> <?php echo $oldNotify;   ?> </span>

    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" placeholder="New password">
        <span class="notify"> <?php echo $notifyPass;   ?> </span>

    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <input type="password" name="password2" class="form-control" placeholder="Confirm password">
        <span class="notify"> <?php echo $confirm  ?> </span>
    </div>
    <button type="submit" name="subPass" class="btn btn-primary btns">Edit</button>

</form>