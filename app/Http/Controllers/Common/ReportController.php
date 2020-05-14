<?php

namespace App\Http\Controllers\Common;

use App\Project;
use App\Repair;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
            return  $this->makeDataTable($result);
        }
        else{
            return 'empty';
        }
    }

    public function makeDataTable($data)
    {
        $html='';
        foreach ($data as $item)
        {
            if($item->state=='Completed')
                $item->state='تکمیل شده';
            elseif ($item->state=='referred')
                $item->state=' ارجاع شده ';
            else
                $item->state='نیمه تمام';


            $html.= '  <li class="w3-bar" >
                <span class="w3-bar-item w3-button popup w3-hover-green w3-xlarge w3-left w3-animate-right " id="'.$item->id.'">
                    تهیه گزارش
                    <span class="material-icons ">
report
</span> </span>
                <div class="w3-bar-item w3-right">
                    
                    <span class="w3-large ">عنوان پروژه</span>
                    <br>
                    <span>'.$item->title.'</span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تحویل گیرنده   </span><br>
                    <span>'.$item->users->name.' </span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">وضعیت  پروژه    </span><br>
                    <span>'.$item->state.' </span>
                </div>

                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تاریخ ایجاد   پروژه    </span><br>
                    <span>'.Verta::instance($item->created_at)->format('Y/m/d H:i').' </span>
                </div>
            </li>'  ;
        }
        return $html;
   }

}
