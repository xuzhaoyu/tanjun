@extends('layouts.main')


@section('content')
<form action=" {{ URL::route('account-login-post') }} " method="post">

    <div>
        Email: <input type="text" name="email"
        {{ (Input::old('email')) ? (' value="' . e(Input::old('email')) . '"') : ('') }}>
        @if ($errors->has())
        {{ $errors->first("email") }}
        @endif
    </div>

    <div>
        密码: <input type="password" name="password">
        @if ($errors->has())
        {{ $errors->first("password") }}
        @endif
    </div>

    <div class="field">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember"> 记住 </label>
    </div>

    <br>

    <input type="submit" value="登录">
    {{ Form::token() }}
</form>
@stop
