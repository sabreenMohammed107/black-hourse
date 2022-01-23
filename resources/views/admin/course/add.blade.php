@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('course.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم الدورة</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> مجال الدورة</label>
                            <input type="text" name="category" value="{{old('category')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> التكلفة</label>
                            <input type="text" name="fees" value="{{old('fees')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ساعات الدورة</label>
                            <input type="text" name="course_hours" value="{{old('course_hours')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> الصورة</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> المحتوي</label>
                            <div class="custom-file">
                                <input type="file" name="pdf_file" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control " name="note">{{ old('note') }}</textarea>
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

@endsection



