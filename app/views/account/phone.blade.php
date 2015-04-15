@extends('layouts.master')

@section('content')

    {{ Form::open(array('route' => 'account-phone-post')) }}


    {{ Form::label('phone', '电话:'); }}
    {{ Form::text('phone', $phone); }}
    <br>
    <br>
    {{ Form::token() }}
    {{ Form::submit('确认') }}
    {{ Form::close() }}
@stop
