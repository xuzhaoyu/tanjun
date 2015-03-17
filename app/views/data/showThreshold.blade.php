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
    foreach ($line as $entry) {
        echo '<td  style="color:#2c3e50">';
        echo $entry['room'];
        echo '</td>';
        echo '<td>';
        echo $entry['tempMin'];
        echo '</td>';
        echo '<td>';
        echo $entry['tempMax'];
        echo '</td>';
        echo '<td>';
        echo $entry['humidityMin'];
        echo '</td>';
        echo '<td>';
        echo $entry['humidityMax'];
        echo '</td>';
        echo '<td>';
        echo $entry['pressureMin'];
        echo '</td>';
        echo '<td>';
        echo $entry['pressureMax'];
        echo '</td>';
        echo '<td>';
        echo $entry['dustMin'];
        echo '</td>';
        echo '<td>';
        echo $entry['dustMax'];
        echo '</td>';
        echo '<td>';
        echo $entry['intervals'];
        echo '</td>';
    }
    echo '</tr>';
}

?>

</table>

<br>
<br>
@stop