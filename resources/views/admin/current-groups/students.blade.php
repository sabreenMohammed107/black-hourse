<div class="box-body">



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
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $row)
                <tr>
                    <td></td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->student->name ?? '' }}</td>
                    <td>{{ $row->student->mobile ?? '' }}</td>
                    <td>{{ $row->student->email ?? '' }}</td>
                    <td>{{ $row->student->education ?? '' }}</td>
                    <td>{{ $row->student->job ?? '' }}</td>
                    <td>{{ $row->student->status->request_status ?? '' }}
                        @if ($row->student && $row->student->request_status_id == 3)
                            <div class="btn-group">


                                <button type="button" class="btn btn-warning text-warning" data-toggle="modal"
                                    data-target="#student-payment{{ $row->student->id ?? '' }}"><i
                                        class="fa fa-pound-sign" title="حذف"></i> دفع
                                </button>
                            </div>
                        @endif
                        @if ($row->student && $row->student->request_status_id == 2)
                            <div class="btn-group">

                                <button type="button" class="btn btn-success text-success" data-toggle="modal"
                                    data-target="#student-payment{{ $row->student->id ?? '' }}"><i
                                        class="fa fa-pound-sign" title="حذف"></i> سداد
                                </button>
                            </div>
                        @endif
                    </td>
                    <td>{{ $row->student->note ?? '' }}</td>

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
                                        <h4> تسجيل سداد </h4>
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
            @endforeach

        </tbody>


        </tbody>
    </table>

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
