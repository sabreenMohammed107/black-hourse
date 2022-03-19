<div class="box-body">

    <h3>
        عدد الطلاب المشتركين :{{ count($students) }}
    </h3>
    <h4>
        سعة القاعة : {{ $row->room->capacity ?? '' }} طالب
    </h4>
    @if (count($students) >= $row->room->capacity)
        <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add"
                class="btn btn-warning">إنتظار</a>
        </h3>
    @else
        <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add"
                class="btn btn-success">إضافة</a>
        </h3>
    @endif

    @if (count($students) >= $row->room->capacity)
        <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add_deploma"
                class="btn btn-warning">إنتظار طالب من دبلومة</a>
        </h3>
    @else
        <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add_deploma"
                class="btn btn-success">إضافة طالب من دبلومة</a>
        </h3>
    @endif

    <table id="table" data-toggle="table" data-pagination="false" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>موبايل</th>
                <th>تاريخ التسجيل</th>
                <th>دراسة</th>
                <th>وظيفة</th>
                <th>حالة الحجز</th>
                <th>ملاحظات</th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $row)
                <?php
                $invoice = App\Models\Invoice::where('student_id', '=', $row->student_id)->get();
                ?>
                <tr class="base-row">
                    <td></td>
                    <td>{{ $index + 1 }}

                        @if ($invoice->count() > 0)
                            <i class="showMore fa fa-plus-circle" data-inv="{{ $invoice->count() }}"
                                aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>{{ $row->student->name ?? '' }}</td>
                    <td>{{ $row->student->mobile ?? '' }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->register_date)) }}</td>
                    <td>{{ $row->student->education ?? '' }}</td>
                    <td>{{ $row->student->job ?? '' }}</td>
                    <td>
                        @if ($row->deploma_flag == 1)
                            الحجز تابع دبلومة
                        @else
                            {{ $row->status->request_status ?? '' }}
                            @if ($row->student && $row->status_id == 4)
                                <div class="btn-group">


                                    <button type="button" class="btn btn-success text-success" data-toggle="modal"
                                        data-target="#student-connect{{ $row->student->id ?? '' }}"> إشتراك
                                    </button>
                                </div>
                            @endif
                            @if ($row->student && $row->status_id == 3)
                                <div class="btn-group">


                                    <button type="button" class="btn btn-warning text-warning" data-toggle="modal"
                                        data-target="#student-payment{{ $row->student->id ?? '' }}"><i
                                            class="fa fa-pound-sign" title="حذف"></i> دفع
                                    </button>
                                </div>
                            @endif
                            @if ($row->student && $row->status_id == 2)
                                <div class="btn-group">

                                    <button type="button" class="btn btn-success text-success" data-toggle="modal"
                                        data-target="#student-payment{{ $row->student->id ?? '' }}"><i
                                            class="fa fa-pound-sign" title="حذف"></i> سداد
                                    </button>
                                </div>
                            @endif
                        @endif


                    </td>
                    <td>{{ $row->student->note ?? '' }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" @if ($row->status_id == 2 || $row->status_id == 1 || (($row->round && $row->round->status_id == 1) || $row->round->status_id == 2)) disabled @endif
                                class="btn btn-default" data-toggle="modal"
                                data-target="#delStudent{{ $row->id }}"><i class="fa fa-times"
                                    title="حذف"></i></button>
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
                                <form action="{{ route('pay-student-round') }}" method="post">
                                    @csrf
                                    <?php
                                    $total_fees_new = App\Models\Invoice::where('student_id', $row->student->id)
                                        ->where('round_id', $roundSS->id)
                                        ->whereIn('payment_type_id', [101, 102])
                                        ->sum('total_fees_new');
                                    ?>
                                    <div class="modal-body text-center">
                                        <h3><i class="fa fa-edit "></i></h3>
                                        <h4> تسجيل سداد {{ $row->student->name ?? '' }} </h4>
                                        <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                                        <input type="hidden" name="student_id"
                                            @if ($row->student) value="{{ $row->student->id }}" @endif>
                                        <input type="hidden" name="branch_id" value="{{ $roundSS->branch_id }}">

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
                                                    <label for="">إسم الدورة</label>
                                                    <input type="text" value="{{ $roundSS->course->name ?? '' }}"
                                                        class="form-control" id="" disabled placeholder="فاشون أزياء">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">قيمة الدورة</label>
                                                    <input type="text" name="total_required_fees"
                                                        onchange="myFunction()"
                                                        value="{{ $roundSS->fees_after_discount ?? '' }}"
                                                        class="form-control"
                                                        id="total_required_fees{{ $row->student->id }}" readonly>
                                                </div>
                                            </div>
                                            <?php
                                            if ($row->student) {
                                                $payedInvoice = App\Models\Invoice::where('student_id', $row->student->id)
                                                    ->where('round_id', $roundSS->id)
                                                    ->first();
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
                            <form action="{{ route('student.destroy', $row->id) }}" method="POST">
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
                                        <button type="submit" class="btn btn-outline pull-left">موافق </button>

                                        <button type="button" class="btn btn-outline "
                                            data-dismiss="modal">الغاء</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Add Student Modal -->
                    <div class="modal fade dir-rtl" id="student-connect{{ $row->student->id ?? '' }}" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel">إشتراك طالب</h5>
                                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('connect-student-round') }}" method="post">
                                    @csrf
                                    <div class="modal-body text-center">
                                        <h3><i class="fa fa-edit "></i></h3>
                                        <h4> تأكيد إضافة الطالب {{ $row->student->name ?? '' }} </h4>
                                        <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                                        <input type="hidden" name="student_id" value="{{ $row->student_id }}">
                                        <div class="row">
                                            <div class="modal-body bg-light">
                                                <p><i class="fa fa-fire "></i></p>
                                                <p> هل تريد إشتراك الطالب فى المجموعة ؟</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>

                                        <button type="submit" class="btn btn-success">نعم</button>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>

                <tr class="cat{{ $index + 1 }} display-none">
                    <td><a href="#" class="pitcher"> </a></td>
                    <td>رقم الفاتورة </td>
                    <td colspan="2">تاريخ الفاتورة </td>
                    <td colspan="2"> نوع الدفع </td>

                    <td>المبلغ المطلوب </td>
                    <td>المبلغ المدفوع</td>
                    <td>المبلغ المتبقى</td>
                    <td>طباعة</td>

                </tr>
                @foreach ($invoice as $ind => $fin)
                    <tr class="cat{{ $ind + 1 }} display-none" style="background: #ddd !important">
                        <td><a href="#" class="pitcher" data-prod-cat="{{ $ind + 1 }}"> </a></td>

                        <td>{{ $fin->invoice_no }}</td>
                        <td colspan="2">{{ date('d-m-Y', strtotime($fin->invoice_date)) }}</td>
                        <td colspan="2">{{ $fin->type->payment_type ?? '' }}</td>

                        <td>{{ $fin->total_required_fees }}</td>
                        <td>{{ $fin->total_fees_new }}</td>
                        <td>{{ $fin->total_required_fees - $fin->total_fees_new }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('invoice.edit', $fin->id) }}" class="btn btn-default"><i
                                        class="fa fa-edit" title="تعديل"></i></a>

                            </div>
                        </td>
                    </tr>
                @endforeach
                <?php
                $invoice = null;
                ?>
            @endforeach


        </tbody>
    </table>

