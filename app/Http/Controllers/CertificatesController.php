<?php

namespace App\Http\Controllers;

use App\Models\Student_round;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Student_round $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.certificates.';
        $this->routeName = 'certificates.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notBooking = Student_round::where('certificate_status_id', '=', 1)->orderBy("created_at", "Desc")->get();
        $Booking = Student_round::where('certificate_status_id', '=', 2)->orderBy("created_at", "Desc")->get();
        $printing = Student_round::where('certificate_status_id', '=', 3)->orderBy("created_at", "Desc")->get();
        return view($this->viewName . 'index', compact('notBooking', 'Booking', 'printing'));
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

        $cerificate = $request->get('cerificate');
        // dd($cerificate);
        if( $cerificate){
            foreach ($cerificate as $row) {

                $this->object::findOrFail($row)->update(['certificate_status_id' => 3]);
            }
            return redirect()->route($this->routeName.'index')->with('flash_success', 'تم الحفظ بنجاح');

        }
        // else{
        //     return redirect()->back()->with('flash_danger', 'لم يتم اختيار طلاب !');
        // }
        dd($request->all());
        if($request->get('cerification')){

            $this->object::findOrFail($request->get('cerification'))->update(['certificate_status_id' => 3]);
            return redirect()->route($this->routeName.'index')->with('flash_success', 'تم الحفظ بنجاح');

        }

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

    public function updatingCerificate(Request $request)
    {
        //  dd($request->get('certificate_id'));
        $this->object::findOrFail($request->get('certificate_id'))->update(['certificate_status_id' => 2]);

    //    return 'welcom';
       return redirect()->route($this->routeName.'index')->with('flash_success', 'تم الحفظ بنجاح');
    }
}
