<?php

class AddressController extends BaseController {

    public function getUpdate($ip, $mac)
    {
        $q = DB::table('ip2name')
            -> where('mac', $mac)
            -> first();

        if ($q == NULL) {
            DB::table('ip2name')
                -> insert(array(
                    'mac' => $mac,
                    'IP' => $ip,
                    'room' => '新车间'
                ));

            return View::make('success') -> with('global', 'new device logged');

        } else {

            DB::table('ip2name')
                -> where('mac', $mac)
                -> update(array('IP' => $ip));

            return View::make('success') -> with('global', 'IP updated');
        }
    }

}
