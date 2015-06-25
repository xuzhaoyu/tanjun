@extends('layouts.master')

@section('content')
    {{ Form::open(array('route' => 'command', 'files' => true)) }}

    <?php
    $room_drop_down = array();
    foreach ($room as $r)
        $room_drop_down =  array_add($room_drop_down, $r -> mac, $r -> room."/".$r -> mac."/".$r -> ip);
    echo Form::select('mac', $room_drop_down);
    ?>
    <br>
    <br>
    {{ Form::label('command', 'Command:'); }}
    {{ Form::text('command'); }}
    <br>
    {{ Form::label('code', 'Code:'); }}
    {{ Form::file('code'); }}
    <br>
    <br>
    {{ Form::token() }}
    {{ Form::submit('确认') }}
    {{ Form::close() }}
@stop
