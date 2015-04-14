@extends('layouts.main')


@section('content')
    <form action=" {{ URL::route('account-create-post') }} " method="post">

        <div>
            Email: <input type="text" name="email"
            {{ (Input::old('email')) ? (' value="' . e(Input::old('email')) . '"') : ('') }}>
            @if ($errors->has())
                {{ $errors->first("email") }}
            @endif
        </div>

        <div>
            用户名: <input type="text" name="username"
            {{ (Input::old('username')) ? (' value="' . e(Input::old('username')) . '"') : ('') }}>
            @if ($errors->has())
            {{ $errors->first("username") }}
            @endif
        </div>

        <div>
            密码: <input type="password" name="password">
            @if ($errors->has())
            {{ $errors->first("password") }}
            @endif
        </div>

        <div>
            再一次秘密: <input type="password" name="password_again">
            @if ($errors->has())
            {{ $errors->first("password_again") }}
            @endif
        </div>

        <br>

        <input type="submit" value="Create account">
        {{ Form::token() }}
    </form>
@stop
