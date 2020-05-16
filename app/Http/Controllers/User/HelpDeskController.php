<?php

namespace App\Http\Controllers\User;

use App\Help;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $helps = Help_Desk::all();
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
        //
    }
}
