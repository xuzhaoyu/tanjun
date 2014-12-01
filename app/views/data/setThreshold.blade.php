{{ Form::open(array('route' => 'range')) }}
{{ Form::label('tempMax', 'tempMax'); }}
{{ Form::text('tempMax', 'value'); }}
{{ 'C' }}
{{ Form::label('tempMin', 'tempMin'); }}
{{ Form::text('tempMin', 'value'); }}
{{ Form::label('humidityMax', 'humidityMax'); }}
{{ Form::text('humidityMax', 'value'); }}
{{ Form::label('humidityMin', 'humidityMin'); }}
{{ Form::text('humidityMin', 'value'); }}
{{ Form::label('pressureMax', 'pressureMax'); }}
{{ Form::text('pressureMax', 'value'); }}
{{ Form::label('pressureMin', 'pressureMin'); }}
{{ Form::text('pressureMin', 'value'); }}
{{ Form::label('smokeMax', 'smokeMax'); }}
{{ Form::text('smokeMax', 'value'); }}
{{ Form::label('smokeMin', 'smokeMin'); }}
{{ Form::text('smokeMin', 'value'); }}
{{ Form::label('dustMax', 'DustMax'); }}
{{ Form::text('dustMax', 'value'); }}
{{ Form::label('dustMin', 'DustMin'); }}
{{ Form::text('dustMin', 'value'); }}
{{ Form::submit('Submit') }}
{{ Form::close() }}