<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/15
 * Time: 11:02 AM
 */
class PhoneController extends \BaseController
{
    public function postData(){
        $input = Input::all();
        $number = DB::table('numbers')->select('phone')->where('phone', $input['phone'])->get();
        if($number){
            $phone = $input['phone']."abc";
        } else{
            $phone = $input['phone'];
        }
        DB::table('received')->insert(array(
            'client_time' => $input['client'],
            'IMEI' => $input['IMEI'],
            'phone' => $phone
        ));
        return 'Success';
    }

   public function getNumber(){
       $a = DB::table('received')
           ->orderBy('client_time', 'DESC')
           ->select('phone')
           ->first();
       return $a->phone;
   }
}