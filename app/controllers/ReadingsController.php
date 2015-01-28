<?php

class ReadingsController extends \BaseController
{

    public function getIndex()
    {
        $all_mac = DB::table('user')->select('mac')->groupBy('mac')->get();

        $data_list = array();

        foreach ($all_mac as $mac) {
            $mac_addr = $mac->mac;

            $a = DB::table('user')
                ->where('mac', '=', $mac_addr)
                ->orderBy('serverTime', 'DESC')
                ->select('IP', 'mac', 'serverTime', 'dhtTemp', 'dhtHumidity', 'MS5611Temp', 'MS5611Pressure', 'MQ2Smoke', 'Dust')
                ->first();

            $n = DB::table('ip2name')
                ->select('room')
                ->where('mac', '=', $mac_addr)
                ->first();

            $data_list[] = array(
                'room' => $n->room,
                'mac' => $mac_addr,
                'dhtTemp' => $a->dhtTemp,
                'dhtHumidity' => $a->dhtHumidity,
                'MS5611Temp' => $a->MS5611Temp,
                'MS5611Pressure' => $a->MS5611Pressure,
                'MQ2Smoke' => $a->MQ2Smoke,
                'Dust' => $a->Dust,
                'serverTime' => $a->serverTime
            );

        }
        return View::make('data.presentData')->with('data', $data_list);
    }

    public function getForm()
    {
        $room = DB::table('ip2name')->select('room', 'mac')->get();
        return View::make('data.setThreshold')->with('room', $room);
    }

    public function postVariable()
    {
        $input = Input::all();
        $mac = DB::table('thresholds')->select('mac')->where('mac', '=', $input['mac'])->get();
        if ($mac == []) {
            DB::table('thresholds')->insert(array('mac' => $input['mac']));
        }
        if (is_numeric($input['tempMin'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('tempMin' => $input['tempMin']));
        }
        if (is_numeric($input['tempMax'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('tempMax' => $input['tempMax']));
        }
        if (is_numeric($input['humidityMin'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('humidityMin' => $input['humidityMin']));
        }
        if (is_numeric($input['humidityMax'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('humidityMax' => $input['humidityMax']));
        }
        if (is_numeric($input['pressureMin'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('pressureMin' => $input['pressureMin']));
        }
        if (is_numeric($input['pressureMax'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('pressureMax' => $input['pressureMax']));
        }
        if (is_numeric($input['smokeMin'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('smokeMin' => $input['smokeMin']));
        }
        if (is_numeric($input['smokeMax'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('smokeMax' => $input['smokeMax']));
        }
        if (is_numeric($input['dustMin'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('dustMin' => $input['dustMin']));
        }
        if (is_numeric($input['dustMax'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('dustMax' => $input['dustMax']));
        }
        if (is_numeric($input['intervals'])) {
            DB::table('thresholds')->where('mac', '=', $input['mac'])->update(array('intervals' => $input['intervals']));
        }
        if(strlen($input['name']) > 0){
          DB::table('ip2name')->where('mac', '=', $input['mac'])->update(array('room' => $input['name']));
        }
        return View::make('success');
    }

    public function postControls(){
      $input = Input::all();
      $thresholds = DB::table('thresholds')->select('*')->where('mac', '=', $input['mac'])->get();
      return $thresholds;
    }

    public function getGraph($room)
    {
        $m = DB::table('ip2name')
            ->where('room', '=', $room)
            ->select('mac')
            ->first();

        $mac = $m->mac;

        $all_tp = DB::table('user')
            ->where('mac', '=', $mac)
            ->orderBy('serverTime')
            ->select('serverTime', 'dhtTemp', 'dhtHumidity', 'MS5611Pressure', 'MQ2Smoke', 'Dust')
            ->get();

        $t = DB::table('thresholds')->where('mac', '=', $mac)
            ->select('tempMin', 'tempMax', 'humidityMin', 'humidityMax', 'pressureMin', 'pressureMax', 'smokeMin', 'smokeMax', 'dustMin', 'dustMax')
            ->first();

        return View::make('data.presentGraph')->with('data', $all_tp)->with('room', $room)->with('t', $t);
    }

    public function postReading()
    {
        $input = (object)Input::all();
        date_default_timezone_set('Asia/Shanghai');
        $date = date('Y-m-d H:i:s');
        DB::table('user')->insert(
            array('clientTime' => $input->clientTime,
                'serverTime' => $date,
                'IP' => $input->IP,
                'mac' => $input->mac,
                'dhtTemp' => $input->dhtTemp,
                'dhtHumidity' => $input->dhtHumidity,
                'MS5611Temp' => $input->MS5611Temp,
                'MS5611Pressure' => $input->MS5611Pressure,
                'Dust' => $input->Dust)
        );
    }
}
