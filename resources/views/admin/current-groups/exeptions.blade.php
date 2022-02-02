<div class="box-body">

    <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add-exception" class="btn btn-success">إضافة</a>
    </h3>

    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>تاريخ التسجيل </th>
                <th>نوع الإستثناء </th>
                <th>حالة الطلب </th>
                <th>ملاحظات </th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exeptions as $index => $row)
                <tr>
                    <td></td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{$row->student->name ?? ''}}</td>
                    <td>{{date('d-m-Y', strtotime($row->exeption_date))}} </td>
                    <td>{{$row->type->exeption_name ?? ''}}</td>
                    <td>@if($row->exeption_status==0) لم يتم اتخاذ اجراء @elseif ($row->exeption_status==1) تمت الموافقه @else تم الرفض @endif</td>
                    <td>{{$row->notes}} </td>
                    <td>
                        <div class="btn-group">
                            {{-- <a href="{{ route('current-groups.show', $row->id) }}" class="btn btn-default"><i
                                    class="fa fa-eye" title="عرض"></i></a> --}}
                            <a data-toggle="modal" data-target="#edit-exception{{$row->id}}" class="btn btn-default"><i
                                    class="fa fa-edit" title="تعديل"></i></a>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#del{{ $row->id }}"><i class="fa fa-times"
                                    title="حذف"></i></button>
                        </div>
                    </td>
                    	<!-- Add Exception Modal -->
    <div class="modal fade dir-rtl" id="edit-exception{{$row->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة استثناء</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('current-groups.update',$row->id)}}"  method="post" >

                    @method('PUT')
                      @csrf
                    <input type="hidden" name="round_id" value="{{$roundSS->id}}">
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit "></i></h3>
                    <h4> تسجيل استثناء </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رقم هوية الطالب</label>
                                <select class="form-control select2" name="student_id" style="width: 100%;">
                                    <option selected="selected">...</option>
                                    @foreach ($students as $student)
                                    <option value="{{$student->student->id}}"  {{ $row->student_id == $student->student->id ? 'selected' : '' }}>{{$student->student->name ?? ''}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!--<div class="col-md-4 mt-2">
                            <br />
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-student">إضافة طالب جديد</a>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">تاريخ التسجيل</label>
                                <input type="date"   value="{{ date('Y-m-d', strtotime($row->exeption_date)) }}" name="exeption_date" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">نوع الإستثناء</label>
                                <select class="form-control" name="exeption_type_id">
                                    @foreach ($exeptionTypes as $type)
                                    <option value="{{$type->id}}" {{ $row->exeption_type_id == $type->id ? 'selected' : '' }} >{{$type->exeption_name}}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">حالة الطلب</label>
                                <select class="form-control" name="exeption_status">
                                    <option value="0">لم يتم اتخاذ قرار</option>
                                    <option value="1">تمت الموافقه</option>
                                    <option value="2"> تم الرفض</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for=""> ملاحظات</label>
                                <textarea name="notes" class="form-control" >{{$row->notes}}</textarea>

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
                    <!-- Delete Modal -->
                    <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('current-groups.destroy', $row->id) }}" method="POST">
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
                    </div>
            @endforeach

        </tbody>


        </tbody>
    </table>

</div>





	<!-- Add Exception Modal -->
    <div class="modal fade dir-rtl" id="add-exception" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة استثناء</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('current-groups.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="round_id" value="{{$roundSS->id}}">
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit "></i></h3>
                    <h4> تسجيل استثناء </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رقم هوية الطالب</label>
                                <select class="form-control select2" name="student_id" style="width: 100%;">
                                    <option selected="selected">...</option>
                                    @foreach ($students as $student)
                                    <option value="{{$student->student->id}}">{{$student->student->name ?? ''}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!--<div class="col-md-4 mt-2">
                            <br />
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#new-student">إضافة طالب جديد</a>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">تاريخ التسجيل</label>
                                <input type="date" name="exeption_date" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">نوع الإستثناء</label>
                                <select class="form-control" name="exeption_type_id">
                                    @foreach ($exeptionTypes as $type)
                                    <option value="{{$type->id}}">{{$type->exeption_name}}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">حالة الطلب</label>
                                <select class="form-control" name="exeption_status">
                                    <option value="0">لم يتم اتخاذ قرار</option>
                                    <option value="1">تمت الموافقه</option>
                                    <option value="2"> تم الرفض</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for=""> ملاحظات</label>
                                <textarea name="notes" class="form-control" ></textarea>

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

