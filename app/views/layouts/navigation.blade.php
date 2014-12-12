<style>
ul{
    list-style-type: none;
    padding:0;
    margin:0;
  }
</style>
<nav>
    <ul>
         <li><a href="{{ URL::route('index') }}">Home</a></li>
         <li><a href="{{ URL::route('getThreshold') }}">Get Thresholds</a></li>
         <li><a href="{{ URL::route('devices') }}">Get Devices</a></li>
         <li><a href="{{ URL::route('form') }}">Set Thresholds</a></li>
    </ul>
</nav>
<br>
<br>
