<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Financial_entry;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Payment_type;
use App\Models\Round;
use App\Models\Student;
use App\Models\Student_round;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
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
        $branches = Branch::all();
        $types = Payment_type::where('payment_flag',1)->get();
        $cashboxes = Cashbox::all();
        $courses = Course::all();
        $rounds = Round::where('status_id', '!=', 2)->get();
        $students = [];
        return view($this->viewName . 'add', compact('types', 'branches', 'rounds', 'students', 'cashboxes', 'courses'));
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
            $payedInvoice=Invoice::where('student_id',$request->get('student_id'))->where('round_id',$request->get('round_id'))->first();

            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save invoice
            $max = Invoice::latest('invoice_no')->first();

            // $max = ($max != null && $max != 0) ? $max : 0;
            $max = ($max != null) ? intval($max['code']) : 0;
            $max++;
            $input = [
                'invoice_no' => $max,
                'invoice_date' => Carbon::parse($request->get('invoice_date')),
                'student_id' => $request->get('student_id'),
                'payment_type_id' => $request->get('payment_type_id'),

                'round_id' => $request->get('round_id'),
                'total_required_fees' => $request->get('total_required_fees'),

                'total_fees_new' => $request->get('total_fees_new'),
                'user_id' => Auth::user()->id,
                'cashbox_id' => $request->get('cashbox_id'),
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];

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
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', '???? ?????????? ??????????');
        } catch (\Throwable $e) {
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
        $branches = Branch::whereHas('cashbox', function ($query) use ($row) {
            $query->where('id', $row->cashbox_id);
        })->get();
        $types = Payment_type::where('payment_flag',1)->get();
        $cashboxes = Cashbox::all();

        $courses = Course::whereHas('rounds', function ($query) use ($row) {
            $query->where('id', $row->round_id);
        })->get();
        $rounds = Round::where('status_id', '!=', 2)->get();
        $students = Student_round::where('round_id', '=', $row->round_id)->get();
        return view($this->viewName . 'edit', compact('row', 'types', 'branches', 'rounds', 'students', 'cashboxes', 'courses'));
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
$max = Invoice::latest('invoice_no')->first();

// $max = ($max != null && $max != 0) ? $max : 0;
$max = ($max != null) ? intval($max['code']) : 0;
$max++;
            $input = [
                'invoice_no' => $max,
                'invoice_date' => Carbon::parse($request->get('invoice_date')),
                'student_id' => $request->get('student_id'),
                'payment_type_id' => $request->get('payment_type_id'),

                'round_id' => $request->get('round_id'),
                'total_required_fees' => $request->get('total_required_fees'),

                'total_fees_new' => $request->get('total_fees_new'),
                'user_id' => Auth::user()->id,
                'cashbox_id' => $request->get('cashbox_id'),
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];
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
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', '???? ?????????? ??????????');
        } catch (\Throwable $e) {
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
            return redirect()->back()->with('flash_success', '???? ?????????? ?????????? !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', '?????? ???????????? ???????????? ?????????? ?????? ..???? ???????? ??????????');
        }
    }

    public function fetchCourse(Request $request)
    {
        //
        $data = [];

        if (!empty($request->get('value'))) {

            $data = Round::where('course_id', '=', $request->get('value'))->get();
        }

        $output = '<option value="">..... </option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->id . '">' . $row->round_no . '</option>';
        }

        echo $output;
    }

    public function fetchRound(Request $request)
    {
        //
        $data = [];

        if (!empty($request->get('value'))) {

            $data = Student_round::where('round_id', '=', $request->get('value'))->get();
        }

        $output = '<option value="">..... </option>';
        foreach ($data as $row) {

            $output .= '<option value="' . $row->student->id . '">' . $row->student->name ?? '' . '</option>';
        }

        $fees = Round::where('id', '=', $request->get('value'))->first()->fees_after_discount;
        // echo $output;
        echo json_encode(array($output, $fees));
    }
}
