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

    $t = DB::table('thresholds')->where('mac', '=', $a['mac'])
         ->select('tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'smokeMin', 'smokeMax', 'dustMin', 'dustMax')
         ->first();

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

      if (($a['dhtTemp'] > $t -> tempMax) or ($a['dhtTemp'] < $t -> tempMin)) {
          echo '<td style="background-color:blue"><span style="color:red;">';
          print_r($a['dhtTemp']);
          echo '</span></td>';
      } else {
          echo '<td>';
          print_r($a['dhtTemp']);
          echo '</td>';
      }

      if (($a['dhtHumidity'] > $t -> humidityMax) or ($a['dhtHumidity'] < $t -> humidityMin)) {
          echo '<td style="background-color:blue"><span style="color:red;">';
          print_r($a['dhtHumidity']);
          echo '</span></td>';
      } else {
          echo '<td>';
          print_r($a['dhtHumidity']);
          echo '</td>';
      }

      if (($a['MS5611Pressure'] > $t -> pressureMax) or ($a['MS5611Pressure'] < $t -> pressureMin)) {
          echo '<td style="background-color:blue"><span style="color:red;">';
          print_r($a['MS5611Pressure']);
          echo '</span></td>';
      } else {
          echo '<td>';
          print_r($a['MS5611Pressure']);
          echo '</td>';
      }

    if (($a['MQ2Smoke'] > $t -> smokeMax) or ($a['MQ2Smoke'] < $t -> smokeMin)) {
        echo '<td style="background-color:blue"><span style="color:red;">';
        print_r($a['MQ2Smoke']);
        echo '</span></td>';
    } else {
        echo '<td>';
        print_r($a['MQ2Smoke']);
        echo '</td>';
    }

      if (($a['Dust'] > $t -> dustMax) or ($a['Dust'] < $t -> dustMin)) {
          echo '<td style="background-color:blue"><span style="color:red;">';
          print_r($a['Dust']);
          echo '</span></td>';
      } else {
          echo '<td>';
          print_r($a['Dust']);
          echo '</td>';
      }



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
    <script type="text/javascript">
        require.config({
            paths: {
                echarts:'http://123.57.66.77/js/echarts/build/dist'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/bar'
            ],
            function (ec) {
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
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r ($a['room']);
                                            echo '\'';
                                            echo ', ';
                                        }
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
                                         foreach ($data as $a) {
                                             echo $a['MS5611Pressure'];
                                             echo ', ';
                                         }
                                     ?>]
                        }
                    ]
                };
                myChart.setOption(option);
            }
        );
    </script>

    <script type="text/javascript">
        require.config({
            paths: {
                echarts: 'http://123.57.66.77/js/echarts/build/dist'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/bar'
            ],
            function (ec) {
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
                                        foreach ($data as $a) {
                                            echo '\'';
                                            print_r ($a['room']);
                                            echo '\'';
                                            echo ', ';
                                        }
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
                                         foreach ($data as $a) {
                                             echo $a['Dust'];
                                             echo ', ';
                                         }
                                     ?>],

                            "markLine": {
                                data:[
                                    [{name: "Max_Start", value: <?php echo $t -> dustMax; ?>, xAxis: -1, yAxis:<?php echo $t -> dustMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
                                    {name: "Max_End", xAxis: 4, yAxis:<?php echo $t -> dustMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}}],
                                    [{name: "Min_Start", value: <?php echo $t -> dustMin; ?>, xAxis: -1, yAxis:<?php echo $t -> dustMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
                                    {name: "Min_End", xAxis: 4, yAxis:<?php echo $t -> dustMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}}
                                    ]
                                ]
                            }
                        }
                    ]
                };
                myChart.setOption(option);
            }
        );
    </script>
</body>
@stop
