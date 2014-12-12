@extends('layouts.master')

@section('content')
<?php

foreach ($data as $line) {
    foreach ($line as $entry) {
        echo $entry;
        echo ' ';
    }
    echo '<br>';
}

?>

<br>
<br>
@stop