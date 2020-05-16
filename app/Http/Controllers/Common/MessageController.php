<?php

namespace App\Http\Controllers\Common;

use App\Http\Resources\MessageResource;
use App\Library\Helpers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=null;
            if(auth()->user()->hasRole('admin'))
                $data=Message::all();
            else{
                $data=Message::where('pid',auth()->user()->pid)->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn='<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="'.$row->id.'">  مشاهده</a>';
                    return $btn;
                })
                ->addColumn('date', function ($row){
                    return Helpers::shamsi($row->created_at);
                })
                ->addColumn('from', function ($row){
                    return User::where('pid',$row->pid)->first()->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("common.message");

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

    private function rules()
    {
        return [
            'title' => 'string|required',
            'des' => 'required|string',
            'pid' => 'exists:users'
        ];
    }

    private static function messages()
    {
        return [
            'title.required' => 'ورود عنوان الزامی است',
            'title.string' => 'عنوان باید متن باشد',
            'des.required' => 'توضیحات   الزامیست',
            'des.string' => 'توضیحات   باید متن باشد ',
            'pid.exists' => 'این کد پرسنلی یافت نشد',
        ];
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
        $project = Message::updateOrCreate(
            ['title' => $request->title, 'des' => $request->des,'pid'=>$request->pid,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['user_id' => auth()->user()->id]
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
        return  response()->json(new MessageResource(Message::find($id)),200);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
