<?php
require "database/get.php";
$list = getProduct();
// get category
$cateArr = getCategory();
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
    .color-white{
        color:#fff;
        margin-left: 5px;
    }
    .btn-active{
        text-decoration: none !important;
        width: 180px;
        height: 80px;
        padding:5px 10px;
        border-radius: 5px;
        box-shadow: 2px 4px 7px rgb(46 44 44 / 60%) 
    }
    .btn--remove{
        background-color: #654ea3;
    }
    .btn--remove:hover{
        background-color: #4e3398;
    }
    td{
        border:1px solid #fff;
        line-height: 80px;
    }
    th{
        border:1px solid #fff;
        text-align: center;
    }
    .logout{
        height: 40px;
        margin-top: 20px;
    }
    .space{
        justify-content:space-between;
    }
    .table>:not(:first-child) {
     border-top:none !important;
}
</style>

<sestion class="d-flex space">
<li class="nav-item btn-add"><a href="?page=createProduct" class="nav-link links add font-weight-bold text-uppercase">Thêm Sản phẩm</a></li>
<button class="btn btn-success logout"><a href="?page=login&&logout=true" class="white">Đăng xuất</a> </button>
</sestion>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col" colspan="2" class="color-white" >Action</th>

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
                    <td> <?php foreach ($cateArr as $keys => $item) {
                    if($value['maLoaiHang']===$item['maLoaiHang']){
                        echo $item['tenLoaiHang'];
                    }
                } ?></td>
                    <td><?php echo $value['moTa'] ?></td>
                    <td><?php echo $value['donGia'] ?></td>
                    <td><a href="?page=edit&&id=<?php echo $value['maHangHoa'] ?>"class="btn-active btn-success btn--edit"> <i class="fa-solid fa-pen-to-square green"></i> <span class="color-white" >Edit</span></a></td>
                    <td> <a class="btn-active btn--remove" href="?page=remove&&remove=<?php echo $value['maHangHoa'] ?>"><i class="fa-solid fa-circle-xmark red"></i><span  class="color-white">remove</span></a></td>
                </tr>
                <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
        <?php
            }
        }
        ?>
    </tbody>
</table>
