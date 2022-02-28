@extends('layout.web')

@section('title', 'المدربين')

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">بيانات الرئيسية</h3>
        <a href="{{ route('trainer.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a>

    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="box-body">
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
            data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                               <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                    <th>اسم المدرب</th>
                                    <th> الموبايل</th>
                                    <th>العنوان</th>
                                    <th>البريد الاكترنى</th>
                                    <th>cv</th>
                                    <th>صورة</th>


                                    <th> ملاحظات</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $index => $row)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->mobile}}</td>
                                    <td>{{$row->address ?? ''}}</td>
                                    <td>{{$row->email ?? ''}}</td>
                                    <td> <a  id="downloadCurrent" href="{{ asset('uploads/trainers')}}/{{$row->cv_pdf ?? ''}}" download="" class="btn btn-default"><i class="fa fa-download" title="download"></i>
                                        {{$row->cv_pdf ?? ''}}</a></td>
                                    <td><img src="{{ asset('uploads/trainers') }}/{{$row->image ?? ''}}" width="80" height="80" class="img-table"/></td>

                                    <td>{!! $row->notes ?? ''!!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('trainer.show', $row->id) }}" class="btn btn-default"><i class="fa fa-eye" title="عرض"></i></a>
                                            <a href="{{ route('trainer.edit', $row->id) }}" class="btn btn-default"><i class="fa fa-edit" title="تعديل"></i></a>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#del{{ $row->id }}"><i class="fa fa-times" title="حذف"></i></button>
                                        </div>
                                    </td>
                                      <!-- Delete Modal -->
                             <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form action="{{ route('trainer.destroy', $row->id) }}"  method="POST" >
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
