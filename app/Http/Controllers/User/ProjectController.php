<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
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
                    $btn.='<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="'.$row->id.'">حذف</a>';
                    return $btn;
                })->addColumn('state', function ($row){
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
       Project::create($request->all());
       return redirect('projects');
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
        Project::destroy($id);
        return redirect('projects');
    }
}
