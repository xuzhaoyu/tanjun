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
        <th>IP地址</th>
        <th>MAC</th>
        <th>房间</th>
    </tr>

<?php

foreach ($data as $line) {
    echo '<tr>';

    echo '<td>';
    echo $line -> ip;
    echo '</td>';

    echo '<td>';
    echo $line -> mac;
    echo '</td>';

    echo '<td style="color:#2c3e50">';
    echo $line -> room;
    echo '</td>';

    echo '<td>';
    echo '<a href="';
    echo URL::route('devices');
    echo '/delete/';
    print_r($line -> mac);
    echo '">';
    print_r('删除');
    echo '</a>';
    echo '</td>';

    echo '</tr>';
}

?>

</table>

<br>
<br>
@stop