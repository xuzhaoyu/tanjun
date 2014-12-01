@extends('layouts.master')

@section('content')
<?php
  header( "refresh:10;" );
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>{{$room}}</title>
</head>
<body>

    {{$room}}
    <br>

    <!-- Prepare a Dom with size (width and height) for ECharts -->
    <div id="temp" style="height:400px"></div>
    <div id="humidity" style="height:400px"></div>
    <div id="pressure" style="height:400px"></div>
    <div id="smoke" style="height:400px"></div>
    <div id="dust" style="height:400px"></div>
    <!-- ECharts import -->
    <script src="../echarts/build/dist/echarts.js"></script>
    <script type="text/javascript">
        // configure for module loader
        require.config({
            paths: {
                echarts: '../echarts/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('temp'));

                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['温度']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : [<?php
                                        //$last = array_pop($data);
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r (explode(" ", $a->serverTime)[1]);
                                            echo '\'';
                                            echo ', ';
                                        }
                                        // echo '\'';
                                        // print_r (explode(" ", $last->serverTime)[1]);
                                        // echo '\'';
                                  ?>]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel : {
                              formatter: '{value} °C'
                            }
                        }
                    ],
                    series : [
                        {
                            "name":"温度",
                            "type":"line",
                            "data": [<?php
                                        //  $last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a -> dhtTemp;
                                             echo ', ';
                                         }
                                        //  echo $last -> dhtTemp;
                                     ?>]
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>

    <script type="text/javascript">
        // configure for module loader
        require.config({
            paths: {
                echarts: '../echarts/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('humidity'));

                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['湿度']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : [<?php
                                        // $last = array_pop($data);
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r (explode(" ", $a->serverTime)[1]);
                                            echo '\'';
                                            echo ', ';
                                        }
                                        // echo '\'';
                                        // print_r (explode(" ", $last->serverTime)[1]);
                                        // echo '\'';
                                  ?>]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel : {
                              formatter: '{value} %RH'
                            }
                        }
                    ],
                    series : [
                        {
                            "name":"湿度",
                            "type":"line",
                            "data": [<?php
                                        //  $last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a -> dhtHumidity;
                                             echo ', ';
                                         }
                                        //  echo $last -> dhtHumidity;
                                     ?>]
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>

    <script type="text/javascript">
        // configure for module loader
        require.config({
            paths: {
                echarts: '../echarts/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('pressure'));

                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['压差']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : [<?php
                                        // $last = array_pop($data);
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r (explode(" ", $a->serverTime)[1]);
                                            echo '\'';
                                            echo ', ';
                                        }
                                        // echo '\'';
                                        // print_r (explode(" ", $last->serverTime)[1]);
                                        // echo '\'';
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
                            "type":"line",
                            "data": [<?php
                                        //  $last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a -> MS5611Pressure;
                                             echo ', ';
                                         }
                                        //  echo $last -> MS5611Pressure;
                                     ?>]
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>

    <script type="text/javascript">
        // configure for module loader
        require.config({
            paths: {
                echarts: '../echarts/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('smoke'));

                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['烟雾']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : [<?php
                                        // $last = array_pop($data);
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r (explode(" ", $a->serverTime)[1]);
                                            echo '\'';
                                            echo ', ';
                                        }
                                        // echo '\'';
                                        // print_r (explode(" ", $last->serverTime)[1]);
                                        // echo '\'';
                                  ?>]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel : {
                              formatter: '{value} Volt'
                            }
                        }
                    ],
                    series : [
                        {
                            "name":"烟雾",
                            "type":"line",
                            "data": [<?php
                                        //  $last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a -> MQ2Smoke;
                                             echo ', ';
                                         }
                                        //  echo $last -> MQ2Smoke;
                                     ?>]
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>

    <script type="text/javascript">
        // configure for module loader
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('dust'));

                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['尘埃微粒']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : [<?php
                                        // $last = array_pop($data);
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r (explode(" ", $a->serverTime)[1]);
                                            echo '\'';
                                            echo ', ';
                                        }
                                        // echo '\'';
                                        // print_r (explode(" ", $last->serverTime)[1]);
                                        // echo '\'';
                                  ?>]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel : {
                              formatter: '{value} Volt'
                            }
                        }
                    ],
                    series : [
                        {
                            "name":"尘埃微粒",
                            "type":"line",
                            "data": [<?php
                                        //  $last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a -> Dust;
                                             echo ', ';
                                         }
                                        //  echo $last -> Dust;
                                     ?>]
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>

</body>
