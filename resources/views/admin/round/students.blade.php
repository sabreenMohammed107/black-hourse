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
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delStudent{{ $row->id }}"><i class="fa fa-times" title="حذف"></i></button>
                    </div>
                </td>
                  <!-- Delete Modal -->
         <div class="modal modal-danger" id="delStudent{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <form action="{{ route('student.destroy', $row->id) }}"  method="POST" >
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
        <form action="{{route('add-student-round')}}" method="post">
        @csrf
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4>تأكيد إضافة الطالب </h4>
                <input type="hidden" name="round_id" value="{{$roundSS->id}}">
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
            <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="round_id" value="{{$roundSS->id}}">
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
