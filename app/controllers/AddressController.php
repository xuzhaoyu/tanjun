<?php

class AddressController extends BaseController {

    public function getUpdate($ip, $mac)
    {
        DB::table('ip2name')
            -> where('mac', $mac)
            -> update(array('IP' => $ip));

        return View::make('success');
    }

}
