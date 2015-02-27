<?php

class ThresholdController extends \BaseController {

    public function getThreshold()
    {
        $data = DB::table('thresholds')
            -> join('ip2name', 'thresholds.mac', '=', 'ip2name.mac')
            -> select('room', 'tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'dustMin', 'dustMax', 'intervals')
            -> get();
        return View::make('data.showThreshold')->with('data', $data);
    }

}
