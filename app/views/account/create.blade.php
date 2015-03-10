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
            Username: <input type="text" name="username"
            {{ (Input::old('username')) ? (' value="' . e(Input::old('username')) . '"') : ('') }}>
            @if ($errors->has())
            {{ $errors->first("username") }}
            @endif
        </div>

        <div>
            Password: <input type="password" name="password">
            @if ($errors->has())
            {{ $errors->first("password") }}
            @endif
        </div>

        <div>
            Password Again: <input type="password" name="password_again">
            @if ($errors->has())
            {{ $errors->first("password_again") }}
            @endif
        </div>

        <br>

        <input type="submit" value="Create account">
        {{ Form::token() }}
    </form>
@stop
