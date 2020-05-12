<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
class Dashboard extends Controller
{
   public function show()
   {

$user=User::first();

       return view('common.dashboard')->with('user',$user);
   }
}
