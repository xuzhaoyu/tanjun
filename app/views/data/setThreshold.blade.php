@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'variable')) }}

<?php
    $room_drop_down = array();
    foreach ($room as $r)
         $room_drop_down =  array_add($room_drop_down, $r -> mac, $r -> room."/".$r -> mac."/".$r -> ip);
    echo Form::select('mac', $room_drop_down);
?>
<br>
<br>
{{ Form::label('name', '房间名称:'); }}
{{ Form::text('name'); }}
<br>
{{ Form::label('tempMin', '最小温度:'); }}
{{ Form::text('tempMin'); }}
°C
<br>
{{ Form::label('tempMax', '最大温度:'); }}
{{ Form::text('tempMax'); }}
°C
<br>
{{ Form::label('humidityMin', '最小湿度:'); }}
{{ Form::text('humidityMin'); }}
%RH
<br>
{{ Form::label('humidityMax', '最大湿度:'); }}
{{ Form::text('humidityMax'); }}
%RH
<br>
{{ Form::label('pressureMin', '最小压强:'); }}
{{ Form::text('pressureMin'); }}
Pa
<br>
{{ Form::label('pressureMax', '最大压强:'); }}
{{ Form::text('pressureMax'); }}
Pa
<br>
{{ Form::label('dustMin', '最小尘埃:'); }}
{{ Form::text('dustMin'); }}
个数
<br>
{{ Form::label('dustMax', '最大尘埃:'); }}
{{ Form::text('dustMax'); }}
个数
<br>
{{ Form::label('intervals', '上传间隔:'); }}
{{ Form::text('intervals'); }}
秒
<br>
<br>
{{ Form::submit('确认') }}
{{ Form::close() }}
@stop
