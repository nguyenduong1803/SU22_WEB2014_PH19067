<?php
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
            header("Location:?page=admin");
        }
    }
}

?>
<div class="row products">
    <div class='col-lg-3 col-md-4 '>
        <div class='product'>
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
    <form class="form" method="POST" enctype="multipart/form-data" class="col-lg-3 col-md-4">
        <h2>Edit Product</h2>
        <div class="mb-3">
            <input type="text" name="fullname" class="form-control" value="<?php echo $row['tenHangHoa'] ?>" placeholder="Product name">
            <span class="notify"> <?php echo !empty($error['fullname']) ? $error['fullname'] : ""; ?> </span>
        </div>
        <div class="mb-3">
            <input type="text" name="description" class="form-control" value="<?php echo $row['moTa'] ?>" placeholder="Description">
            <span class="notify"> <?php echo !empty($error['description']) ? $error['description'] : ""; ?> </span>
        </div>
        <div class="mb-3">
            <input type="text" name="price" class="form-control" value="<?php echo $row['donGia'] ?>" placeholder="Price">
            <span class="notify"> <?php echo !empty($error['price']) ? $error['price'] : ""; ?> </span>
        </div>
        <div class="mb-3">
            <input type="text" name="status" class="form-control" value="<?php echo $row['trangThai'] ?>" placeholder="Status">
            <span class="notify"> <?php echo !empty($error['status']) ? $error['status'] : ""; ?> </span>
        </div>
        <div class="mb-3">
            <input type="text" name="discount" class="form-control"value="<?php echo $row['donGia'] ?>" placeholder="Discount">
            <span class="notify"> <?php echo !empty($error['discount']) ? $error['discount'] : ""; ?> </span>
        </div>
        <select name="category" class="form-control mb-3" id="">
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

        <div>
            <input type="file" class="mb-3 file" name="files" class="form-control" id="exampleInputEmail1">
            <span class="notify"> <?php echo !empty($error['file']) ? $error['file'] : ""; ?> </span>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btns">Edit</button>
        <div class="state">

    </form>

</div>