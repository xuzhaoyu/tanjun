@extends('layouts.master')

@section('content')
<?php
header( "refresh:30;" );
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>{{$room}}</title>
</head>
<body>
  {{$room}}
  <br>
  <div id="temp" style="height:400px"></div>
  <div id="humidity" style="height:400px"></div>
  <div id="pressure" style="height:400px"></div>
  <div id="dust" style="height:400px"></div>
  {{ HTML::script('js/echarts/build/dist/echarts.js'); }}
  <script type="text/javascript">
  require.config({
    paths: {
      echarts: 'http://123.57.251.73/js/echarts/build/dist'
    }
  });
  require(
    [
    'echarts',
    'echarts/chart/line'
    ],
    function (ec) {
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
          foreach ($data as $a) {
            echo '\'';
            print_r (explode(" ", $a->serverTime)[1]);
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
            formatter: '{value} °C'
          }
        }
        ],
        series : [
        {
          "name":"温度",
          "type":"line",
          "data": [<?php
          foreach ($data as $a) {
            echo $a -> temp;
            echo ', ';
          }
          ?>],
          "markLine": {
            data:[
            [{name: "Max_Start", value: <?php echo $t -> tempMax; ?>, xAxis: -1, yAxis:<?php echo $t -> tempMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Max_End", xAxis: 99999999, yAxis:<?php echo $t -> tempMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}}],
            [{name: "Min_Start", value: <?php echo $t -> tempMin; ?>, xAxis: -1, yAxis:<?php echo $t -> tempMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Min_End", xAxis: 99999999, yAxis:<?php echo $t -> tempMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}}]
            ]
          }
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
      echarts: 'http://123.57.251.73/js/echarts/build/dist'
    }
  });
  require(
    [
    'echarts',
    'echarts/chart/line'
    ],
    function (ec) {
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
          foreach ($data as $a) {
            echo '\'';
            print_r (explode(" ", $a->serverTime)[1]);
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
            formatter: '{value} %RH'
          }
        }
        ],
        series : [
        {
          "name":"湿度",
          "type":"line",
          "data": [<?php
          foreach ($data as $a) {
            echo $a -> humidity;
            echo ', ';
          }
          ?>],
          "markLine": {
            data:[
            [{name: "Max_Start", value: <?php echo $t -> humidityMax; ?>, xAxis: -1, yAxis:<?php echo $t -> humidityMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Max_End", xAxis: 99999999, yAxis:<?php echo $t -> humidityMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}}],
            [{name: "Min_Start", value: <?php echo $t -> humidityMin; ?>, xAxis: -1, yAxis:<?php echo $t -> humidityMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Min_End", xAxis: 99999999, yAxis:<?php echo $t -> humidityMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}}]
            ]
          }
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
      echarts: 'http://123.57.251.73/js/echarts/build/dist'
    }
  });
  require(
    [
    'echarts',
    'echarts/chart/line'
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
            print_r (explode(" ", $a->serverTime)[1]);
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
          "type":"line",
          "data": [<?php
          foreach ($data as $a) {
            echo $a -> pressure;
            echo ', ';
          }
          ?>],
          "markLine": {
            data:[
            [{name: "Max_Start", value: <?php echo $t -> pressureMax; ?>, xAxis: -1, yAxis:<?php echo $t -> pressureMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Max_End", xAxis: 99999999, yAxis:<?php echo $t -> pressureMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}}],
            [{name: "Min_Start", value: <?php echo $t -> pressureMin; ?>, xAxis: -1, yAxis:<?php echo $t -> pressureMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Min_End", xAxis: 99999999, yAxis:<?php echo $t -> pressureMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}}]
            ]
          }
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
      echarts: 'http://123.57.251.73/js/echarts/build/dist'
    }
  });
  require(
    [
    'echarts',
    'echarts/chart/line'
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
            print_r (explode(" ", $a->serverTime)[1]);
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
          "type":"line",
          "data": [<?php
          foreach ($data as $a) {
            echo $a -> dust;
            echo ', ';
          }
          ?>],
          "markLine": {
            data:[
            [{name: "Max_Start", value: <?php echo $t -> dustMax; ?>, xAxis: -1, yAxis:<?php echo $t -> dustMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Max_End", xAxis: 99999999, yAxis:<?php echo $t -> dustMax; ?>,itemStyle:{normal:{color:'#1e90ff'}}}],
            [{name: "Min_Start", value: <?php echo $t -> dustMin; ?>, xAxis: -1, yAxis:<?php echo $t -> dustMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}},
            {name: "Min_End", xAxis: 99999999, yAxis:<?php echo $t -> dustMin; ?>,itemStyle:{normal:{color:'#1e90ff'}}}]
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
