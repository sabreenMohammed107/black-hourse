@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('trainer.update',$row->id)}}"  method="post" enctype="multipart/form-data">

            @method('PUT')
              @csrf
                <div class="box-body">
                    <div class="widget-body-form row">
                        <div class="col-lg-3">
                            <img src="{{ asset('uploads/trainers') }}/{{ $row->image }}" style="height: 250px" width="100%" class="col-12 h-150">
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم المدرب</label>
                            <input type="text" name="name" value="{{$row->name}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">  الموبايل</label>
                            <input type="text" name="mobile" value="{{$row->mobile}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> العنوان</label>
                            <input type="text" name="address" value="{{$row->address}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">البريد الالكتروني</label>
                            <input type="text" name="email" value="{{$row->email}}" class="form-control" id="">
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
                            <label for=""> cv</label>
                            <div class="custom-file">
                                <input type="file" name="cv_pdf" class="custom-file-input" id="customFile">
                                <label for="">{{$row->cv_pdf}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control " name="notes">{{$row->notes}}</textarea>
                        </div>
                    </div>
                </div>
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
</div>

@endsection



