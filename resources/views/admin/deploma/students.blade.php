<div class="box-body">


    <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add" class="btn btn-success">إضافة</a>
    </h3>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>موبايل</th>
                <th>ايميل</th>
                <th>دراسة</th>
                <th>وظيفة</th>
                <th>حالة الحجز</th>
                <th>ملاحظات</th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $row)
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td>{{$row->student->name ?? ''}}</td>
                <td>{{$row->student->mobile ?? ''}}</td>
                <td>{{$row->student->email ?? ''}}</td>
                <td>{{$row->student->education ?? ''}}</td>
                <td>{{$row->student->job ?? ''}}</td>
                <td>{{$row->student->status->request_status ?? ''}}
                    @if ($row->student && $row->student->request_status_id == 3)

                    <div class="btn-group">


                        <button type="button" class="btn btn-warning text-warning" data-toggle="modal"
                            data-target="#student-payment{{ $row->student->id ?? '' }}"><i class="fa fa-pound-sign" title="حذف"></i> دفع </button>
                    </div>
                    @endif
                    @if($row->student && $row->student->request_status_id  == 2)

                    <div class="btn-group">

                        <button type="button" class="btn btn-success text-success" data-toggle="modal"
                            data-target="#student-payment{{ $row->student->id ?? '' }}"><i class="fa fa-pound-sign" title="حذف"></i> سداد </button>
                    </div>
                    @endif
                </td>
                <td>{{$row->student->note ?? ''}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delStudent{{ $row->id }}"><i class="fa fa-times" title="حذف"></i></button>
                    </div>
                </td>
                 <!-- Add Student Payment Modal -->
                 <div class="modal fade dir-rtl" id="student-payment{{ $row->student->id ?? '' }}" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="exampleModalLabel">تحصيل قيمة الدورة</h5>
                                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('pay-student-deploma') }}" method="post">
                                @csrf
                                <?php
                                $total_fees_new = App\Models\Invoice::where('student_id', $row->student->id)
                                    ->where('deploma_id', $deplom->id)
                                    ->whereIn('payment_type_id', [105, 102])
                                    ->sum('total_fees_new');
                                ?>
                                <div class="modal-body text-center">
                                    <h3><i class="fa fa-edit "></i></h3>
                                    <h4> تسجيل سداد </h4>
                                    <input type="hidden" name="deploma_id" value="{{$deplom->id }}">
                                    <input type="hidden" name="student_id"
                                        @if ($row->student) value="{{ $row->student->id }}" @endif>
                                    <input type="hidden" name="branch_id" value="{{ $row->deploma->branch_id }}">

                                    <div class="row">
                                        {{-- <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">رقم الفاتورة</label>
                                                <input type="text" name="invoice_no"
                                                    value="{{ old('invoice_no') }}" class="form-control" id="">
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">إسم الدبلومة</label>
                                                <input type="text" value="{{ $deplom->name ?? '' }}"
                                                    class="form-control" id="" disabled placeholder="فاشون أزياء">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">قيمة الدبلومة</label>
                                                <input type="text" name="total_required_fees"
                                                    onchange="myFunction()"
                                                    value="{{ $deplom->fees ?? '' }}"
                                                    class="form-control"
                                                    id="total_required_fees{{ $row->student->id }}" readonly>
                                            </div>
                                        </div>
                                        <?php
                                        if ($row->student) {
                                            $payedInvoice = App\Models\Invoice::where('student_id', $row->student->id)
                                                ->where('deploma_id', $deplom->id)
                                                ->orderBy('created_at', 'Desc')
                                                ->first();
                                            // echo $payedInvoice;
                                        }
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">إجمالى المدفوع</label>
                                                <input type="text" name="total_paid_before"
                                                    value="{{ $total_fees_new ?? '' }}" class="form-control"
                                                    id="total_paid_before{{ $row->student->id }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">القيمة المدفوعة</label>
                                                <input type="text" name="total_fees_new"
                                                    onchange="myFunction({{ $row->student->id }})"
                                                    class="form-control"
                                                    id="total_fees_new{{ $row->student->id }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">القيمة المتبقية</label>
                                                <input type="text" name="remain" class="form-control"
                                                    id="remain{{ $row->student->id }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">تاريخ السداد</label>
                                                <input type="date" name="invoice_date" class="form-control" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-success">حفظ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                  <!-- Delete Modal -->
         <div class="modal modal-danger" id="delStudent{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <form action="{{ route('deploma-student.destroy', $row->id) }}"  method="POST" >
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                        </button>
                    </div>
                    <div class="modal-body bg-light">
                        <p><i class="fa fa-fire "></i></p>
                        <p>حذف جميع البيانات ؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left"
                            data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-outline">حفظ </button>
                    </div>
                </div>
            </form>
        </div>
            @endforeach

        </tbody>


        </tbody>
    </table>

</div>

<!-- Add Student Modal -->
<div class="modal fade dir-rtl" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة طالب</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{route('add-student-deploma')}}" method="post">
        @csrf
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4>تأكيد إضافة الطالب </h4>
                <input type="hidden" name="deploma_id" value="{{$deplom->id}}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>رقم هوية الطالب</label>
                            <select class="form-control select2" name="student_id" style="width: 100%;">
                                <option selected="selected">...</option>
                                @foreach ($allStudents as $all)
                                <option value="{{$all->id}}">{{$all->name}}</option>
                                @endforeach


                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-4 mt-2">
                        <br />
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-student">إضافة طالب
                            جديد</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit"  class="btn btn-success">حفظ</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Add New Student Modal -->
<div class="modal fade dir-rtl" id="new-student" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة طالب جديد</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('deploma-student.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="deploma_id" value="{{$deplom->id}}">
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4> إضافة طالب جديد </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">إسم الطالب</label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">موبايل</label>
                            <input type="tel" name="mobile" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ايميل</label>
                            <input type="email" name="email" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">دراسة </label>
                            <input type="text" name="education" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">وظيفة</label>
                            <input type="text" name="job" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات </label>
                            <input type="text" name="note" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-success">حفظ</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Student Payment Modal -->
<div class="modal fade dir-rtl" id="student-payment" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تحصيل قيمة الدورة</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4> تسجيل سداد </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">إسم الدورة</label>
                            <input type="text" class="form-control" id="" disabled placeholder="فاشون أزياء">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">قيمة الدورة</label>
                            <input type="text" class="form-control" id="" disabled placeholder="150">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">القيمة المدفوعة</label>
                            <input type="text" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">القيمة المتبقية</label>
                            <input type="text" class="form-control" id="" disabled placeholder="100">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">تاريخ السداد</label>
                            <input type="date" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-success">حفظ</button>
            </div>
        </div>
    </div>
</div>
