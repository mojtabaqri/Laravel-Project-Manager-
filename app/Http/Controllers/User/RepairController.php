<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\RepairsResource;
use App\Library\Helpers;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repair;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class RepairController extends Controller
{
    private static function rules()
    {
        return [
            'shift' => 'required',
            'system_id' => 'integer|required|unique:repairs',
            'section_report' => 'required|string',
            'reporter' => 'required|string',
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
            'system_id.unique' => 'کد سیستم قبلا به سامانه اضافه شده است   ',
            'section_report.required' => '  نام واحد اعلام کننده الزامی است   ',
            'reporter.required' => '  نام  اعلام کننده الزامی است   ',
            'section_report.string' => '  نام  واحد اعلام کننده باید به صورت متن باشد     ',
            'reporter.string' => '  نام   اعلام کننده باید به صورت متن باشد     ',
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
    public function index(Request $request)
    {
        $repairs=null;
        if(auth()->user()->hasRole('admin'))
            return redirect('/dashboard');
        else
            $repairs=auth()->user()->repairs;
        $data = $repairs;
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="' . $row->id . '">  مشاهده</a>';
                    $btn .= "&nbsp;&nbsp";
                    if (auth()->user()->hasRole('admin'))
                        $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="' . $row->id . '">حذف</a>';
                    return $btn;
                })
                ->addColumn('user_id', function ($row) {
                    return $row->users->pid;
                })
                ->addColumn('date', function ($row) {
                    return Helpers::shamsi($row->created_at);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            return view('user.repair');
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
            'girande' =>$request->girande,
            'section_report' => $request->section_report,
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
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
     * @return RepairsResource
     */
    public function edit($id)
    {
      return new RepairsResource(Repair::find($id));
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
        $repair=Repair::find($id);
        $repair->solution=$request->editSolution;
        $repair->delivery=$request->editDelivery;
        $repair->save();
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
