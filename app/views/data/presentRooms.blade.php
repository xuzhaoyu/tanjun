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
            <th>房间</th>
            <th>IP地址</th>
            <th>MAC</th>
        </tr>
        @foreach($data as $line)
            <tr>
                <td style="background-color:#1e90ff"><a href="/edit/{{$line -> room}}">{{$line -> room}}</a></td>
                <td>{{$line -> ip}}</td>
                <td>{{$line -> mac}}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <br>
@stop