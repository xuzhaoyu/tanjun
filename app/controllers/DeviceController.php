<?php

class DeviceController extends \BaseController {

    public function getDevices()
    {
        $data = DB::table('ip2name') -> get();
        return View::make('data.showThreshold')->with('data', $data);
    }

}
