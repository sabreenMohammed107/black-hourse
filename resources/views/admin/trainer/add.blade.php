@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('trainer.store')}}"  method="post" enctype="multipart/form-data">
            @csrf

                <div class="box-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم المدرب</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">  الموبايل</label>
                            <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> العنوان</label>
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">البريد الالكتروني</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" id="">
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
                            <label for=""> cv</label>
                            <div class="custom-file">
                                <input type="file" name="cv_pdf" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control " name="notes">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('trainer.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



