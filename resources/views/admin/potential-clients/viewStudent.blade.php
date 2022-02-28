@extends('layout.web')

@section('title', 'الشركات')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="card-title">
                <i class="fa fa-edit"></i>
                عرض بيانات الطلاب
            </h3>

        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">اسم الطالب</label>
                        <input type="text" value="{{ $row->name }}" class="form-control" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">رقم موبايل</label>
                        <input type="tel" value="{{ $row->mobile }}" class="form-control" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">البريد الالكتروني</label>
                        <input type="email" value="{{ $row->email }}" class="form-control" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">اسم الشركة</label>
                        <input type="email" value="{{ $row->company->name ?? '' }}" class="form-control" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">الفرع</label>
                        <select name="branch_id" class="form-control" id="">

                            @foreach ($row->branches as $index => $branch)
                            <option value="{{$branch->id}}">{{ $branch->name }}</option>

                        @endforeach
                            </select>


                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">وعاء مبيعات</label>
                        <input type="email" value="{{ $row->funnel->sale_funnel ?? '' }}" class="form-control" id="">

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">السن </label>
                        <input type="number" value="{{ $row->age }}" class="form-control" id="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">الدورات المهتم بها </label>
                        <select name="branch_id" class="form-control" id="">

                        @foreach ($row->rounds as $index => $round)
                        <option value="{{$round->id}}">{{ $round->course->name ?? '' }}</option>

                    @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">تاريخ التسجيل </label>
                        <input type="date" value="@if ($row->register_date){{ date('Y-m-d', strtotime($row->register_date)) }}@endif" class="form-control" id="">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">تاريخ اخر تواصل </label>
                        <input type="date" value="@if ($row->follow){{ date('Y-m-d', strtotime($row->follow->followup_date)) }}@endif" class="form-control" id="">
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="">نص التواصل </label>
                        <input type="text" value="{{ $row->follow->text ?? '' }}" class="form-control" id="">
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="card-header">
                    <h3 class="box-title">عرض تفاصيل التواصل</h3>
                   <a data-toggle="modal" data-target="#add-follow" class="btn btn-info btn-lg pull-right">إضافة</a>
                </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
                    data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="false"></th>
                            <th data-field="id">#</th>
                            <th>الدورات المهتم</th>
                            <th>تاريخ التواصل </th>
                            <th>الموظف</th>
                            <th>نص التواصل</th>
                            <th>نوع التواصل</th>
                            <th>ملاحظات</th>
                            <th>الاجراءات</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($callcenter as $index => $call)
                            <tr>
                                <td></td>
                                <td>{{ $index + 1 }}</td>

                                <td> @foreach ($call->student->rounds as $index => $round)
                                    <label for="">{{ $round->course->name ?? '' }} - </label>
                                @endforeach</td>
                                <td>{{ date('d-m-Y', strtotime($call->followup_date)) }}</td>
                                <td>{{ $call->user->name ?? '' }}</td>
                                <td>{{ $call->text }}</td>
                                <td>{{ $call->type->followup_name ?? '' }}</td>
                                <td>{{ $call->notes }}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <a href="{{ route('current-groups.show', $row->id) }}" class="btn btn-default"><i
                                                class="fa fa-eye" title="عرض"></i></a> --}}
                                        <a data-toggle="modal" data-target="#edit-followup{{ $call->id }}"
                                            class="btn btn-default"><i class="fa fa-edit" title="تعديل"></i></a>
                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#del{{ $call->id }}"><i class="fa fa-times" title="حذف"></i></button>
                                    </div>
                                </td>


                            </tr>
                            <!-- Edit Modal -->
                              <!-- Delete Modal -->
                    <div class="modal modal-danger" id="del{{ $call->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('fullowup.destroy', $call->id) }}" method="POST">
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
                       <!-- Add Follow up Modal -->
<div class="modal fade dir-rtl" id="edit-followup{{ $call->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة متابعة</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('follow_update') }}" method="post">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $call->id }}">

                <input type="hidden" name="student_id" value="{{$row->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4> تسجيل متابعة </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">تاريخ التواصل</label>
                            <input type="date"   value="{{ date('Y-m-d', strtotime($call->followup_date)) }}" name="followup_date" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">نوع التواصل</label>
                            <select class="form-control" name="followup_type_id">
                                @foreach ($fullowupTypes as $type)
                                    <option value="{{ $type->id }}"  {{ $call->followup_type_id == $type->id ? 'selected' : '' }}>{{ $type->followup_name }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">نص التواصل</label>
                            <textarea name="text"  class="form-control" id="">{{ $call->text }} </textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea name="notes" class="form-control" id="">{{ $call->notes }} </textarea>
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
                        @endforeach

                        <!-- Delete Modal -->



                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
<!-- Add Follow up Modal -->
<div class="modal fade dir-rtl" id="add-follow" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة متابعة</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('follow_save') }}" method="post">
                @csrf
                <input type="hidden" name="student_id" value="{{$row->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit "></i></h3>
                <h4> تسجيل متابعة </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">تاريخ التواصل</label>
                            <input type="date" name="followup_date" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">نوع التواصل</label>
                            <select class="form-control" name="followup_type_id">
                                @foreach ($fullowupTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->followup_name }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">نص التواصل</label>
                            <textarea name="text" class="form-control" id=""> </textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea name="notes" class="form-control" id=""> </textarea>
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


@endsection
