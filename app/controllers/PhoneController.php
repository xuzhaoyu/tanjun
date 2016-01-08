<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/15
 * Time: 11:02 AM
 */
class PhoneController extends \BaseController
{
    public function getHome(){
        $a = DB::table('received')
            ->orderBy('client_time', 'DESC')
            ->select('client_time','phone','IMEI')
            ->first();
        return View::make('home')->with('a',$a);
    }
    public function getPhoneForm(){
        return View::make('addNumber');
    }

    public function postPhoneForm(){
        $input = Input::all();
        if(is_numeric($input['phone'])) {
            $columns = DB::table('numbers')->select('phone')->where('phone', $input['phone'])->first();
            if(!$columns){
                DB::table('numbers')->insert(array('phone'=>$input['phone']));
            }
        }
        return Redirect::to(URL::route('home'));
    }

    public function getDelForm(){
        $numbers = DB::table('numbers')->select('phone')->get();
        return View::make('delNumber')->with('numbers',$numbers);
    }

    public function getDelete($phone){
        DB::table('numbers')
            -> where('phone', '=', $phone)
            -> delete();
        return Redirect::to(URL::route('delNum'));
    }

    public function postData(){
        $input = Input::all();
        $number = DB::table('numbers')->select('phone')->where('phone', $input['phone'])->get();
        if($number){
            $phone = $input['phone']."abc";
        } else{
            $phone = $input['phone'];
        }
        date_default_timezone_set('Asia/Shanghai');
        DB::table('received')->insert(array(
            'client_time' => date('Y-m-d H:i:s'),
            'IMEI' => $input['IMEI'],
            'phone' => $phone
        ));
        return 'Success';
    }

   public function getNumber(){
       $a = DB::table('received')
           ->orderBy('client_time', 'DESC')
           ->select('client_time','phone')
           ->first();
        if($a){
            return ["client_time" => $a->client_time, "phone" => $a->phone];
        }
       return 0;
   }
}
