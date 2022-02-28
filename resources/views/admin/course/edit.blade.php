@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل - {{$row->name}}</h3>
        </div>





        <form action="{{route('course.update',$row->id)}}"  method="post" enctype="multipart/form-data">

            @method('PUT')
              @csrf
                <div class="box-body">
                    <div class="widget-body-form row">
                        <div class="col-lg-3">
                            <img src="{{ asset('uploads/courses') }}/{{ $row->image }}" style="height: 250px" width="100%" class="col-12 h-150">
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم الدورة</label>
                            <input type="text" name="name" value="{{$row->name}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> مجال الدورة</label>
                            <input type="text" name="category" value="{{$row->category}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> التكلفة</label>
                            <input type="text" name="fees" value="{{$row->fees}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ساعات الدورة</label>
                            <input type="text" name="course_hours" value="{{$row->course_hours}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> الصورة</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="customFile">
                                <label for="">{{$row->image}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> المحتوي</label>
                            <div class="custom-file">
                                <input type="file" name="pdf_file" class="custom-file-input" id="customFile">
                                <label for="">{{$row->pdf_file}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control " name="note">{{$row->note}}</textarea>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('course.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>
</div>

@endsection



