// configure for module loader
require.config({
    paths: {
        echarts: 'http://123.57.66.77/js/echarts/build/dist'
    }
});

// use
require(
    [
        'echarts',
        'echarts/chart/bar' // require the specific chart type
    ],
    function (ec) {
        // Initialize after dom ready
        var myChart = ec.init(document.getElementById('pressure'));

        var option = {
            tooltip: {
                show: true
            },
            legend: {
                data: ['压差']
            },
            xAxis: [
                {
                    type: 'category',
                    data: [<?php
                    //$last = array_pop($data);
                    foreach ($data as $a) {
                        echo '\'';
                        print_r ($a['room']);
                        echo '\'';
                        echo ', ';
                        }
                    //echo '\'';
                                        //print_r ($last['room']);
                                        //echo '\'';
                    ?>]
                    }
                    ],
                    yAxis : [
    {
        type : 'value',
        axisLabel : {
        formatter: '{value} Pa'
        }
        }
                    ],
                    series : [
    {
        "name":"压差",
        "type":"bar",
        "barWidth": 50,
        "data": [<?php
        //$last = array_pop($data);
        foreach ($data as $a) {
        echo $a['MS5611Pressure'];
        echo ', ';
        }
        //echo $last['MS5611Pressure'];
                                     ?>]
                        }
                    ]
                    };
                    // Load data into the ECharts instance
                    myChart.setOption(option);
                    }
                    );
