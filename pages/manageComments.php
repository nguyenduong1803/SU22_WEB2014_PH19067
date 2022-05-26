<?php
if (!isset($_COOKIE['username']) || !$_COOKIE['username'] === "admin") {
    die("không thể truy cập");
}
require "database/get.php";

$list = getProduct();
// get category
$cateArr = getCategory();
$state = false;
$error = [];

if (isset($_POST['submit'])) {
    $state = true;
    if (
        !isset($_POST['category']) || !isset($_POST['fullname']) ||
        !isset($_POST['price']) || !isset($_POST['file']) || !isset($_POST['description'])
    ) {
    } else {
    }
}
function isRequired($element)
{
    return !$element ? true : false;
}
function isNumber($num)
{
    return preg_match('/^[a-zA-Z0-9]*$/', $num) && $num > 0 ? true : false;
}

if ($state === true) {
    $fullname = $_POST['fullname'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $file = $_FILES['files'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $discount = $_POST['discount'];
    // full name
    if (isRequired($fullname)) {
        $error['fullname'] = "Vui lòng nhập tên sản phẩm";
    } else if (strlen($fullname) < 6) {
        $error['fullname'] =  "Vui lòng điền username lớn hơn 6 kí tự";
    }
    // price
    if (isRequired($price)) {
        $error['price'] = "Vui lòng nhập giá sản phẩm";
    } else if (!isNumber($price)) {
        $error['price'] =  "Vui lòng nhập số dương";
    }
    // discount
    if (isRequired($discount)) {
        $error['discount'] = "Vui lòng nhập số phần trăm giảm giá";
    } else if (!isNumber($discount)) {
        $error['discount'] =  "Vui lòng nhập số dương";
    }
    // mô tả
    if (isRequired($description)) {
        $error['description'] = "Vui lòng nhập thông tin sản phẩm";
    }
    if (isRequired($status)) {
        $error['status'] = "Vui lòng nhập trạng thái sản phẩm";
    }
    // danh mục
    if (isRequired($category)) {
        $error['category'] = "Vui lòng chọn danh mục";
    }
    // file
    if ($_FILES['files']["tmp_name"] === "") {
        $error['file'] = "Vui lòng chọn file";
    }
}
// get category

$users = getCategory();
$notify = "";
if ($state === true) {
    if (count($error) > 0 && !empty($error)) {
        $notify = "thêm thất bại";
    } else {
        require "lib/uploadFile.php";
        require "database/add.php";
        if (handlerFile($_FILES['files'])) {
            $path = handlerFile($_FILES['files']);
            // insert Products
            if ($path != false) {
                move_uploaded_file($file['tmp_name'], $path);
                $product  = "INSERT INTO `hanghoa` (`tenHangHoa`, `moTa`, `donGia`,`hinhAnh`, `maLoaiHang`,`trangThai`,`mucGiamGia`)
                VALUES (' {$fullname}','{$description}' ,'{$price}','{$path}',' {$category}','{$status}', '{$discount}')";
                db_insert($product);
                $notify = "thêm Thành công";
                header("Location:?page=manageProduct");
            } else {
                $notify = "thêm thất bại";
            }
        }
    }
}

?>
<style>
    .mini-img {
        width: 120px;
        height: 90px;
    }

    .green {
        color: #fff;
        font-size: 1.4rem;
    }

    .green:hover,
    .red:hover {
        cursor: pointer;
    }

    .red {
        position: relative;
        top: 2px;
        color: red;
        font-size: 1.4rem;

    }

    .color-white {
        width: 100px;
        color: #fff;
        margin-left: 5px;
    }

    .btn-action {
        text-decoration: none !important;
        width: 100px;
        height: 40px;
        padding: 5px 10px;
        border-radius: 5px;
        box-shadow: 2px 4px 7px rgb(46 44 44 / 60%)
    }

    .btn--remove {
        background-color: #654ea3;
    }

    .btn--remove:hover {
        background-color: #4e3398;
    }

    td {
        border: 1px solid #fff;
    }

    th {
        border: 1px solid #fff;
        text-align: center;
    }

    th:nth-child(1) {

        width: 30px;
    }

    th:nth-child(5) {
        width: 30%;
    }

    th:nth-child(4) {
        width: 30px;
    }

    .table>:not(:first-child) {
        border-top: none !important;
    }

    .th_action {
        width: 40px;
        ;
    }

    .td_child {
        position: relative;
    }

    .check {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1.5rem;
        height: 1.5rem;
    }

    .clearAll {
        display: none;
    }

    .form__conatiner {
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }
</style>


<div class="form__conatiner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quảng lý bình luận</li>
            </ol>
        </nav>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Comment quantity</th>
                    <th scope="col">Price</th>
                    <th>View Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                ?>
                        <tr>
                            <td><img class="mini-img" src="<?php echo $value['hinhAnh'] ?>" alt=""></td>
                            <td><?php echo $value['tenHangHoa'] ?></td>
                            <td><?php echo $value['moTa'] ?></td>
                            <td><?php echo $value['donGia'] ?></td>
                            <td><i class="fa-solid fa-eye"></i> Xem bình luận</td>
                        </tr>
                        <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    
        <button class="btn btn-danger  deleteAll"> Xóa mục đã chọn</button>

    </div>
</div>
<script type="text/javascript">
  
</script>