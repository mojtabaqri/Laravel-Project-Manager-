<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\ProjectResource;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    private static function messages()
    {
        return [
            'title.required' => 'ورود عنوان الزامی است',
            'title.string' => 'عنوان باید متن باشد',
            'expireDate.required' => ' مهلت پروژه الزامیست',
            'expireDate.integer' => ' مهلت پروژه باید عدد صحیح باشد',
            'description.required' => 'توضیحات کوتاه  الزامیست',
            'description.string' => 'توضیحات کوتاه  باید متن باشد ',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {

        if ($request->ajax()) {
            $projects=null;
            if(auth()->user()->hasRole('admin'))
                $projects=Project::all();
            else
                $projects=auth()->user()->projects;
            $data = $projects;
            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn='<a href="javascript:void(0)" class="edit btn btn-info btn-sm" id="'.$row->id.'">  مشاهده</a>';
                    $btn.="&nbsp;&nbsp";
                    if(auth()->user()->hasRole('admin'))
                    $btn.='<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="'.$row->id.'">حذف</a>';
                    return $btn;
                })->addColumn('expire_date', function ($row){
                    $diff=Carbon::now()->diffInDays($row->expire_date,false);
                    if($diff<0)
                        return abs($diff)."روز قبل";
                    if ($diff==0)
                    {
                        $diff=Carbon::now()->diffInHours($row->expire_date,false);
                        if($diff<0)
                        return  abs($diff)."ساعت قبل";
                        else{
                            if ($diff==0)
                            {
                                $diff=Carbon::now()->diffInMinutes($row->expire_date,false);
                                if($diff==0)
                                {
                                    return 'مهلت به اتمام رسیده ';
                                }
                                if($diff<0)
                                return  abs($diff)." دقیقه گذشته";
                                else
                                    return  $diff." دقیقه مانده";
                            }
                            return  $diff."ساعت مانده";
                        }
                    }
                    return $diff.'روز مانده';
                    return Verta::instance($row->expire_date);
                })
                ->addColumn('state', function ($row){
                    switch ($row->state)
                    {
                        case "referred":
                            return $row->state='ارجاع شده';
                        case "Completed":
                            return $row->state=' تکمیل شده ';
                        case "incompleted":
                            return $row->state='نیمه تمام';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("common.projects");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules(),self::messages());
        $project = Project::updateOrCreate(
            ['title' => $request->title, 'description' => $request->description],
            ['user_id' => auth()->user()->id, 'state' => 'incompleted', 'expire_date' =>Carbon::now()->addDay($request->expireDate)]
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return  response()->json(new ProjectResource(Project::find($id)),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project=Project::find($request->id);
        $project->title=$request->title;
        $project->description=$request->description;
        $project->expire_date=Carbon::parse($project->expire_date)->addDay($request->expire_date);
        $project->state=$request->state;
        $project->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->hasRole('admin'))
        Project::destroy($id);
    }

    private function rules()
    {
        return [
            'title' => 'string|required',
            'expireDate' => 'integer|required',
            'description' => 'required|string',
        ];
    }
}
