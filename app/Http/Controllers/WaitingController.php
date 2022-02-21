<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Financial_entry;
use App\Models\Invoice;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WaitingController extends Controller
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
        $this->viewName = 'admin.waiting.';
        $this->routeName = 'waiting.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Invoice::where('payment_type_id', '=', 100)->orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allStudents = Student::all();
        $branches = Branch::all();
        $courses = Course::all();
        return view($this->viewName . 'add', compact('allStudents', 'branches', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save invoice
            $input = [
                'invoice_no' => $request->get('invoice_no'),
                'invoice_date' => Carbon::parse($request->get('invoice_date')),
                'student_id' => $request->get('student_id'),
                'payment_type_id' => $request->get('payment_type_id'),

                'round_id' => $request->get('round_id'),
                'total_required_fees' => $request->get('total_required_fees'),
                'total_paid_before' => 0,
                'total_fees_new' => $request->get('remian'),
                'user_id' => Auth::user()->id,
                // 'cashbox_id' =>Cashbox::where('branch_id',$request->get('branch_id'))->first()->id,
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];
            $cashbox = Cashbox::where('branch_id', $request->get('branch_id'))->first();
            if ($cashbox) {
                $input['cashbox_id'] = $cashbox->id;
            }
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
            //update student data
            $student = Student::where('id', $request->get('student_id'))->first();
            if ($student) {
                $student->mobile2 = $request->get('mobile2');
                $student->contact_times = $request->get('contact_times');
                $student->contact_date = Carbon::parse($request->get('contact_date'));
                $student->update();
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable$e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
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
        $row = Invoice::where('id', '=', $id)->first();
        $allStudents = Student::all();
        $branches = Branch::all();
        $courses = Course::all();
        return view($this->viewName . 'edit', compact('row','allStudents', 'branches', 'courses'));
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
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save invoice
            $input = [
                'invoice_no' => $request->get('invoice_no'),
                'invoice_date' => Carbon::parse($request->get('invoice_date')),
                'student_id' => $request->get('student_id'),
                'payment_type_id' => $request->get('payment_type_id'),

                'round_id' => $request->get('round_id'),
                'total_required_fees' => $request->get('total_required_fees'),
                'total_paid_before' => 0,
                'total_fees_new' => $request->get('remian'),
                'user_id' => Auth::user()->id,
                // 'cashbox_id' =>Cashbox::where('branch_id',$request->get('branch_id'))->first()->id,
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];
            $cashbox = Cashbox::where('branch_id', $request->get('branch_id'))->first();
            if ($cashbox) {
                $input['cashbox_id'] = $cashbox->id;
            }
            $invoice = Invoice::where('id', '=', $id)->first();
            $invoice->update($input);
            //save finance_entry
            $finance = Financial_entry::where('invoice_id', '=', $id)->first();

            $finance->start_balance_date = Carbon::parse($request->get('invoice_date'));
            // $finance->enrty_type_id = ;
            $finance->positive = $request->get('total_fees_new');
            $finance->negative = 0;
            $finance->invoice_id = $invoice->id;
            $finance->notes = $request->get('notes');
            $finance->update();
            //update student data
            $student = Student::where('id', $request->get('student_id'))->first();
            if ($student) {
                $student->mobile2 = $request->get('mobile2');
                $student->contact_times = $request->get('contact_times');
                $student->contact_date = Carbon::parse($request->get('contact_date'));
                $student->update();
            }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable$e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
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
        $row = Invoice::where('id', $id)->first();
        // Delete File ..

        try {

            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }

    public function saveStudent(Request $request)
    {
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $input = $request->except(['_token', 'round_id']);

            $student = Student::create($input);

            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'create')->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable$e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }
    }
}
