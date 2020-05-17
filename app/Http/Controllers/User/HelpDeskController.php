<?php

namespace App\Http\Controllers\User;

use App\Help;
use App\Http\Resources\HelpResource;
use App\Library\Helpers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=null;
            if(auth()->user()->hasRole('admin'))
                $data=Help::all();
            else
                $data=auth()->user()->helps;
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
                ->addColumn('state', function ($row){
                    return Helpers::getState($row->state);
                })
                ->addColumn('problem', function ($row){
                    return Helpers::Summarize($row->problem);
                })
                ->addColumn('solution', function ($row){
                    return Helpers::Summarize($row->solution);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
       return view('user.help_desk');
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
     * @return array
     */

    private function rules()
    {
        return [
            'phone_number' => 'integer|required',
            'problem' => 'string|required',
            'solution' => 'required|string',
        ];
    }
    private static function messages()
    {
        return [
            'problem.required' => 'درج  مشکل  الزامی است',
            'problem.string' => 'عنوان مشکل متن باشد',
            'phone_number.required' => ' درج شماره داخلی  الزامیست',
            'phone_number.integer' => 'شماره داخلی باید عدد صحیح باشد',
            'solution.required' => 'راه حل مشکل  الزامیست',
            'solution.string' => 'راه حل مشکل   باید متن باشد ',
        ];
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate($this->rules(),self::messages());
        $project = Help::updateOrCreate(
            ['problem' => $request->problem, 'phone_number' => $request->phone_number],
            ['user_id' => auth()->user()->id, 'created_at' =>Carbon::now(),'solution'=>$request->solution,'pid'=>auth()->user()->pid]
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
       return  response()->json(new HelpResource(Help::find($id)),200);
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
        $help=Help::find($request->id);
        if($help!=null) {
            $help->phone_number = $request->editPhoneNumber;
            if(auth()->user()->hasRole('admin'))
            {
                $role=['pid' => 'exists:users'];
                $message=[ 'pid.exists' => 'این کد پرسنلی یافت نشد'];
                $validatedData = $request->validate($role,$message);
                $help->pid = $request->pid;
                $user_id = User::where('pid', $request->pid)->first()->id;
                $help->user_id = $user_id;
                $help->state = $request->state;
            }
            $help->problem = $request->editProblem;
            $help->solution = $request->editSolution;
            $help->save();
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
        Help::destroy($id);
    }
}
