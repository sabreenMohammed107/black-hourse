<?php

namespace App\Http\Controllers;


use App\Models\Branch;
use App\Models\Cashbox;
use App\Models\Course;
use App\Models\Financial_entry;
use App\Models\Invoice;
use App\Models\Payment_type;
use App\Models\Round;
use App\Models\Student;
use App\Models\Student_round;
use App\Models\Payment;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TrainerPaymentController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Payment $object)
    {
        $this->middleware('auth');
        $this->object = $object;
        $this->viewName = 'admin.trainers-payment.';
        $this->routeName = 'trainers-payment.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Payment::whereNotNull('trainer_id')->orderBy("created_at", "Desc")->get();

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
        $types = Payment_type::all();
        $cashboxes = Cashbox::all();
        $courses = Course::all();
        $rounds = Round::where('status_id', '!=', 2)->get();
        $trainer = null;
        return view($this->viewName . 'add', compact('types', 'branches', 'rounds', 'trainer', 'cashboxes', 'courses'));

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
            //save Payment
            $input = [

                'start_balance_date' => Carbon::parse($request->get('start_balance_date')),
                'trainer_id' => $request->get('trainer_id'),
                'payment_type_id' => $request->get('payment_type_id'),

                'round_id' => $request->get('round_id'),
                'amount' => $request->get('amount'),

                'user_id' => Auth::user()->id,
                'cashbox_id' => $request->get('cashbox_id'),
                'notes' => $request->get('notes'),
                'system_notes' => "test",
            ];

            $payment = Payment::create($input);
           //save finance_entry
            $finance = new Financial_entry();

            $finance->start_balance_date = Carbon::parse($request->get('start_balance_date'));
            // $finance->enrty_type_id = ;
            $finance->positive =0;
            $finance->negative =  $request->get('amount');
            $finance->invoice_id = $payment->id;
            $finance->notes = $request->get('notes');
            $finance->save();
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
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
        $row = Payment::where('id', '=', $id)->first();
        $branches = Branch::whereHas('cashbox', function ($query) use ($row) {
            $query->where('id', $row->cashbox_id);
        })->get();
        $types = Payment_type::all();
        $cashboxes = Cashbox::all();

        $courses = Course::whereHas('rounds', function ($query) use ($row) {
            $query->where('id', $row->round_id);
        })->get();
        $rounds = Round::where('status_id', '!=', 2)->get();
        $trainRound=Round::where('id',$row->round_id)->first();
        $trainer =  Trainer::where('id', '=', $trainRound->trainer_id)->first();
        return view($this->viewName . 'edit', compact('row', 'types', 'branches', 'rounds', 'trainer', 'cashboxes', 'courses'));

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
        try{
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            //save invoice
                        $input = [

                            'start_balance_date' => Carbon::parse($request->get('start_balance_date')),
                            'trainer_id' => $request->get('trainer_id'),
                            'payment_type_id' => $request->get('payment_type_id'),

                            'round_id' => $request->get('round_id'),
                            'amount' => $request->get('amount'),

                            'user_id' => Auth::user()->id,
                            'cashbox_id' => $request->get('cashbox_id'),
                            'notes' => $request->get('notes'),
                            'system_notes' => "test",
                        ];
                        $invoice = Invoice::where('id', '=', $id)->first();
                        $invoice->update($input);

            //save finance_entry
                        $finance = Financial_entry::where('invoice_id', '=', $id)->first();

                        $finance->start_balance_date = Carbon::parse($request->get('start_balance_date'));
                        // $finance->enrty_type_id = ;
                        $finance->positive = 0;
                        $finance->negative = $request->get('amount');
                        $finance->invoice_id = $invoice->id;
                        $finance->notes = $request->get('notes');
                        $finance->update();
                        DB::commit();
                        // Enable foreign key checks!
                        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                        return redirect()->route($this->routeName . 'index')->with('flash_success', 'تم الحفظ بنجاح');
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
        $row = Payment::where('id', $id)->first();
        // Delete File ..

        try {

            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
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

            $data = round::where('id', '=', $request->get('value'))->first();
            $trainer =  Trainer::where('id', '=', $data->trainer_id)->first();
        }

        $outputName =$trainer->name;
        $outputId =$trainer->id;
        $fees = Round::where('id', '=', $request->get('value'))->first()->fees;
        echo json_encode(array($outputName,$outputId,$fees));
    }
}
