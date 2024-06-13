<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //if ($socialUser = User::socialUser($request->get('email'))->first()) {
        //    return $this->updateSocialAccount($request, $socialUser);
        //}

        return $this->createNativeAccount($request);
    }

    /**
     * A user tries to register a native account for the first time.
     * S/he has not logged into this service before with a social account.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function createNativeAccount(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        //$confirmCode = str_random(60);
        $confirmCode = Str::random(60);
        
        /*
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
        ]);
        */
        DB::statement('
            INSERT INTO users (name, email, password, confirm_code, activated)
            VALUES (?, ?, ?, ?, ?)
        ', [
            $request->input('name'),
            $request->input('email'),
            bcrypt($request->input('password')),
            $confirmCode,
            0, // Assuming 'activated' defaults to 0 until confirmation
        ]);
        $user_id = DB::getPdo()->lastInsertId();
        //echo $user_id;

        //event(new \App\Events\UserCreated($user));

        return $this->respondConfirmationEmailSent();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function respondConfirmationEmailSent()
    {
        //flash(trans('auth.users.info_confirmation_sent'));
        flash('가입하신 메일 계정으로 가입확인 메일을 보내드렸습니다. 가입확인하시고 로그인해 주세요.');

        return redirect(route('root'));
    }

}
