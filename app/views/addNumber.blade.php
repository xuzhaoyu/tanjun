
@extends('layouts.master')

@section('content')
{{ Form::open(array('route' => 'add')) }}

<br>
{{ Form::label('phone', 'Phone:'); }}
{{ Form::text('phone'); }}
<br>
{{ Form::token() }}
{{ Form::submit('Submit') }}
{{ Form::close() }}
@stop
