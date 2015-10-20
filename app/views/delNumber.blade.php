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
            <th>Phone Number</th>
        </tr>
        @foreach ($numbers as $line)
            <tr>
                <td>{{$line -> phone}}</td>
                <td><a href="{{URL::route('delNum')}}/{{$line -> phone}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <br>
    <br>
@stop