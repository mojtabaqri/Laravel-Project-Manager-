<?php

namespace App\Http\Controllers\Common;

use App\Help;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\RepairsResource;
use App\Library\Helpers;
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
        $data = [
            'ref' => auth()->user()->projects->where('state', 'referred')->count(),
            'inc' => auth()->user()->projects->where('state', 'incompleted')->count(),
            'com' => auth()->user()->projects->where('state', 'Completed')->count(),
        ];
        return view('admin.report')->with('statistic', $data);
    }

    public function reportFromProject(Request $request)
    {
        $model = User::where('pid', $request->code)->first();
        if ($model === null) //if project request
            return response()->json(['state' => 'کاربر یافت   یافت نشد!'], 403);
        $startDate = new Carbon(Verta::parse($request->fromDate)->datetime()->format('Y-m-d H:i:s'));
        $endDate = new Carbon(Verta::parse($request->toDate)->datetime()->format('Y-m-d H:i:s'));
        if ($request->state == 1) {
            $result = Project::whereBetween('created_at', [$startDate, $endDate])->where('user_id',$model->id)->get();
            if (count($result) < 1)
                return response()->json(['state' => ' پروژه ای در این بازه    یافت نشد!'], 403);
            return $this->makeDataTable($result,1);
        } else if($request->state == 2){ //if repair request
            $result = Repair::whereBetween('created_at', [$startDate, $endDate])->where('user_id',$model->id)->get();
            if (count($result) < 1)
                return response()->json(['state' => ' رکوردی در این بازه    یافت نشد!'], 403);
            return $this->makeDataTable($result,2);

        }
        else{  //if helps desk report requeset
            $result = Help::whereBetween('created_at', [$startDate, $endDate])->where('user_id',$model->id)->get();
            if (count($result) < 1)
                return response()->json(['state' => ' رکوردی در این بازه    یافت نشد!'], 403);
            return $this->makeDataTable($result,3);
        }
    }

    public function makeDataTable($data,$type)
    {
        if($type==1){
            $html = '';
            foreach ($data as $item) {
                if ($item->state == 'Completed')
                    $item->state = 'تکمیل شده';
                elseif ($item->state == 'referred')
                    $item->state = ' ارجاع شده ';
                else
                    $item->state = 'نیمه تمام';


                $html .= '  <li class="w3-bar" >
               <a  target="_blank" href="'."reportMaker/"."$item->id" ."/"."project". '"> <span class="w3-bar-item w3-button popup w3-hover-green w3-xlarge w3-left w3-animate-right " id="' . $item->id . '">
                    تهیه گزارش
                    <span class="material-icons ">
report
</span> </span></a>
                <div class="w3-bar-item w3-right">
                    
                    <span class="w3-large ">عنوان پروژه</span>
                    <br>
                    <span>' . $item->title . '</span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تحویل گیرنده   </span><br>
                    <span>' . $item->users->name . ' </span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">وضعیت  پروژه    </span><br>
                    <span>' . $item->state . ' </span>
                </div>

                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تاریخ ایجاد   پروژه    </span><br>
                    <span>' . Verta::instance($item->created_at)->format('Y/m/d H:i') . ' </span>
                </div>
            </li>';
            }
            return $html;
        }
        else if ($type==2){
            $html = '';
            foreach ($data as $item) {
                $html .= '  <li class="w3-bar" >
               <a  target="_blank" href="'."reportMaker/"."$item->id" ."/"."repair". '"> <span class="w3-bar-item w3-button popup w3-hover-green w3-xlarge w3-left w3-animate-right " id="' . $item->id . '">
                    تهیه گزارش
                    <span class="material-icons ">
report
</span> </span></a>
            
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">کاربر  ثبت کننده    </span><br>
                    <span>' . $item->users->name . ' </span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">شیفت    </span><br>
                    <span>' . $item->shift . ' </span>
                </div>
                 <div class="w3-bar-item w3-right">
                    <span class="w3-large">کد سیستم     </span><br>
                    <span>' . $item->system_id . ' </span>
                </div>
                
                   <div class="w3-bar-item w3-right">
                    <span class="w3-large">واحد اعلام کننده </span><br>
                    <span>' . $item->section_report . ' </span>
                </div>
                      
                          <div class="w3-bar-item w3-right">
                    <span class="w3-large">  مشکل </span><br>
                    <span>' . $item->problem . ' </span>
                </div>
                            <div class="w3-bar-item w3-right">
                    <span class="w3-large">  فرد اعلام کننده  </span><br>
                    <span>' . $item->reporter . ' </span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تاریخ دریافت       </span><br>
                    <span>' . Verta::instance($item->created_at)->format('Y/m/d') . ' </span>
                </div>
            </li>';
            }
            return $html;
        }
        else{
            $html = '';
            foreach ($data as $item) {
                $html .= '  <li class="w3-bar" >
               <a  target="_blank" href="'."reportMaker/"."$item->id" ."/"."helps". '"> <span class="w3-bar-item w3-button popup w3-hover-green w3-xlarge w3-left w3-animate-right " id="' . $item->id . '">
                    تهیه گزارش
                    <span class="material-icons ">
report
</span> </span></a>
            
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">کاربر  ثبت کننده    </span><br>
                    <span>' . $item->users->name . ' </span>
                </div>
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">  داخلی     </span><br>
                    <span>' . $item->phone_number . ' </span>
                </div>
                 <div class="w3-bar-item w3-right">
                    <span class="w3-large"> مشکل     </span><br>
                    <span>' . $item->problem . ' </span>
                </div>
                
             
                   
                <div class="w3-bar-item w3-right">
                    <span class="w3-large">تاریخ دریافت       </span><br>
                    <span>' . Verta::instance($item->created_at)->format('Y/m/d') . ' </span>
                </div>
            </li>';
            }
            return $html;
        }

    }

    public function reportMaker($id,$type)
    {

        if($type=="project"){
            $data=Project::find($id);
            if($data!=null){
                $info=[
                    'id'=>$data->id,
                    'title'=>$data->title,
                    'description'=>$data->description,
                    'userName'=>$data->users->name,
                    'state'=>Helpers::getState($data->state),
                    'created_at'=>Verta::instance($data->created_at)->format('Y-m-d'),
                    'expireDay'=>Verta::instance($data->expired_date)->format('Y-m-d'),
                    'day'=>Carbon::now()->diffInDays($data->expire_date,false),
                ];
                return view('admin.reportMaker',compact("info"));
            }
            return abort(404);
        }
        else if($type=="repair")
        {
            $data=Repair::find($id);
            if($data!=null) {
                $info=[
               'id'=>$data->id ,
               'shift'=>$data->shift ,
               'system_id'=>$data->system_id,
               'section_report'=>$data->section_report,
               'reporter'=>$data->reporter ,
               'problem'=>$data->problem ,
               'date'=>Helpers::shamsi($data->created_at) ,
               'delivery'=>$data->delivery ,
               'solution'=>$data->solution ,
               'girande'=>$data->girande ,
               'user_id'=>$data->users->pid ,
                ];
                return view('admin.reportRepiar', compact("info"));
            }
        }
        else if ($type=="helps"){
            $data=Help::find($id);
            if($data!=null) {
                $info=[
                    'id'=>$data->id ,
                    'phone_number'=>$data->phone_number ,
                    'pid'=>$data->pid,
                    'state'=>Helpers::getState($data->state),
                    'problem'=>$data->problem ,
                    'solution'=>$data->solution ,
                    'created_at'=>Helpers::shamsi($data->created_at) ,
                    'user_id'=>$data->users->name ,
                ];
                return view('admin.reportHelp', compact("info"));

            }

        }
        return abort(404);

    }

}
