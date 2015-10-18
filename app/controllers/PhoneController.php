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
        $all_numbers = DB::table('numbers')->select('phone')->get();
        $phone = $input['phone'];
        foreach ($all_numbers as $number){
            if($number == $input['phone']){
                $phone = $input['phone']."abc";
                break;
            }
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