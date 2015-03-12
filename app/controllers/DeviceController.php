<?php

class DeviceController extends \BaseController {

    public function getDevices()
    {
        if (Auth::user()) {
            $email = User::find(Auth::id())->email;
            $data = DB::table('ip2name')->select('ip', 'mac', 'room')->where('email', $email)->get();
            return View::make('data.showDevice')->with('data', $data);
        }
        return Redirect::to(URL::route('account-login'));
    }

    public function getDelete($mac)
    {
        DB::table('sensors')
            -> where('mac', '=', $mac)
            -> delete();

        DB::table('thresholds')
            -> where('mac', '=', $mac)
            -> delete();

        DB::table('ip2name')
            -> where('mac', '=', $mac)
            -> delete();
        return Redirect::to(URL::route('devices'));
    }
}
