<div class="box-body">

    <h3 class="card-title float-sm-left mb-2"><a data-toggle="modal" data-target="#add-followup"
            class="btn btn-success">إضافة</a>
    </h3>

    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="false"></th>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>تاريخ التواصل </th>
                <th> الموظف </th>
                <th>نص التواصل </th>
                <th>نوع التواصل </th>
                <th> ملاحظات </th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($followups as $index => $row)
                <tr>
                    <td></td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->student->name ?? '' }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->followup_date)) }} </td>
                    <td>{{ $row->user->name ?? '' }}</td>
                    <td>{{ $row->notes }} </td>
                    <td>{{ $row->type->followup_name ?? '' }}</td>
                    <td>{{ $row->notes }} </td>
                    <td>
                        <div class="btn-group">
                            {{-- <a href="{{ route('current-groups.show', $row->id) }}" class="btn btn-default"><i
                                    class="fa fa-eye" title="عرض"></i></a> --}}
                            <a data-toggle="modal" data-target="#edit-followup{{ $row->id }}"
                                class="btn btn-default"><i class="fa fa-edit" title="تعديل"></i></a>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#del{{ $row->id }}"><i class="fa fa-times" title="حذف"></i></button>
                        </div>
                    </td>
                    <!-- Add Exception Modal -->
                    <div class="modal fade dir-rtl" id="edit-followup{{ $row->id }}" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel"> تعديل متابعة </h5>
                                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('fullowup.update', $row->id) }}" method="post">

                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="modal-body text-center">
                                        <h3><i class="fa fa-edit "></i></h3>
                                        <h4> تسجيل متابعة </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>رقم هوية الطالب</label>
                                                    <select class="form-control select2" name="student_id"
                                                        style="width: 100%;">
                                                        <option selected="selected">...</option>
                                                        @foreach ($students as $student)
                                                            <option value="{{ $student->student->id }}"
                                                                {{ $row->student_id == $student->student->id ? 'selected' : '' }}>
                                                                {{ $student->student->name ?? '' }}</option>

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
                                                    <label for="">تاريخ التواصل</label>
                                                    <input type="date"
                                                        value="{{ date('Y-m-d', strtotime($row->followup_date)) }}"
                                                        name="followup_date" class="form-control" id="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">نص التواصل</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $row->text }}" id="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">نوع التواصل</label>
                                                    <select class="form-control" name="followup_type_id">
                                                        @foreach ($fullowupTypes as $type)
                                                            <option value="{{ $type->id }}"
                                                                {{ $row->followup_type_id == $type->id ? 'selected' : '' }}>
                                                                {{ $type->followup_name }}</option>

                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for=""> ملاحظات</label>
                                                    <textarea name="notes"
                                                        class="form-control">{{ $row->notes }}</textarea>

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
                    <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('fullowup.destroy', $row->id) }}" method="POST">
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
            @endforeach

        </tbody>


        </tbody>
    </table>

</div>





<!-- Add fullowup Modal -->
<div class="modal fade dir-rtl" id="add-followup" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">إضافة تواصل</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('fullowup.store') }}" method="post">
                @csrf
                <input type="hidden" name="round_id" value="{{ $roundSS->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit "></i></h3>
                    <h4> تسجيل التواصل </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رقم هوية الطالب</label>
                                <select class="form-control select2" name="student_id" style="width: 100%;">
                                    <option selected="selected">...</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->student->id }}">
                                            {{ $student->student->name ?? '' }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
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
                                <input type="text" name="text" class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for=""> ملاحظات</label>
                                <textarea name="notes" class="form-control"></textarea>

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
