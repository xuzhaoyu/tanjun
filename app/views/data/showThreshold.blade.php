@extends('layouts.master')

@section('content')

<style>
    table, th, td {
        border: 1px solid black;
        font-size:20px;
        font-weight:600;
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
        echo '<td>';
        echo $entry;
        echo '</td>';
    }
    echo '</tr>';
}

?>

</table>

<br>
<br>
@stop