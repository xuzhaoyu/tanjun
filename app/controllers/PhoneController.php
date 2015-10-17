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
        DB::table('received')->insert(array(
            'client_time' => $input['client'],
            'IMEI' => $input['IMEI'],
            'phone' => $input['phone']."abc"
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