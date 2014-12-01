<?php

class ReadingsController extends \BaseController {

	public function getIndex(){
		//$d = DB::table('user')->get();
		$all_mac = DB::table('user')->select('mac')->groupBy('mac')->get();

		$data_list = array();

		foreach ($all_mac as $mac) {
			$mac_addr = $mac -> mac;

			$a = DB::table('user')
			-> where('mac', '=', $mac_addr)
			-> orderBy('serverTime', 'DESC')
			-> select('IP', 'mac', 'serverTime', 'dhtTemp', 'dhtHumidity', 'MS5611Temp', 'MS5611Pressure', 'MQ2Smoke', 'Dust')
			-> first();

			$n = DB::table('ip2name')
			-> select('room')
			-> where('mac', '=', $mac_addr)
			-> first();

			$data_list[] = array(
				'room' => $n -> room,
				'dhtTemp' => $a -> dhtTemp,
				'dhtHumidity' => $a -> dhtHumidity,
				'MS5611Temp' => $a -> MS5611Temp,
				'MS5611Pressure' => $a -> MS5611Pressure,
				'MQ2Smoke' => $a -> MQ2Smoke,
				'Dust' => $a -> Dust,
				'serverTime' => $a -> serverTime
			);

		}
		return View::make('data.presentData') -> with('data', $data_list);
	}
	public function getGraph($room) {
				$m = DB::table('ip2name')
					    -> where('room', '=', $room)
					    -> select('mac')
						-> first();

				$mac = $m -> mac;

				$all_tp = DB::table('user')
						-> where('mac', '=', $mac)
						-> orderBy('serverTime')
						-> select('serverTime', 'dhtTemp', 'dhtHumidity', 'MS5611Pressure', 'MQ2Smoke', 'Dust')
						-> get();

				return View::make('data.presentGraph') -> with('data', $all_tp) -> with('room', $room);
	}

    public function postRange(){
        return View::make('data.setThreshold');
    }
	public function postReading(){
		$input = (object)Input::all();
		date_default_timezone_set('America/Toronto');
		$date = date('Y-m-d H:i:s');
		DB::table('user')->insert(
		array('clientTime'=>$input->clientTime,
			'serverTime'=>$date,
			'IP'=>$input->IP,
			'mac'=>$input->mac,
			'dhtTemp'=>$input->dhtTemp,
			'dhtHumidity'=>$input->dhtHumidity,
			'MS5611Temp'=>$input->MS5611Temp,
			'MS5611Pressure'=>$input->MS5611Pressure,
			'MQ2Smoke'=>$input->MQ2Smoke,
			'Dust'=>$input->Dust)
		);
	}
	public function postUpload(){
		$input = Input::file('file');
		$mac = Input::get('mac');
		$dest = storage_path()."/video/{$mac}/";
		$filename = str_random(6).'_'.$input->getClientOriginalName();
		$input->move($dest, $filename);
		//return $filename;
	}

}
