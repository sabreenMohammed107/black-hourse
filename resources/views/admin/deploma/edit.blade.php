@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">اضافة</h3>
        </div>





        <form action="{{route('deploma.update',$row->id)}}"  method="post" enctype="multipart/form-data">

            @method('PUT')
              @csrf


                <div class="box-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">اسم الدبلومه</label>
                            <input type="text" name="name" value="{{$row->name}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">  التكلفة</label>
                            <input type="text" name="fees" value="{{$row->fees}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for=""> ملاحظات</label>
                            <textarea name="notes" class="form-control" >{{$row->notes}}</textarea>
                        </div>
                    </div>


                </div>

            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('deploma.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



