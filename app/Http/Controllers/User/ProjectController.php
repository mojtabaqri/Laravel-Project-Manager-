<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\ProjectResource;
use App\Library\Helpers;
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
            'pid.exists' => 'این کد پرسنلی یافت نشد',
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
                })
                ->addColumn('user_id', function($row){
                        return $row->users->pid;
                })
                ->addColumn('expire_date', function ($row){
                  return Helpers::getDay($row);
                })
                ->addColumn('state', function ($row){
                   return Helpers::getState($row->state);
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
     *///User::where('pid','72804002')->get()->first()->id;
    public function update(Request $request, $id)
    {
        $role= [
        'title' => 'string|required',
        'description' => 'required|string',
        'pid' => 'exists:users'
    ];
        $validatedData = $request->validate($role,self::messages());
        $project=Project::find($request->id);
        if($project!=null) {
            $project->title = $request->title;
            $project->description = $request->description;
            $project->expire_date = Carbon::parse($project->expire_date)->addDay($request->expire_date);
            $project->state = $request->state;
            $project->user_id=User::where('pid',$request->pid)->first()->id;
            $project->save();
        }
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
            'pid' => 'exists:users'
        ];
    }
}
