<style>
ul{
    list-style-type: none;
    padding:0;
    margin:0;
    font-size:27px;
  }
li{
    float:left;
    padding-right: 32px;
}
</style>
<br>
<br>
<nav>
    <ul>
         <li><a href="{{ URL::route('readings') }}">Readings</a></li>
         <li><a href="{{ URL::route('getThreshold') }}">Get Thresholds</a></li>
         <li><a href="{{ URL::route('devices') }}">Get Devices</a></li>
         <li><a href="{{ URL::route('form') }}">Set Thresholds</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>
