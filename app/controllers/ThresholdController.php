<?php

class ThresholdController extends \BaseController {

    public function getThreshold()
    {
        $data = DB::table('thresholds') -> get();
        return View::make('data.showThreshold')->with('data', $data);
    }

}
