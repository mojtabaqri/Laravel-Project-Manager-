<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn='<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="'.$row->id.'">ویرایش</a>';
                    $btn.="&nbsp;&nbsp";
                    $btn.='<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="'.$row->id.'">حذف</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.register');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/dashboard');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'pid' => 'required|unique:users',
            'name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required',
        ];
    }
    public static function messages($id = '')
    {
        return [
            'name.required' => 'ورود نام الزامی است',
            'email.required' => 'ایمیل الزامیست',
            'pid.required' => 'کد پرسنلی الزامیست',
            'email.unique' => 'ایمیل تکراری است',
            'pid.unique' => 'کد پرسنلی تکراری است',
            'last_name.unique' => ' نام خانوادگی الزامیست ',
            'last_name.required' => ' ورود خانوادگی الزامیست ',
            'password.required' => ' ورود گذرواژه الزامیست   ',

        ];
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules(),self::messages());
        $user = User::updateOrCreate(
            ['name' => $request->name, 'last_name' => $request->last_name],
            ['pid' => $request->pid, 'email' => $request->email, 'password' =>bcrypt($request->password), 'role' =>$request->role]
        );
        $user->assignRole("normal");
        return 'ok';
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
        $user = User::find($id);
        $data=[
            'user'=>$user,
        ];
        return response()->json($data);
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
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->last_name=$request->last_name;
        if($user->save())
        {
            return response()->json(['success'=>'کاربر با موفقیت ویرایش  شد.']);
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
        User::destroy($id);
        $project=Project::where('user_id',$id)->delete();
        return response()->json(['success'=>'کاربر با موفقیت حذف شد.']);
    }

}
