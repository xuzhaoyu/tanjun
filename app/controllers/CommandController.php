<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/15
 * Time: 11:02 AM
 */
class CommandController extends \BaseController
{
    public function getCommandForm(){
        $email = User::find(Auth::id())->email;
        $room = DB::table('ip2name')->select('room', 'mac', 'ip')->where('email', $email)->get();
        return View::make('data.setCommand')->with('room', $room);
    }

    public function postForm(){
        dd('Test');
        $input = Input::all();
        if(Input::hasFile('code')) {
            $path = '/root/Documents/sensors/app/storage/' . Input::file('code')->getClientOriginalName();
            Input::file('code')->move('/root/Documents/sensors/app/storage', Input::file('code')->getClientOriginalName());
        } else {
            $path = 'NULL';
        }
        DB::table('commands')->insert(array('mac' => $input['mac'], 'command' => $input['command'], 'code' => $path, 'dest' => $input['dest']));
        return View::make('success');
    }

    public function postCom(){
        $input = Input::all();
        $command = DB::table('commands')->select('command', 'id')->where('mac', '=', $input['mac'])->where('dest', '=', $input['dest'])->first();
        if($command){
            DB::table('commands')->where('id', '=', $command->id)->delete();
            return $command->command;
        }
        return "None";
    }

    public function postCode(){
        $input = Input::all();
        $command = DB::table('commands')->select('code', 'id')->where('mac', '=', $input['mac'])->where('dest', '=', $input['dest'])->first();
        $path = $command->code;
        if($command->code != 'NULL'){
            App::finish(function($request, $response) use ($path, $input, $command)
            {
                unlink($path);
                if($input['dest'] == "control"){
                    DB::table('commands')->where('id', '=', $command->id)->delete();
                }
            });

            return Response::download($path);
        }
        return "None";
    }
}