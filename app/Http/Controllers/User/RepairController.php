<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repair;

class RepairController extends Controller
{
    private static function rules()
    {
        return [
            'shift' => 'required',
            'system_id' => 'integer|required',
            'section_report' => 'required|string',
            'reporter' => 'required|string',
            'date' => 'required|string',
            'problem' => 'required|string',
            'delivery' => 'required|string',
        ];
    }

    private static function messages()
    {
        return [
            'shift.required' => 'انتخاب شیفت الزامی است',
            'system_id.required' => 'کد سیستم  الزامی است',
            'system_id.integer' => 'کد سیستم باید عدد صحیح باشد',
            'section_report.required' => '  نام واحد اعلام کننده الزامی است   ',
            'reporter.required' => '  نام  اعلام کننده الزامی است   ',
            'section_report.string' => '  نام  واحد اعلام کننده باید به صورت متن باشد     ',
            'reporter.string' => '  نام   اعلام کننده باید به صورت متن باشد     ',
            'date.required' => ' تاریخ الزامیست ',
            'problem.required' => ' عنوان مشکل  الزامیست ',
            'problem.string' => ' عنوان مشکل  باید متن باشد ',
            'delivery.string' => ' نام تحویل گیرنده باید متن باشد ',
            'delivery.required' => ' نام تحویل گیرنده الزامیست ',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $repairs=null;
        if(auth()->user()->hasRole('admin'))
            $repairs=Repair::all();
        else
            $repairs=auth()->user()->repairs;
        $data = $repairs;
        return view('user.repair')->with('repairs',$repairs);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(self::rules(),self::messages());
        $repair = Repair::updateOrCreate(
            ['shift' => $request->shift,
            'delivery' => $request->delivery,
            'problem' => $request->problem,
            'reporter' => $request->reporter,
            'system_id' => $request->system_id,
            'user_id' => auth()->user()->id,
            'section_report' => $request->section_report,
            'created_at'=> new Carbon(Verta::parse($request->date)->datetime()->format('Y-m-d H:i:s')),
            ]
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
        //
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
        Repair::destroy($id);
        return redirect('repair');
    }
}
