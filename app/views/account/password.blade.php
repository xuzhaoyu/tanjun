@extends('layouts.master')


@section('content')
    <form action=" {{ URL::route('account-password-post') }} " method="post">
        <div>
            密码: <input type="password" name="password">
            @if ($errors->has())
                {{ $errors->first("password") }}
            @endif
        </div>

        <div>
            新密码: <input type="password" name="new_password">
            @if ($errors->has())
                {{ $errors->first("new_password") }}
            @endif
        </div>

        <div>
            再次输入新密码: <input type="password" name="new_password_again">
            @if ($errors->has())
                {{ $errors->first("new_password_again") }}
            @endif
        </div>

        <br>

        <input type="submit" value="确认">
        {{ Form::token() }}
    </form>
@stop
