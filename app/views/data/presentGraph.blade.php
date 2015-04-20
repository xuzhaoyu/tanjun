@extends('layouts.master')

@section('content')
    <?php
    header("refresh:120;");
    ?>

    <!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>{{$room}}</title>
    </head>
    <body>

    <a href="/graph/{{$room}}/all">所有数据</a>
    <br>
    <a href="/graph/{{$room}}/month">一个月的数据</a>
    <br>
    <a href="/graph/{{$room}}/day">今天的数据</a>
    <br>

    <br>
    <br>

    房间名称： {{$room}}
    <br>
    @if($columns->pressure)
        <div id="pressure" style="height:400px"></div>
    @endif

    @if($columns->dust)
        <div id="dust" style="height:400px"></div>
    @endif

    @if($columns->temp)
        <div id="temp" style="height:400px"></div>
        <div id="humidity" style="height:400px"></div>
    @endif

    {{ HTML::script('js/echarts/build/dist/echarts.js'); }}
    @if($columns->temp)
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
                                data: ['温度'],
                                textStyle: {
                                    fontSize: 24
                                }
                            },
                            xAxis: [
                                {
                                    type: 'category',
                                    data: [
                                        @foreach ($data as $a)
                                        @if ($time_length == 'day')
                                        '{{explode(" ", $a->serverTime)[1]}}',
                                        @else
                                            '{{explode(" ", $a->serverTime)[0]}}',
                                        @endif
                                      @endforeach
                                      ]
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value} °C'
                                    }
                                }
                            ],
                            series: [
                                {
                                    "name": "温度",
                                    "type": "line",
                                    "itemStyle": {normal: {color: '#1e90ff'}},
                                    "data": [
                                        @foreach ($data as $a)
                                        {{$a -> temp}},
                                        @endforeach
                                        ],
                                    "markLine": {
                                        data: [
                                            [{
                                                name: "Max_Start",
                                                value: {{$t -> tempMax}},
                                                xAxis: -1,
                                                yAxis:{{$t -> tempMax}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Max_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> tempMax}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }],
                                            [{
                                                name: "Min_Start",
                                                value: {{$t -> tempMin}},
                                                xAxis: -1,
                                                yAxis:{{$t -> tempMin}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Min_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> tempMin}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }]
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
                    echarts: './js/echarts/build/dist'
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
                                data: ['湿度'],
                                textStyle: {
                                    fontSize: 24
                                }
                            },
                            xAxis: [
                                {
                                    type: 'category',
                                    data: [
                                        @foreach ($data as $a)
                                        @if ($time_length == 'day')
                                        '{{explode(" ", $a->serverTime)[1]}}',
                                        @else
                                            '{{explode(" ", $a->serverTime)[0]}}',
                                        @endif
                                      @endforeach
                                      ]
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value} %RH'
                                    }
                                }
                            ],
                            series: [
                                {
                                    "name": "湿度",
                                    "type": "line",
                                    "itemStyle": {normal: {color: '#1e90ff'}},
                                    "data": [
                                        @foreach ($data as $a)
                                        {{$a -> humidity}},
                                        @endforeach
                                        ],
                                    "markLine": {
                                        data: [
                                            [{
                                                name: "Max_Start",
                                                value: {{$t -> humidityMax}},
                                                xAxis: -1,
                                                yAxis:{{$t -> humidityMax}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Max_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> humidityMax}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }],
                                            [{
                                                name: "Min_Start",
                                                value: {{$t -> humidityMin}},
                                                xAxis: -1,
                                                yAxis:{{$t -> humidityMin}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Min_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> humidityMin}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }]
                                        ]
                                    }
                                }
                            ]
                        };
                        myChart.setOption(option);
                    }
            );
        </script>
    @endif

    @if($columns->pressure)

        <script type="text/javascript">
            require.config({
                paths: {
                    echarts: './js/echarts/build/dist'
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
                                data: ['压差'],
                                textStyle: {
                                    fontSize: 24
                                }
                            },
                            xAxis: [
                                {
                                    type: 'category',
                                    data: [
                                        @foreach ($data as $a)
                                        @if ($time_length == 'day')
                                        '{{explode(" ", $a->serverTime)[1]}}',
                                        @else
                                            '{{explode(" ", $a->serverTime)[0]}}',
                                        @endif
                                      @endforeach
                                      ]
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value} Pa'
                                    }
                                }
                            ],
                            series: [
                                {
                                    "name": "压差",
                                    "type": "line",
                                    "itemStyle": {normal: {color: '#1e90ff'}},
                                    "data": [
                                        @foreach ($data as $a)
                                        {{$a -> pressure}},
                                        @endforeach
                                        ],
                                    "markLine": {
                                        data: [
                                            [{
                                                name: "Max_Start",
                                                value: {{$t -> pressureMax}},
                                                xAxis: -1,
                                                yAxis:{{$t -> pressureMax}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Max_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> pressureMax}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }],
                                            [{
                                                name: "Min_Start",
                                                value: {{$t -> pressureMin}},
                                                xAxis: -1,
                                                yAxis:{{$t -> pressureMin}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Min_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> pressureMin}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }]
                                        ]
                                    }
                                }
                            ]
                        };
                        myChart.setOption(option);
                    }
            );
        </script>
    @endif

    @if($columns->dust)

        <script type="text/javascript">
            require.config({
                paths: {
                    echarts: './js/echarts/build/dist'
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
                                data: ['尘埃微粒'],
                                textStyle: {
                                    fontSize: 24
                                }
                            },
                            xAxis: [
                                {
                                    type: 'category',
                                    data: [
                                        @foreach ($data as $a)
                                        @if ($time_length == 'day')
                                        '{{explode(" ", $a->serverTime)[1]}}',
                                        @else
                                            '{{explode(" ", $a->serverTime)[0]}}',
                                        @endif
                                      @endforeach
                                      ]
                                }
                            ],
                            yAxis: [
                                {
                                    type: 'value',
                                    axisLabel: {
                                        formatter: '{value} 个'
                                    }
                                }
                            ],
                            series: [
                                {
                                    "name": "尘埃微粒",
                                    "type": "line",
                                    "itemStyle": {normal: {color: '#1e90ff'}},
                                    "data": [
                                        @foreach ($data as $a)
                                        {{$a -> dust}},
                                        @endforeach
                                        ],
                                    "markLine": {
                                        data: [
                                            [{
                                                name: "Max_Start",
                                                value: {{$t -> dustMax}},
                                                xAxis: -1,
                                                yAxis:{{$t -> dustMax}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Max_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> dustMax}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }],
                                            [{
                                                name: "Min_Start",
                                                value: {{$t -> dustMin}},
                                                xAxis: -1,
                                                yAxis:{{$t -> dustMin}},
                                                itemStyle: {normal: {color: '#ff7f50'}}
                                            },
                                                {
                                                    name: "Min_End",
                                                    xAxis: 99999999,
                                                    yAxis:{{$t -> dustMin}},
                                                    itemStyle: {normal: {color: '#ff7f50'}}
                                                }]
                                        ]
                                    }
                                }
                            ]
                        };
                        myChart.setOption(option);
                    }
            );
        </script>
    @endif
    </body>
@stop
