@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'variable')) }}

<?php
    $room_drop_down = array();
    foreach ($room as $r)
         $room_drop_down =  array_add($room_drop_down, $r -> mac, $r -> room."/".$r -> mac);
    //dd($room_drop_down);
    echo Form::select('mac', $room_drop_down);
?>
<br>
<br>
{{ Form::label('name', 'Name'); }}
{{ Form::text('name'); }}
<br>
{{ Form::label('tempMax', 'tempMax'); }}
{{ Form::text('tempMax'); }}
°C
<br>
{{ Form::label('tempMin', 'tempMin'); }}
{{ Form::text('tempMin'); }}
°C
<br>
{{ Form::label('humidityMax', 'humidityMax'); }}
{{ Form::text('humidityMax'); }}
%RH
<br>
{{ Form::label('humidityMin', 'humidityMin'); }}
{{ Form::text('humidityMin'); }}
%RH
<br>
{{ Form::label('pressureMax', 'pressureMax'); }}
{{ Form::text('pressureMax'); }}
Pa
<br>
{{ Form::label('pressureMin', 'pressureMin'); }}
{{ Form::text('pressureMin'); }}
Pa
<br>
{{ Form::label('dustMax', 'dustMax'); }}
{{ Form::text('dustMax'); }}
Particle
<br>
{{ Form::label('dustMin', 'dustMin'); }}
{{ Form::text('dustMin'); }}
Particle
<br>
<br>
{{ Form::submit('Submit') }}
{{ Form::close() }}
@stop
