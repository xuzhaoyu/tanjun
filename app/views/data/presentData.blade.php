@extends('layouts.master')

@section('content')

<?php
  header( "refresh:10;" );
?>

<style>
  table, th, td {
    border: 1px solid black;
  }
</style>

<table>
  <tr>
    <th>房间</th>
    <th>温度</th>
    <th>湿度</th>
    <th>压力</th>
    <th>烟雾</th>
    <th>尘埃微粒</th>
    <th>时间</th>
  </tr>

<?php
  foreach ($data as $a) {
    echo '<tr>';
    echo '<td>';
    echo '<a href="';
    echo URL::route('home');
    echo '/';
    print_r($a['room']);

    echo '">';
    print_r($a['room']);
    echo '</a>';
    echo '</td>';

    echo '<td>';
    print_r($a['dhtTemp']);
    echo '</td>';

    echo '<td>';
    print_r($a['dhtHumidity']);
    echo '</td>';

    echo '<td>';
    print_r($a['MS5611Pressure']);
    echo '</td>';

    if ($a['MQ2Smoke'] > 68){
        echo '<td style="background-color:blue"><span style="color:red;">';
        print_r($a['MQ2Smoke']);
        echo '</span></td>';
    } else {
        echo '<td>';
        print_r($a['MQ2Smoke']);
        echo '</td>';
    }

    echo '<td>';
    print_r($a['Dust']);
    echo '</td>';

    echo '<td>';
    print_r($a['serverTime']);
    echo '</td>';

    echo '</tr>';
  }
?>


</table>

<body>

    <div id="pressure" style="height:400px; width:600px"></div>
    <div id="dust" style="height:400px; width:600px"></div>
    <!-- ECharts import -->
    {{ HTML::script('js/echarts/build/dist/echarts.js'); }}
    {{ HTML::script('js/graphs/mainPressure.js'); }}
   
    <script type="text/javascript">
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
                              formatter: '{value} Volt'
                            }
                        }
                    ],
                    series : [
                        {
                            "name":"尘埃微粒",
                            "type":"bar",
                            "barWidth": 50,
                            "data": [<?php
                                         //$last = array_pop($data);
                                         foreach ($data as $a) {
                                             echo $a['Dust'];
                                             echo ', ';
                                         }
                                         //echo $last['Dust'];
                                     ?>],
                            "markLine": {
                                data:[
                                    [{name: "Max_Start", value: 200, xAxis: -1, yAxis:200,itemStyle:{normal:{color:'#1e90ff'}}},
                                    {name: "Max_End", xAxis: 4, yAxis:200,itemStyle:{normal:{color:'#1e90ff'}}}],
                                    [{name: "Min_Start", value: 150, xAxis: -1, yAxis:150,itemStyle:{normal:{color:'#1e90ff'}}},
                                    {name: "Min_End", xAxis: 4, yAxis:150,itemStyle:{normal:{color:'#1e90ff'}}}
                                    ]
                                ]
                            }
                        }
                    ]
                };
                // Load data into the ECharts instance
                myChart.setOption(option);
            }
        );
    </script>
</body>

@stop
