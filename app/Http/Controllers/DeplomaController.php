<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Deploma;
use App\Models\Deploma_student;
use App\Models\Financial_entry;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DeplomaController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName ;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Deploma $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:users-create', ['only' => ['create','store']]);
        // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.deploma.';
    $this->routeName = 'deploma.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Deploma::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewName . 'add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        Deploma::create($input);
        return redirect()->route($this->routeName.'index')->with('flash_success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Deploma::where('id', '=', $id)->first();
        $students = Deploma_student::where('deploma_id', $id)->get();
        $deplom=Deploma::where('id', '=', $id)->first();
        $courseAll=Course::all();
        $allStudents = Student::all();
        return view($this->viewName . 'view', compact('row','students','deplom','allStudents','courseAll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Deploma::where('id', '=', $id)->first();

        return view($this->viewName . 'edit', compact('row'));
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
        $input = $request->except(['_token']);


        $this->object::findOrFail($id)->update($input);
    return redirect()->route($this->routeName.'index')->with('flash_success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row=Deploma::where('id',$id)->first();
        // Delete File ..

        try {

            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }
    }

    public function payStudentDeploma(Request $request){
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save invoice
            $payedInvoice = Invoice::where('student_id', $request->get('student_id'))->whereIn('payment_type_id', [105, 102])->where('deploma_id', $request->get('deploma_id'))->first();
            $max = Invoice::latest('invoice_no')->first();

        // $max = ($max != null && $max != 0) ? $max : 0;
        $max = ($max != null) ? intval($max['code']) : 0;
        $max++;
            $input = [
                'invoice_no' => $max,
                'invoice_date' => Carbon::parse($request->get('invoice_date')),
                'student_id' => $request->get('student_id'),

                'deploma_id' => $request->get('deploma_id'),
                'total_required_fees' => $request->get('total_required_fees'),

                'total_fees_new' => $request->get('total_fees_new'),
                'user_id' => Auth::user()->id,
                // 'cashbox_id' =>Cashbox::where('branch_id',$request->get('branch_id'))->first()->id,
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];
            $cashbox = Cashbox::where('branch_id', $request->get('branch_id'))->first();
            if ($cashbox) {
                $input['cashbox_id'] = $cashbox->id;
            }
            if ($payedInvoice) {
                $input['payment_type_id'] = 102;
            } else {
                $input['payment_type_id'] = 105;
            }
            // dd($input);
            $invoice = Invoice::create($input);
            //save finance_entry

            $finance = new Financial_entry();

            $finance->start_balance_date = Carbon::parse($request->get('invoice_date'));
            // $finance->enrty_type_id = ;
            $finance->positive = $request->get('total_fees_new');
            $finance->negative = 0;
            $finance->invoice_id = $invoice->id;
            $finance->notes = $request->get('notes');
            $finance->save();
//update student
            $student = Student::where('id', $request->get('student_id'))->first();
            $total_fees_new = Invoice::where('student_id', $request->get('student_id'))->where('deploma_id', $request->get('deploma_id'))->whereIn('payment_type_id', [105, 102])->sum('total_fees_new');

            if ($total_fees_new == $invoice->total_required_fees) {
                $student->request_status_id = 1;
                $student->update(); // dd(1);

            } else {
                $student->request_status_id = 2;
                $student->update();
                // dd($student);

            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->back()->withInput()->with('flash_success', 'تم الحفظ بنجاح');
            // return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable$e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }
}
