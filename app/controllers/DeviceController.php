<?php

class DeviceController extends \BaseController {

    public function getDevices()
    {
        $data = DB::table('ip2name')
            -> select('ip', 'mac', 'room')
            -> get();
        return View::make('data.showDevice')->with('data', $data);
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
