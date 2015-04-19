<?php

class ThresholdController extends \BaseController
{

    public function getThreshold()
    {
        if (Auth::user()) {
            $email = User::find(Auth::id())->email;
            $columns = DB::table('users')->select('temp', 'pressure', 'dust')->where('email', $email)->first();
            $all_mac = DB::table('ip2name')->select('mac', 'room')->where('email', $email)->get();
            $data = array();
            foreach ($all_mac as $mac) {
                $d = DB::table('thresholds')
                    ->select('tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'dustMin', 'dustMax', 'intervals')
                    ->where('mac', $mac->mac)
                    ->first();
                $data[] = array(
                    'room' => $mac->room,
                    'tempMin' => $d->tempMin,
                    'tempMax' => $d->tempMax,
                    'humidityMin' => $d->humidityMin,
                    'humidityMax' => $d->humidityMax,
                    'pressureMin' => $d->pressureMin,
                    'pressureMax' => $d->pressureMax,
                    'dustMin' => $d->dustMin,
                    'dustMax' => $d->dustMax,
                    'intervals' => $d->intervals
                );
            }
            return View::make('data.showThreshold')->with('data', $data)->with('columns', $columns);
        }
        return Redirect::to(URL::route('account-login'));
    }
}
