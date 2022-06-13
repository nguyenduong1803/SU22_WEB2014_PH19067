<?php
require "./database/get.php";
$product = statisticalView();
$solds = statisticalSold();
$userBought = statisUserBought();
// var_dump($product);
$labels = [];
$datas = [];
$labelSolds=[];
$dataSolds=[];
$dataUsers=[];
$labelUsers=[];
// số lượt xem sản phẩm
if (!empty($product)) {
    foreach ($product as $key => $value) {
        array_push($labels, $value['tenHangHoa']);
        array_push($datas, $value['soLuotXem']);
    }
}
$label = implode(",", $labels);
$data = implode(",", $datas);

// sản phẩm bán chạy
if (!empty($solds)) {
    foreach ($solds as $key => $value) {
        array_push($labelSolds, $value['tenHangHoa']);
        array_push($dataSolds, $value['quantity']);
    }
}
$labelSold = implode(",", $labelSolds);
$dataSold = implode(",", $dataSolds);

// Khách hàng mua nhiều sản phẩm
if (!empty($userBought)) {
    foreach ($userBought as $key => $value) {
        array_push($labelUsers, $value['tenKh']);
        array_push($dataUsers, $value['quantity']);
    }
}
$labelUser = implode(",", $labelUsers);
$dataUser = implode(",", $dataUsers);

?>

<style>
    #main {
        background-color: #f5f6faff;
        ;
    }

    canvas {
        margin: 0 auto;
        background-color: #fff;
        border-radius: 6px;
        transition:1s;
    }

    .rowCustom {
        padding-top: 40px;
        margin-bottom: 40px;
    }

    .wrap_canvas {}

    #myChart2 {
        background-color: #fff;
        border-radius: 4px;

    }

    .wrap_canvas h4 {
        text-align: center;
        font-size: 1.4rem;
        margin-top: 24px;
        font-weight: 300;
    }
</style>
<div class="container">
    <h2 class="text-center">Phân tích thống kê</h2>
    <div class="row rowCustom">
        <div class="col-lg-4">
            <div class="wrap_canvas">
                <canvas id="myChart2" data-name="<?php echo $labelSold ?>" data-rank="<?php echo $dataSold ?>" height="200px"></canvas>
                <h4>Sản phẩm có nhiều lượt mua nhất</h4>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="wrap_canvas">
                <canvas id="myChart4" height="200px" data-name="<?php echo $labelUser ?>" data-rank="<?php echo $dataUser ?>"></canvas>
                <h4>Khách hàng mua nhiều nhất</h4>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="wrap_canvas">
                <canvas id="myChart5" height="200px"></canvas>
                <h4>Sản phẩm có nhiều lượt mua nhất</h4>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="wrap_canvas">
                <canvas id="myChart" data-name="<?php echo $label ?>" data-rank="<?php echo $data ?>" width="500" height="500"></canvas>
                <h4>Top <?php echo count($labels); ?> sản phẩm có lượt xen nhiều nhất</h4>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="wrap_canvas">
                <canvas id="myChart3" width="500" height="500"></canvas>
                <h4>Top <?php echo count($labels); ?> sản phẩm có lượt xen nhiều nhất</h4>
            </div>

        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById("myChart");
    var ctx2 = document.getElementById("myChart2");
    var ctx4 = document.getElementById("myChart4");
    const label = ctx.dataset.name.split(",")
    const datas = ctx.dataset.rank.split(",")
    const labelSold = ctx2.dataset.name.split(",")
    const dataSold = ctx2.dataset.rank.split(",")
    const labelUser = ctx4.dataset.name.split(",")
    const dataUser = ctx4.dataset.rank.split(",")
    console.log(dataSold);
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: label,
            datasets: [{
                data: datas,
                backgroundColor: [
                    'rgba(192, 29, 31, 0.9)',
                    'rgba(0, 149, 213, 0.9)',
                    'rgba(237, 116, 33, 0.9)',
                    'rgba(73, 89, 245, 0.9)',
                    'rgba(126, 99, 166, 0.9)',
                    'rgba(118, 118, 18, 0.9)',
                    'rgba(255, 224, 58, 0.9)',
                    'rgba(75, 175, 109, 0.9)',
                ],
                borderColor: [
                    'rgba(0, 95, 136,1)',
                    'rgba(160, 78, 22, 1)',
                    'rgba(50, 61, 168, 1)',
                    'rgba(67, 53, 89, 1)',
                    'rgba(115, 17, 18, 1)',
                    'rgba(41, 41, 41, 1)',
                    'rgba(42, 98, 61, 1)',
                    'rgba(178, 156, 40, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: 'rgb(33, 33, 33)',
                    }
                }
            },
            cutoutPercentage: 50,
            responsive: false,
            hoverOffset: 4,
        }
    });

// /////////////////////////staticstical 2
const data2 = {
    labels: labelSold,
    datasets: [{
        label: 'Đã bán',
        backgroundColor: 'rgba(25, 135, 84, 0.8)',
        borderColor: 'rgb(255, 99, 132)',
        data:dataSold,
    }]
};
const data0 = {
    labels: label,
    datasets: [{
        label: 'Số lượt xem',
        backgroundColor: 'rgba(25, 135, 84, 0.8)',
        borderColor: 'rgb(255, 99, 132)',
        data:datas,
    }]
};

    const data3 = {
        labels: labelUser,
        datasets: [{
            label: 'Đã mua',
            backgroundColor: 'rgba(15, 90, 228, 0.7)',
            borderColor: 'rgb(255, 99, 132)',
            data:dataUser,
        }]
    };
    const config2 = {
        type: 'bar',
        data: data2,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },

    };
//   SELECT sum(chitiethd.soLuong) as quantity,count(hoadon.maKh) ,khachhang.tenKh 
// FROM chitiethd INNER JOIN hanghoa ON hanghoa.maHangHoa=chitiethd.maHangHoa
//  INNER JOIN hoadon ON hoadon.maHoaDon =chitiethd.maHoaDon INNER JOIN khachhang 
//  On hoadon.maKh =khachhang.maKh GROUP by khachhang.tenKh ORDER by(sum(soLuong)) DESC LIMIT 5;
    const config3 = {
        type: 'radar',
        data: data0,
        options: {
            elements: {
                line: {
                    borderWidth: 3
                }
            }
        },
    };
    const config4 = {
        type: 'bar',
        data: data3,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const config5 = {
        type: 'line',
        data: data2,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config3
    );
    const myChart4 = new Chart(
        document.getElementById('myChart4'),
        config4
    );
    const myChart5 = new Chart(
        document.getElementById('myChart5'),
        config5
    );
</script>