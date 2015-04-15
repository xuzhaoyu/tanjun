<?php

class AccountController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */



    protected function getCreate() {
        return View::make('account.create');
    }

    protected function postCreate() {
        $validator = Validator::make(Input::all(), array(
            'email'           =>  'required|max:50|email|unique:users',
            'username'        =>  'required|max:20|unique:users',
            'password'        =>  'required|max:60|min:6',
            'password_again'  =>  'required|max:60|same:password'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $email = Input::get('email');
            $username = Input::get('username');
            $password = Hash::make(Input::get('password'));

            $user = User::create(array(
                'email'         => $email,
                'username'      => $username,
                'password'      => $password
            ));

            if ($user) {
                return Redirect::route('account-login')
                    -> with('global', 'Your account has already been created');
            }
        }

    }

    protected function getLogoff(){
        Auth::logout();
        return Redirect::route('account-login');
    }

    protected function getChangePhone(){
        $email = User::find(Auth::id())->email;
        $phone = DB::table('users')->select('phone','phone2')->where('email', '=', $email)->first();
        return View::make('account.phone')->with('phone',$phone);
    }

    protected function postPhone(){
        $input = Input::all();
        $email = User::find(Auth::id())->email;
        if (is_numeric($input['phone'])) {
            DB::table('users')->where('email', '=', $email)->update(array('phone' => $input['phone']));
        }
        if (is_numeric($input['phone2'])) {
            DB::table('users')->where('email', '=', $email)->update(array('phone2' => $input['phone2']));
        }
        return View::make('success');
    }

    public function postFindPhone(){
        $input = Input::all();
        $email = DB::table('ip2name')->select('email')->where('mac', '=', $input['mac'])->first();
        $thresh = DB::table('thresholds')->select('intervals')->where('mac', '=', $input['mac'])->first();
        $data = array();
        $data[0] = $thresh->intervals;
        if($email){
            $phone = DB::table('users')->select('phone', 'phone2')->where('email', '=', $email->email)->get();
            $data[1] = $phone;
            return $data;
        } else {
            return 0;
        }
    }

    protected function getLogin(){
        return View::make('account.login');
    }

    protected function postLogin() {

        $validator = Validator::make(Input::all(), array(
            'email'           =>  'required|max:50|email',
            'password'        =>  'required|max:60|min:6',
        ));

        if ($validator->fails()) {
            return Redirect::route('account-login')
                ->withErrors($validator)
                ->withInput();
        } else {

            $remember = Input::has('remember') ? true : false;

            $auth = Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ), $remember);

            if ($auth) {
                return Redirect::route('readings');
            } else {
                return Redirect::route('account-login')
                    -> with('global', 'Username or password wrong...');
            };

        }

        return Redirect::route('account-login')
            -> with('global', 'We got a problem to log you in...');

    }

    protected function getChangePassword() {
        return View::make('account.password');
    }

    protected function postChangePassword() {

        $validator = Validator::make(Input::all(), array(
            'password'        =>  'required|max:60|min:6',
            'new_password'        =>  'required|max:60|min:6',
            'new_password_again'  =>  'required|max:60|min:6|same:new_password'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-change-password')
                -> withErrors($validator);
        } else {
            $user = Auth::getUser();
            echo $user->password;
            echo Input::get('password');

            if (Hash::check(Input::get('password'), $user->password)) {
                $temp = User::find($user->id);
                echo $temp->password;
                echo '<br>';
                $user->password = Hash::make(Input::get('new_password'));
                echo $temp->password;
                if ($user->save()) {
                    return View::make('success');
                }

            } else {
                return Redirect::route('account-password')
                    -> with('global', 'The old password is incorrect.');
            }
        }


    }

}