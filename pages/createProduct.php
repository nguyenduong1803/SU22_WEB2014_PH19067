<?php
require "database/get.php";

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



?>
<style>
    .form {
        max-width: 800px;
        width:auto;
    }
</style>
<form class="form" method="POST" enctype="multipart/form-data">
    <h2>Add Product</h2>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <input type="text" name="fullname" class="form-control" placeholder="Product name">
                <span class="notify"> <?php echo !empty($error['fullname']) ? $error['fullname'] : ""; ?> </span>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <input type="text" name="description" class="form-control" placeholder="Description">
                <span class="notify"> <?php echo !empty($error['description']) ? $error['description'] : ""; ?> </span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <input type="text" name="status" class="form-control" placeholder="Status">
                <span class="notify"> <?php echo !empty($error['status']) ? $error['status'] : ""; ?> </span>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <input type="text" name="price" class="form-control" placeholder="Price">
                <span class="notify"> <?php echo !empty($error['price']) ? $error['price'] : ""; ?> </span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="mb-3">
                <input type="text" name="discount" class="form-control" placeholder="Discount">
                <span class="notify"> <?php echo !empty($error['discount']) ? $error['discount'] : ""; ?> </span>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <select name="category" class="form-control mb-3" id="">
                <option value="">--Category--</option>
                <?php
                if (!empty($users)) {
                    foreach ($users as $key => $value) {
                ?>
                        <option value="<?php echo $value['maLoaiHang'] ?>"><?php echo $value['tenLoaiHang'] ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <span class="notify"> <?php echo !empty($error['category']) ? $error['category'] : ""; ?> </span>

        </div>
    </div>



    <div>
        <input type="file" class="mb-3 file" name="files" class="form-control" id="exampleInputEmail1">
        <span class="notify"> <?php echo !empty($error['file']) ? $error['file'] : ""; ?> </span>
    </div>
    <button type="submit" name="submit" class="btn btn-primary btns">Submit</button>
    <div class="state">
        <?php
        if ($state === true) {
            if (count($error) > 0 && !empty($error)) {
                echo "thêm thất bại";
            } else {
                require "lib/uploadFile.php";
                require "database/add.php";
                if (handlerFile($_FILES['files'])) {
                    $path = handlerFile($_FILES['files']);
                    // insert Products
                    $product  = "INSERT INTO `hanghoa` (`tenHangHoa`, `moTa`, `donGia`,`hinhAnh`, `maLoaiHang`,`trangThai`)
                   VALUES (' {$fullname}','{$description}' ,'{$price}','{$path}',' {$category}','{$status}')";
                    db_insert($product);
                }
            }
        }
        ?>
</form>