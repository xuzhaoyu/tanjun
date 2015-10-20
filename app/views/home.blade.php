@extends('layouts.master')

@section('content')
    @if($a)
        {{$a->client_time}}
        {{$a->phone}}
    @else
        NO DATA
    @endif
@stop