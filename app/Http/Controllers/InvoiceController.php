<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Payment_type;
use App\Models\Round;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Invoice $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.invoice.';
        $this->routeName = 'invoice.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Invoice::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches=Branch::all();
        $types = Payment_type::all();
        $cashboxes=Cashbox::all();
        $courses=Course::all();
        $rounds=Round::where('status_id','!=',2)->get();
        $students=[];
        return view($this->viewName . 'add', compact('types','branches','rounds','students','cashboxes','courses'));
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

    public function fetchBranch(Request $request){
        //
        $admin = User::where('id', 1)->first();
        $users = Users_branch::orderBy('id', 'DESC');

        if (!empty($request->get('value'))) {
            $users->where('branch_id', '=', $request->get('value'));
        }

        $data = $users->get();

        $output = '<option value="">إختر الزميل</option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->user->id . '">' . $row->user->name . '</option>';
        }

        echo $output;
    }
}
