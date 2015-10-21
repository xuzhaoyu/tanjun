@extends('layouts.master')

@section('content')

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
            <th>Time</th>
            <th>IMEI</th>
            <th>Phone</th>
        </tr>
    @if($a)
        <tr>
            <td>{{$a->client_time}}</td>
            <td>{{$a->IMEI}}</td>
            <td>{{$a->phone}}</td>
        </tr>
    @else
        NO DATA
    @endif
    </table>
@stop