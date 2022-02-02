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
                <td>{{$row->student->name ?? ''}}</td>
                <td>{{$row->student->mobile ?? ''}}</td>
                <td>{{$row->student->email ?? ''}}</td>
                <td>{{$row->student->education ?? ''}}</td>
                <td>{{$row->student->job ?? ''}}</td>
                <td>{{$row->student->status->request_status ?? ''}}
                    @if($row->status && $row->status->id==3)
                    {{$row->status->request_status}}
                    <div class="btn-group">


                        <button type="button" class="btn btn-warning text-warning" data-toggle="modal"
                            data-target="#student-payment"><i class="fa fa-pound-sign" title="حذف"></i> دفع </button>
                    </div>
                    @endif
                    @if($row->status && $row->status->id==2)
                    {{$row->status->request_status}}
                    <div class="btn-group">

                        <button type="button" class="btn btn-success text-success" data-toggle="modal"
                            data-target="#student-payment"><i class="fa fa-pound-sign" title="حذف"></i> سداد </button>
                    </div>
                    @endif
                </td>
                <td>{{$row->student->note ?? ''}}</td>


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
