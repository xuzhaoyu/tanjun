@extends('layouts.master')

@section('content')

    <style>
        table, th, td {
            border: 1px solid black;
            font-size: 20px;
            font-weight: 600;
        }

        th {
            background-color: #1e90ff;
            color: #2c3e50;
        }

        td {
            background-color: #94C5CC;
        }
    </style>

    <table>
        <tr>
            <th>房间</th>
            @if ($columns->temp)
                <th>温度最小值</th>
                <th>温度最大值</th>
                <th>湿度最小值</th>
                <th>湿度最大值</th>
            @endif
            @if ($columns->pressure)
                <th>压力最小值</th>
                <th>压力最大值</th>
            @endif
            @if ($columns->dust)
                <th>尘埃微粒最小值</th>
                <th>尘埃微粒最大值</th>

            @endif
            <th>上传时间间隔</th>
        </tr>
        @foreach($data as $line)
            <tr><td  style="color:#2c3e50; background-color: #1e90ff;">{{$line['room']}}</td>
                @if($columns->temp)
                    <td>{{$line['tempMin']}}</td>
                    <td>{{$line['tempMax']}}</td>
                    <td>{{$line['humidityMin']}}</td>
                    <td>{{$line['humidityMax']}}</td>
                @endif

                @if($columns->pressure)
                    <td>{{$line['pressureMin']}}</td>
                    <td>{{$line['pressureMax']}}</td>
                @endif

                @if($columns->dust)
                    <td>{{$line['dustMin']}}</td>
                    <td>{{$line['dustMax']}}</td>
                @endif
                <td>{{$line['intervals']}}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <br>
@stop