<!DOCTYPE html>


<html>
      <head>
          <title> Authentication System </title>
      </head>

      <body>
      <br>
      <br>
            @if (Session::has('global'))
                    <p>{{ Session::get('global') }}</p>
            @endif

            @yield('content')
      </body>
</html>
