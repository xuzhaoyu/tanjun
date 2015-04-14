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
         <li><a href="{{ URL::route('readings') }}">数据</a></li>
         <li><a href="{{ URL::route('getThreshold') }}">Get Thresholds</a></li>
         <li><a href="{{ URL::route('devices') }}">Get Devices</a></li>
         <li><a href="{{ URL::route('form') }}">Set Thresholds</a></li>
         <li><a href="{{ URL::route('account-phone') }}">改报警电话</a></li>
         <li><a href="{{ URL::route('account-password') }}">改密码</a></li>
         <li><a href="{{ URL::route('account-logoff') }}">Logoff</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>
