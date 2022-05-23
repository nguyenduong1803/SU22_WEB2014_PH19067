<?php
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
    .form {
        max-width: 800px;
        width: auto;
    }

    .form__conatiner {
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }

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
    .td_child{
        position: relative;
    }
    .check{
        position: absolute;
        top: 50%;
        left: 50%;
        transform:translate(-50%,-50%);
        width: 1.5rem;
        height: 1.5rem;
    }
</style>
<div class="form__conatiner">
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
            echo $notify;
            ?>
    </form>


</div>
<div id="demo"></div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col" colspan="2" class="color-white th_action">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($list)) {
                foreach ($list as $key => $value) {
            ?>
                    <tr>
                        <td class="td_child"><input class="form-check-input check" type="checkbox" value="" id="flexCheckDefault"></td>
                        <td><img class="mini-img" src="<?php echo $value['hinhAnh'] ?>" alt=""></td>
                        <td><?php echo $value['tenHangHoa'] ?></td>
                        <td> <?php foreach ($cateArr as $keys => $item) {
                                    if ($value['maLoaiHang'] === $item['maLoaiHang']) {
                                        echo $item['tenLoaiHang'];
                                    }
                                } ?></td>
                        <td><?php echo $value['moTa'] ?></td>
                        <td><?php echo $value['donGia'] ?></td>
                        <td class=""><a href="?page=edit&&id=<?php echo $value['maHangHoa'] ?>" class="btn-action btn-success btn--edit "> <i class="fa-solid fa-pen-to-square green"></i> <span class="color-white">Edit</span></a></td>
                        <td class=""> <a class="btn-action btn--remove " href="?page=remove&&remove=<?php echo $value['maHangHoa'] ?>"><i class="fa-solid fa-circle-xmark red "></i><span class="color-white">remove</span></a></td>
                    </tr>
                    <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <button class="btn btn-success chooseAll"> Chọn tất cả</button>
    <button class="btn btn-danger  deleteAll"> Xóa mục đã chọn</button>

</div>
<script type="text/javascript">
    const checkbox = document.querySelectorAll(".check");
    document.querySelector(".chooseAll").addEventListener('click',function(){
       checkbox.forEach((ele)=>{
           if(ele.checked===true){
              ele.checked=false;
        }else{
            ele.checked=true;
        }
        
       })
    } ) 
    document.querySelector(".deleteAll").addEventListener('click',function(){
                 
    } ) 


</script>