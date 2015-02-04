<?php

class AddressController extends \BaseController {

    public function getUpdate($ip, $mac)
    {
        $q = DB::table('ip2name')
            -> where('mac', $mac)
            -> first();

        if ($q == NULL) {
            DB::table('ip2name')
                -> insert(array(
                    'mac' => $mac,
                    'ip' => $ip,
                    'room' => '新车间'
                ));
            DB::table('thresholds')
                -> insert(array(
                  'mac' => $mac,
                  'tempMin' => 0,
                  'tempMax' => 0,
                  'humidityMin' => 0,
                  'humidityMax' => 0,
                  'pressureMin' => 0,
                  'pressureMax' => 0,
                  'dustMin' => 0,
                  'dustMax' => 0,
                  'intervals' => 30
                ));

            return View::make('success') -> with('global', 'new device logged');

        } else {
            DB::table('ip2name')
                -> where('mac', $mac)
                -> update(array('ip' => $ip));

            return View::make('success') -> with('global', 'IP updated');
        }
    }

}
