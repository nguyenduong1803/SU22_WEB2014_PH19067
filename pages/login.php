<?php
 if (session_id() === '')
 session_start();
$state = false;
if (
    !isset($_POST['username']) || !isset($_POST['password'])
) {
} else {
    $state = true;
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
}
$notifyPass = "";
$notifyUser = "";
$notifyName  = "";
if ($state === true) {
    $notifyPass = $password != "" ? "" : "Vui lòng điền đủ thông tin";
    $notifyUser = $username != "" ? "" : "Vui lòng điền đủ thông tin";
}
// select
$list2 = [];
$info = "";

if ($state === true) {
    require "database/search.php";
    $sql = "SELECT * FROM `khachhang` WHERE `matKhau` ='{$password}' 
    and  `tenKh` ='{$username}' ";
    $result = db_search($sql);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            $pass = $row['matKhau'];
            $name = $row['tenKh'];
            $id = $row['maKh'];
            $role = $row['chucNang'];
        }           

    }
    if (isset($name) && isset($pass)) {
        if ($pass == $password && $name == $username) {
            $_SESSION['username']=$name;
            $_SESSION['id']=$id;
            $_SESSION['role']=$role;
            // setcookie('username', $name, time() + 3600);
            // setcookie('id', $id, time() + 3600);
            // setcookie('password', $pass, time() + 3600);
            header('Location:?page=home');
        }
    } else {
        $info = "Thông tin tài khoản hoặc mật khẩu không đúng";
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:?page=login');
}
// Forgot Password

if(isset($_POST['send'])){
    if(empty($_POST['getname'])){
        $notifyName="Vui lòng nhập tên tài khoản";
    }else{
        require "database/search.php";
        $getName = $_POST['getname'];
        $sql = "SELECT * FROM `khachHang` WHERE `tenKh`='{$getName}' Limit 1";  
        $result = db_search($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $email = $row['email'];
                $passwords = $row['matKhau'];
            }  
            require "Mail/sendMail.php";
            $newPassword= uniqid();
            SendMail($email,$getName,$passwords);
            echo "Đã gửi tới: ".$email;         
        }else{
            echo "Không gửi được mail";
        }
    }
}
?>
<style>
    @media (max-width: 600px) {
        .form {
            width: 100%;
            height: 100%;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.6);
            background-color: #B1D4E0;
            border-radius: 5px;
            padding: 0 6px;
            font-size: 1.3rem;
        }

        .mynav {
            box-shadow: 0 4px 10px rgba(39, 39, 39, 0.6) !important;
        }

        .btns {
            height: 50px;
            width: 100%;
            color: #fff;
            font-size: 1.2rem;
            background-color: #654ea3 !important;
        }

        .mb-3 {
            margin-bottom: 20px !important;
        }

        .form-control {
            border-radius: 5px;
            width: 100%;
            height: 50px !important;
        }

        .form-control::placeholder {
            font-weight: 600 !important;
            font-size: 1.2rem;
        }
    }

    .notify {
        line-height: 1rem;
        color: red;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 200;
        text-shadow: 1px 5px 5px rgba(255, 255, 255, 0.4);
    }

    .forgot {
        text-align: right;
    }

    .forgot-link {
        font-weight: 600;
        text-decoration: none;
        color: #000;
    }
    .form{
        margin: 0 auto;
    }
    .form__conatiner {
        padding: 60px 0;
    background: #eaafc8;
    background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
    background: linear-gradient(to right, #eaafc8, #654ea3);
  }
</style>
<div class="form__conatiner">


<form class="form form1" method="POST">
    <h2>Login</h2>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" username">
        <span class="notify"> <?php echo $notifyUser  ?> </span>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
        <span class="notify"> <?php echo $notifyPass ?> </span>
    </div>
    <button type="submit" name="submit" class="btn btn-primary btns">Submit</button>
    <p class="forgot"><a href="" class="forgot-link">forgot password?</a> </p>
    <div class="state">
        <?php echo $info; ?>
    </div>
</form>
<form action="" class="form-forgot form form-dis " method="POST">
 <h2>Get Account</h2>
    <div class="mb-3">
        <label  class="form-label">Username</label>
        <input type="text" name="getname" class="form-control" placeholder=" username">
        <span class="notify"> <?php echo $notifyName  ?> </span>
    </div>
    <button type="submit" name="send" class="btn btn-primary btns btn-forgot">Forgot Password</button>
    <p class="btn__login ">Đăng nhập</p>
</form>
</div>