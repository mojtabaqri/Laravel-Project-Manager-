<?php

namespace App\Http\Controllers\Common;

use App\Project;
use App\Repair;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $data=[
            'ref'=>auth()->user()->projects->where('state','referred')->count(),
            'inc'=>auth()->user()->projects->where('state','incompleted')->count(),
            'com'=>auth()->user()->projects->where('state','Completed')->count(),
        ];
        return view('admin.report')->with('statistic',$data);
    }
    public function reportFromProject(Request $request)
    {
        if($request->state==1)
        {
            $model=User::where('pid',$request->code)->first();
            if($model===null)
                return response()->json(['state'=>'کاربر یافت   یافت نشد!'],403);

            $startDate = new Carbon(Verta::parse($request->fromDate)->datetime()->format('Y-m-d H:i:s'));
            $endDate = new Carbon(Verta::parse($request->toDate)->datetime()->format('Y-m-d H:i:s'));
            $result = Project::whereBetween('created_at', [$startDate,$endDate])->get();
            if(count($result)<1)
            return response()->json(['state'=>' پروژه ای در این بازه    یافت نشد!'],403);

            return $result;
        }
        else{
            return 'empty';
        }
    }
}
