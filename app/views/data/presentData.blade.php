@extends('layouts.master')

@section('content')

    <?php
    header("refresh:120;");
    ?>

    <style>
        table, th, td {
            border: 1px solid black;
            font-size: 37px;
            font-weight: 600;
        }

        th {
            background-color: #1e90ff;
            color: #2c3e50;
        }

        td {
            background-color: #94C5CC;
        }

        span {
            color: red;
        }

        a:link {
            color: #2c3e50;
        }

        a:visited {
            color: #2c3e50;
        }
    </style>

    <table>
        <tr>
            <th>房间</th>
            @if($columns->temp)
                <th>温度</th>
                <th>湿度</th>
            @endif
            @if($columns->pressure)
                <th>压力</th>
            @endif
            @if($columns->dust)
                <th>尘埃微粒</th>
            @endif
            <th>时间</th>
        </tr>


        @foreach($data as $a)
            <?php
            $t = DB::table('thresholds')->where('mac', '=', $a['mac'])
                    ->select('tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'dustMin', 'dustMax')
                    ->first();
            ?>
            <tr>
                <td style="background-color:#1e90ff"><a href="/graph/{{$a['mac']}}/day">{{$a['room']}}</a></td>
                @if($columns->temp)
                    @if(($a['temp'] > $t->tempMax) or ($a['temp'] < $t->tempMin))
                        <td><span>{{$a['temp']}}</span></td>
                    @else
                        <td>{{$a['temp']}}</td>
                    @endif

                    @if(($a['humidity'] > $t->humidityMax) or ($a['humidity'] < $t->humidityMin))
                        <td><span>{{$a['humidity']}}</span></td>
                    @else
                        <td>{{$a['humidity']}}</td>
                    @endif
                @endif

                @if($columns->pressure)
                    @if(($a['pressure'] > $t->pressureMax) or ($a['pressure'] < $t->pressureMin))
                        <td><span>{{$a['pressure']}}</span></td>
                    @else
                    <td>{{$a['pressure']}}</td>
                    @endif
                @endif

                @if($columns->dust)
                    @if(($a['dust'] > $t->dustMax) or ($a['dust'] < $t->dustMin))
                        <td><span>{{$a['dust']}}</span></td>
                    @else
                        <td>{{$a['dust']}}</td>
                    @endif
                @endif
                <td>{{$a['serverTime']}}</td>
            </tr>
        @endforeach
    </table>

    <body>
    <br>
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
                <!-- ECharts import -->
        {{ HTML::script('js/echarts/build/dist/echarts.js'); }}
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
                            'echarts/chart/bar'
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
                                            @foreach($data as $a)
                                                '{{$a['room']}}',
                                            @endforeach
                                            ],
                                        axisLabel: {
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                yAxis: [
                                    {
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value} Pa',
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                series: [
                                    {
                                        "name": "压差",
                                        "type": "bar",
                                        "barWidth": 50,
                                        "itemStyle": {normal: {color: '#1e90ff'}},
                                        "data": [
                                            @foreach($data as $a)
                                                {{$a['pressure']}},
                                            @endforeach
                                        ]
                                    }]
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
                            'echarts/chart/bar'
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
                                            @foreach($data as $a)
                                                '{{$a['room']}}',
                                            @endforeach
                                        ],
                                        axisLabel: {
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                yAxis: [
                                    {
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value} 个',
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                series: [
                                    {
                                        "name": "尘埃微粒",
                                        "type": "bar",
                                        "barWidth": 50,
                                        "itemStyle": {normal: {color: '#1e90ff'}},
                                        "data": [
                                            @foreach($data as $a)
                                                {{$a['dust']}},
                                            @endforeach
                                        ]
                                    }]
                            };
                            myChart.setOption(option);
                        }
                );
            </script>
        @endif

        @if($columns->temp)
            <script type="text/javascript">
                require.config({
                    paths: {
                        echarts: './js/echarts/build/dist'
                    }
                });
                require(
                        [
                            'echarts',
                            'echarts/chart/bar'
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
                                            @foreach($data as $a)
                                                '{{$a['room']}}',
                                            @endforeach
                                        ],
                                        axisLabel: {
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                yAxis: [
                                    {
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value} °C',
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                series: [
                                    {
                                        "name": "温度",
                                        "type": "bar",
                                        "barWidth": 50,
                                        "itemStyle": {normal: {color: '#1e90ff'}},
                                        "data": [
                                            @foreach($data as $a)
                                                {{$a['temp']}},
                                            @endforeach
                                        ]
                                    }]
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
                            'echarts/chart/bar'
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
                                            @foreach($data as $a)
                                                '{{$a['room']}}',
                                            @endforeach
                                        ],
                                        axisLabel: {
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                yAxis: [
                                    {
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value} %RH',
                                            textStyle: {
                                                fontWeight: 'bolder'
                                            }
                                        }
                                    }],
                                series: [
                                    {
                                        "name": "湿度",
                                        "type": "bar",
                                        "barWidth": 50,
                                        "itemStyle": {normal: {color: '#1e90ff'}},
                                        "data": [
                                            @foreach($data as $a)
                                                {{$a['humidity']}},
                                            @endforeach
                                        ]
                                    }]
                            };
                            myChart.setOption(option);
                        }
                );
            </script>
        @endif
    </body>
@stop
