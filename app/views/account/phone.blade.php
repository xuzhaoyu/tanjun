@extends('layouts.master')

@section('content')

    {{ Form::open(array('route' => 'account-phone-post')) }}


    {{ Form::label('phone', '电话:'); }}
    {{ Form::text('phone', $phone->phone); }}
    <br>
    {{ Form::label('phone2', '电话2:'); }}
    {{ Form::text('phone2', $phone->phone2); }}
    <br>
    <br>
    {{ Form::token() }}
    {{ Form::submit('确认') }}
    {{ Form::close() }}
@stop
