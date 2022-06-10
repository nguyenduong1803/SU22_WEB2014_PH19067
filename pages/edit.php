<?php
if (!isset($_SESSION['username']) && !$_SESSION['username'] === "admin") {
    die("không thể truy cập");
}
require "database/search.php";
require "database/get.php";
$list = getProduct();
// get category
$cateArr = getCategory();
$id = $_GET['id'];
$sql = "SELECT * FROM `hanghoa` WHERE `maHangHoa` ={$id}";
$result = db_search($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
// Edit
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
    $discount = $_POST['discount'];
    $status = $_POST['status'];
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
    // mô tả
    if (isRequired($description)) {
        $error['description'] = "Vui lòng nhập thông tin sản phẩm";
    }
    // trạng thái
    if (isRequired($status)) {
        $error['status'] = "Vui lòng nhập trạng thái sản phẩm";
    }
    // danh mục
    if (isRequired($category)) {
        $error['category'] = "Vui lòng chọn danh mục";
    }
    // discount
    if (isRequired($discount)) {
        $error['discount'] = "Vui lòng nhập số phần trăm giảm giá";
    } else if (!isNumber($discount)) {
        $error['discount'] =  "Vui lòng nhập số dương";
    }
    // file
    if ($_FILES['files']["tmp_name"] === "") {
        $error['file'] = "Vui lòng chọn file";
    }
}
// cập nhập
if ($state === true) {
    if (count($error) > 0 && !empty($error)) {
        echo "Cập nhập thất bại";
    } else {
        require "lib/uploadFile.php";
        require "database/add.php";
        if (handlerFileEdit($_FILES['files'])) {
            $path = handlerFileEdit($_FILES['files']);
            // insert Products
            $product  = "UPDATE `hanghoa` SET `moTa` = '{$description}', `hinhAnh` = '{$path}', 
            `donGia` = '{$price}', `tenHangHoa` = '{$fullname}',`maLoaiHang`='{$category}' WHERE `hangHoa`.`maHangHoa` = {$id};";
            db_insert($product);
            header("Location:?page=manageProduct");
        }
    }
}

?>
<style>
    .form__conatiner {
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }



    .product2 {
     
        align-items: flex-start;
        justify-content: center;
        border: 1px solid #eee;
        padding: 12px;
        margin: 12px auto;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .forms {
        margin-top: 12px;
        padding: 12px;
        border-radius: 5px;
        background-color: #B1D4E0;
    }
    .select_cate{
        width: 100%;
        height: 100%;
        min-width: 50px;
        border:1px solid #ccc;
        border-radius: 4px;
    }
</style>
<div class="form__conatiner">
    <div class="container">

        <div class="row products">
            <div class='col-lg-4 col-md-4 '>
                <div class='product2'>
                    <img src="<?php echo $row['hinhAnh'] ?>" alt="" class="p-img">
                    <h4 class="center"> <?php echo $row['tenHangHoa'] ?> </h4>
                    <p class='center'>Category: <?php foreach ($cateArr as $key => $value) {
                                                    if ($value['maLoaiHang'] === $row['maLoaiHang']) {
                                                        echo $value['tenLoaiHang'];
                                                    }
                                                } ?> </p>
                    <p class='price'><?php echo $row['donGia'] ?><span class="vnd">đ</span> </p>
                    <div class='viewDetail'>
                        <i class='fa-solid fa-cart-arrow-down'></i> <span>View Cart</span>
                    </div>
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" class=" forms col-lg-8 col-md-8">
                <h2>Edit Product</h2>
                <div class="row">
                    <div class="mb-3 col-lg-6 col-md-6">
                        <input type="text" name="fullname" class="form-control" value="<?php echo $row['tenHangHoa'] ?>" placeholder="Product name">
                        <span class="notify"> <?php echo !empty($error['fullname']) ? $error['fullname'] : ""; ?> </span>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6">
                        <input type="text" name="description" class="form-control" value="<?php echo $row['moTa'] ?>" placeholder="Description">
                        <span class="notify"> <?php echo !empty($error['description']) ? $error['description'] : ""; ?> </span>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6">
                        <input type="text" name="price" class="form-control" value="<?php echo $row['donGia'] ?>" placeholder="Price">
                        <span class="notify"> <?php echo !empty($error['price']) ? $error['price'] : ""; ?> </span>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6">
                        <input type="text" name="status" class="form-control" value="<?php echo $row['trangThai'] ?>" placeholder="Status">
                        <span class="notify"> <?php echo !empty($error['status']) ? $error['status'] : ""; ?> </span>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6">
                        <input type="text" name="discount" class="form-control" value="<?php echo $row['donGia'] ?>" placeholder="Discount">
                        <span class="notify"> <?php echo !empty($error['discount']) ? $error['discount'] : ""; ?> </span>
                    </div>
                    <div class=" mb-3 col-lg-6 col-md-6">
                    <select name="category" class="select_cate" id="">
                        <option value="">--Category--</option>
                        <?php
                        if (!empty($cateArr)) {
                            foreach ($cateArr as $key => $value) {
                        ?>
                                <option value="<?php echo $value['maLoaiHang'] ?>" <?php echo $value['maLoaiHang'] == $row['maLoaiHang'] ? "selected" : ""  ?>> <?php echo $value['tenLoaiHang'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="notify"> <?php echo !empty($error['category']) ? $error['category'] : ""; ?> </span>

                    </div>
                  
                    <div>
                        <input type="file" class="mb-3 col-lg-6 col-md-6 file" name="files" class="form-control" id="exampleInputEmail1">
                        <span class="notify"> <?php echo !empty($error['file']) ? $error['file'] : ""; ?> </span>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary btns">Edit</button>
                <div class="state">

            </form>

        </div>

    </div>
</div>