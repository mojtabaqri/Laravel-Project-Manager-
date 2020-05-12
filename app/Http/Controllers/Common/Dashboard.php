<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
class Dashboard extends Controller
{
   public function show()
   {
       $user=auth()->user();
       return view('common.dashboard')->with('user',$user);
   }

    public function changePass(Request $request)
    {
        $role= ['password' => 'required'];
        $request->validate($role,self::messages());
        $user = User::find(auth()->user()->id);
        $user->password=bcrypt($request->password);
        if($user->save())
            return response()->json(['success'=>'پسورد با موفقیت تغیر یافت']);
    }
    public static function messages($id = '')
    {
        return [
            'name.required' => 'ورود نام الزامی است',
            'email.required' => 'ایمیل الزامیست',
            'pid.required' => 'کد پرسنلی الزامیست',
            'email.unique' => 'ایمیل تکراری است',
            'pid.unique' => 'کد پرسنلی تکراری است',
            'last_name.unique' => ' نام خانوادگی الزامیست ',
            'last_name.required' => ' ورود خانوادگی الزامیست ',
            'password.required' => ' ورود گذرواژه الزامیست   ',

        ];
    }
}
