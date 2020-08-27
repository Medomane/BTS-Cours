<style>
    #myChart {
        width: 100% !important;
        max-height: 100% !important;
    }
</style>
<div class="myChartDiv">
    <canvas id="myChart"></canvas>
</div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
$.get('<?= ROOT."files/jsonChartAll" ?>',function(data,status){
    var labels = [],dt=[];
    $.each(data,function(i,e){
        labels.push(e.Date);
        dt.push(e.Number);
    });
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '# of Uploads',
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                hoverBorderColor: "rgba(255,99,132,1)",
                data: dt,
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        },
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "rgba(255,99,132,0.2)"
                        }
                    }
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false
                        }
                    }
                ]
            }
        }
    });
});
</script>