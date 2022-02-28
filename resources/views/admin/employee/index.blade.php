@extends('layout.web')

@section('title', 'الموظفين')

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">بيانات الرئيسية</h3>
        <a href="{{ route('employee.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a>

    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="box-body">
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
            data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                               <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                    <th>اسم الموظف</th>
                                    <th>  الموبايل</th>
                                    <th>تاريخ التعيين </th>
                                    <th> الفرع </th>
                                    <th>الوظيفة</th>
                                    <th> الراتب</th>

                                    <!--<th>ملاحظات</th>-->
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $index => $row)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$row->emp_name}}</td>
                                    <td>{{$row->mobile}}</td>
                                    <td>{{date('d-m-Y', strtotime($row->hire_date))}}</td>
                                    <td>{{$row->branch->name ?? ''}}</td>
                                    <td>{{$row->job}}</td>
                                    <td>{{$row->salary}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('employee.edit', $row->id) }}" class="btn btn-default"><i class="fa fa-edit" title="تعديل"></i></a>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#del{{ $row->id }}"><i class="fa fa-times" title="حذف"></i></button>
                                        </div>
                                    </td>
                                      <!-- Delete Modal -->
                             <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form action="{{ route('employee.destroy', $row->id) }}"  method="POST" >
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
                                </tr>

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
@endsection
