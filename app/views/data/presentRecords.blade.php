@extends('layouts.master')

@section('content')
    {{ Form::open(array('route' => 'editRecords')) }}
    <style>
        table, th, td {
            border: 1px solid black;
            font-size:27px;
            font-weight:600;
        }
        th{
            background-color: #1e90ff;
            color: #2c3e50;
        }
        td{
            background-color: #94C5CC;
        }
    </style>

    <table>
        <tr>
            @if($columns->temp)
                <th>温度</th>
                <th>新温度</th>
                <th>湿度</th>
                <th>新湿度</th>
            @endif

            @if($columns->pressure)
                <th>压强</th>
                <th>新压强</th>
            @endif

            @if($columns->dust)
                <th>尘埃</th>
                <th>新尘埃</th>
            @endif
            <th>检查时间</th>
        </tr>
        <?php $c = 0; ?>
        @foreach ($data as $d)
            <?php $c++; ?>
            <tr>
                {{ Form::hidden('id'.$c, $d->id); }}
                @if($columns->temp)
                    <td>{{ $d->temp }}</td>
                    <td>{{ Form::text('temp'.$c, $d->temp, ['size' => '10x2']); }}</td>
                    <td>{{ $d->humidity}}</td>
                    <td>{{ Form::text('humidity'.$c, $d->humidity, ['size' => '10x2']); }}</td>
                @endif

                @if($columns->pressure)
                    <td>{{ $d->pressure }}</td>
                    <td>{{ Form::text('pressure'.$c, $d->pressure, ['size' => '10x2']); }}</td>
                @endif

                @if($columns->dust)
                    <td>{{ $d->dust }}</td>
                    <td>{{ Form::text('dust'.$c, $d->dust, ['size' => '10x2']); }}</td>
                @endif
                <td>{{$d->serverTime}}</td>
            </tr>
        @endforeach
    </table>
    {{ Form::hidden('count', $c); }}
    {{ Form::token() }}
    {{ Form::submit('确认') }}
    {{ Form::close() }}
    <br>
    <br>
@stop