<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Followup_center;
use App\Models\Followup_type;
use App\Models\Sale_funnel;
use App\Models\Student;
use Illuminate\Http\Request;


class PotentialClientsController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName ;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Company $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.potential-clients.';
    $this->routeName = 'potential-clients.';
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Company::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('rows'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Company::where('id', '=', $id)->first();
        $students=Student::where('company_id',$id)->where('sale_fannel_id','!=',100)->get();
        $funnels=Sale_funnel::all();
        return view($this->viewName . 'show', compact('row', 'students','funnels'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Student::where('id', '=', $id)->first();
        $students=Student::where('company_id',$id)->get();
        $callcenter = Followup_center::where('student_id', $id)->where('followup_flag', 1)->get();
        $fullowupTypes = Followup_type::all();
        return view($this->viewName . 'viewStudent', compact('row', 'students','fullowupTypes','callcenter'));
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


    public function funnel(Request $request){
        $student = Student::where('id', $request->get('student_id'))->first();

        $student->update(['sale_fannel_id'=> $request->get('sale_fannel_id')]);
        return redirect()->back()->with('flash_success', 'تم الحفظ بنجاح !');
    }

    public function followSave(Request $request)
    {
        $input = $request->except(['_token']);
        $input['followup_flag'] = 1;
        Followup_center::create($input);
        return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');
    }


    public function followUpdate(Request $request)
    {

        $row = Followup_center::where('id', $request->get('follow_id'))->first();
        $input = $request->except(['_token','follow_id']);

        $row->update($input);
        return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');
    }
}
