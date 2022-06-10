<?php
require "./database/get.php";
$product = statisticalView();
// var_dump($product);
$labels = [];
$datas = [];
if (!empty($product)) {
    foreach ($product as $key => $value) {
        array_push($labels, $value['tenHangHoa']);
        array_push($datas, $value['soLuotXem']);
    }
}
$label = implode(",", $labels);
$data = implode(",", $datas);

?>

<style>
    body {
        background-color: #fff;
    }

    canvas {
        margin: 0 auto;
    }
</style>
<div class="container">
<h2>Top <?php echo count($labels); ?> sản phẩm có lượt xen nhiều nhất</h2>
<canvas id="myChart" data-name ="<?php echo $label ?>" data-rank ="<?php echo $data ?>"  width="500" height="500"></canvas>
<div class="char">
    <canvas id="oilChart" width="400" height="400"></canvas>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById("myChart");
    const label = ctx.dataset.name.split(",")
    const datas = ctx.dataset.rank.split(",")
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels:label,
            datasets: [{
                data: datas,
                backgroundColor: [
                    'rgba(0, 149, 213, 0.9)',
                    'rgba(237, 116, 33, 0.9)',
                    'rgba(73, 89, 245, 0.9)',
                    'rgba(126, 99, 166, 0.9)',
                    'rgba(192, 29, 31, 0.9)',
                    'rgba(118, 118, 118, 0.9)',
                    'rgba(75, 175, 109, 0.9)',
                    'rgba(255, 224, 58, 0.9)'
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
</script>