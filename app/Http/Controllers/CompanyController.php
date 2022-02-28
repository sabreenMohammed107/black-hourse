<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CompanyController extends Controller
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
        $this->viewName = 'admin.company.';
    $this->routeName = 'company.';
    }
    /**
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
        $input = $request->except(['_token','img','active']);

            if ($request->hasFile('img')) {
                $attach_image = $request->file('img');

                $input['logo'] = $this->UplaodImage($attach_image);
            }

        if($request->has('active')){
            $input['active'] = 1;
        }else{
            $input['active'] = 0;

        }

    Company::create($input);
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
        $row = Company::where('id', '=', $id)->first();

        return view($this->viewName . 'view', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Company::where('id', '=', $id)->first();

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
        $input = $request->except(['_token','img','active']);

        if ($request->hasFile('img')) {
            $attach_image = $request->file('img');

            $input['logo'] = $this->UplaodImage($attach_image);
        }

    if($request->has('active')){
        $input['active'] = 1;
    }else{
        $input['active'] = 0;

    }

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
        $row=Company::where('id',$id)->first();
        // Delete File ..
        $file = $row->image;
        $file_name = public_path('uploads/companies/' . $file);
        try {
            File::delete($file_name);
            $row->delete();
            return redirect()->back()->with('flash_success', 'تم الحذف بنجاح !');

        } catch (QueryException $q) {
            return redirect()->back()->withInput()->with('flash_danger', $q->getMessage());

            // return redirect()->back()->with('flash_danger', 'هذه القضية مربوطه بجدول اخر ..لا يمكن المسح');
        }
    }

    /* uplaud image
       */
      public function UplaodImage($file_request)
      {
          //  This is Image Info..
          $file = $file_request;
          $name = $file->getClientOriginalName();
          $ext = $file->getClientOriginalExtension();
          $size = $file->getSize();
          $path = $file->getRealPath();
          $mime = $file->getMimeType();

          // Rename The Image ..
          $imageName = $name;
          $uploadPath = public_path('uploads/companies');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }
      public function crm($id){
          $row=Company::where('id',$id)->first();
          $courses=Course::all();
          $branches=Branch::where('company_id',$id)->get();
        return view($this->viewName . 'crm', compact('row','courses','branches'))->withCanonical($row->url);
      }

      public function saveCrm(Request $request){
// dd($request->all());
try
{
    // Disable foreign key checks!
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    $input = [
        'name'=>$request->get('name'),
        'mobile'=>$request->get('mobile'),
        'mobile2'=>$request->get('mobile2'),
        'age'=>$request->get('age'),
        'note'=>$request->get('note'),
        'sale_fannel_id '=>1,
        'company_id '=>$request->get('company_id'),
        'register_date '=>Carbon::now(),
    ];

    $student = Student::create($input);
    //save student branch
    $student->branches()->attach($request->branch_id);
    //save student course
    $student->courses()->attach($request->course_id);
    DB::commit();
    // Enable foreign key checks!
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    \Session::flash('flash_success', 'تم التسجيل بنجاح !');
    return view($this->viewName . 'done');
} catch (\Throwable$e) {
    DB::rollback();
    \Session::flash('flash_danger', 'حدث خطأ فى التسجيل !');
    return view($this->viewName . 'done');
    // return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
}
      }
}
