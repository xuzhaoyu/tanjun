@extends('layouts.master')

@section('content')

<?php
header( "refresh:30;" );
?>

<style>
table, th, td {
  border: 1px solid black;
}
</style>

<table>
  <tr>
    <th>房间</th>
    <th>温度</th>
    <th>湿度</th>
    <th>压力</th>
    <th>尘埃微粒</th>
    <th>时间</th>
  </tr>

  <?php
  foreach ($data as $a) {
    dd($a);
    $t = DB::table('thresholds')->where('mac', '=', $a['mac'])
    ->select('tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'dustMin', 'dustMax')
    ->first();

    echo '<tr>';
    echo '<td>';
    echo '<a href="';
    echo URL::route('home');
    echo '/';
    print_r($a['room']);

    echo '">';
    print_r($a['room']);
    echo '</a>';
    echo '</td>';

    if (($a['temp'] > $t -> tempMax) or ($a['temp'] < $t -> tempMin)) {
      echo '<td style="background-color:blue"><span style="color:red;">';
      print_r($a['temp']);
      echo '</span></td>';
    } else {
      echo '<td>';
      print_r($a['temp']);
      echo '</td>';
    }

    if (($a['humidity'] > $t -> humidityMax) or ($a['humidity'] < $t -> humidityMin)) {
      echo '<td style="background-color:blue"><span style="color:red;">';
      print_r($a['humidity']);
      echo '</span></td>';
    } else {
      echo '<td>';
      print_r($a['humidity']);
      echo '</td>';
    }

    if (($a['pressure'] > $t -> pressureMax) or ($a['pressure'] < $t -> pressureMin)) {
      echo '<td style="background-color:blue"><span style="color:red;">';
      print_r($a['pressure']);
      echo '</span></td>';
    } else {
      echo '<td>';
      print_r($a['pressure']);
      echo '</td>';
    }

    if (($a['dust'] > $t -> dustMax) or ($a['dust'] < $t -> dustMin)) {
      echo '<td style="background-color:blue"><span style="color:red;">';
      print_r($a['dust'] - 150);
      echo '</span></td>';
    } else {
      echo '<td>';
      print_r($a['dust'] - 150);
      echo '</td>';
    }

    echo '<td>';
    print_r($a['serverTime']);
    echo '</td>';

    echo '</tr>';
  }
  ?>
</table>

@stop