</div>
<!-- Add Student Deploma Modal -->
<div class="modal fade dir-rtl" id="add_deploma" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة طالب</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('add-student-deploma-round') }}" method="post">
                @csrf
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit "></i></h3>
                    <h4>تأكيد إضافة الطالب </h4>
                    <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>رقم هوية الطالب</label>
                                <select class="form-control select2" name="student_id" style="width: 100%;">
                                    <option selected="selected">...</option>
                                    @foreach ($stDepolma as $all)
                                        <option value="{{ $all->student_id }}">{{ $all->student->name ?? '' }}
                                        </option>
                                    @endforeach


                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-4 mt-2">
                            <br />

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    @if (count($students) >= $roundSS->room->capacity)
                        <input type="hidden" name="wait" value="1">
                        <button type="submit" class="btn btn-warning">حفظ فى الانتظار</button>
                    @else
                        <button type="submit" class="btn btn-success">حفظ</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
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
            <form action="{{ route('add-student-round') }}" method="post">
                @csrf
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit "></i></h3>
                    <h4>تأكيد إضافة الطالب </h4>
                    <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>رقم هوية الطالب</label>
                                <select class="form-control select2" id="student_id1" name="student_id"
                                    style="width: 100%;">
                                    <option selected="selected">...</option>
                                    @foreach ($allStudents as $all)
                                        <option value="{{ $all->id }}">{{ $all->name }} /
                                            {{ $all->mobile }}
                                        </option>
                                    @endforeach


                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-4 mt-2">
                            <br />
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-student">إضافة
                                طالب
                                جديد</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    @if (count($students) >= $roundSS->room->capacity)
                        <input type="hidden" name="wait" value="1">
                        <button type="submit" class="btn btn-warning">حفظ فى الانتظار</button>
                    @else
                        <button type="submit" class="btn btn-success">حفظ</button>
                    @endif

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
            <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
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
                    @if (count($students) >= $roundSS->room->capacity)
                        <input type="hidden" name="wait" value="1">
                        <button type="submit" class="btn btn-warning">حفظ فى الانتظار</button>
                    @else
                        <button type="submit" class="btn btn-success">حفظ</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
