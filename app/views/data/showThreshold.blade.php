@extends('layouts.master')

@section('content')

<style>
    table, th, td {
        border: 1px solid black;
        font-size:20px;
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

        <th>温度最小值</th>
        <th>温度最大值</th>

        <th>湿度最小值</th>
        <th>湿度最大值</th>

        <th>压力最小值</th>
        <th>压力最大值</th>

        <th>尘埃微粒最小值</th>
        <th>尘埃微粒最大值</th>

        <th>上传时间间隔</th>
    </tr>

<?php

foreach ($data as $line) {
    echo '<tr>';
    echo '<td  style="color:#2c3e50; background-color: #1e90ff;">';
    echo $line['room'];
    echo '</td>';
    echo '<td>';
    echo $line['tempMin'];
    echo '</td>';
    echo '<td>';
    echo $line['tempMax'];
    echo '</td>';
    echo '<td>';
    echo $line['humidityMin'];
    echo '</td>';
    echo '<td>';
    echo $line['humidityMax'];
    echo '</td>';
    echo '<td>';
    echo $line['pressureMin'];
    echo '</td>';
    echo '<td>';
    echo $line['pressureMax'];
    echo '</td>';
    echo '<td>';
    echo $line['dustMin'];
    echo '</td>';
    echo '<td>';
    echo $line['dustMax'];
    echo '</td>';
    echo '<td>';
    echo $line['intervals'];
    echo '</td>';
    echo '</tr>';
}

?>

</table>

<br>
<br>
@stop