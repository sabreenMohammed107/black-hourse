@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>





        <form action="{{route('room.update',$row->id)}}"  method="post" enctype="multipart/form-data">

            @method('PUT')
              @csrf

                <div class="box-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">اسم الفرع</label>
                            <select name="branch_id" class="form-control" id="">

                                @foreach($branches as $type)
                                <option value="{{$type->id}}" {{ $row->branch_id == $type->id ? 'selected' : '' }} >{{$type->name}}</option>
                                @endforeach
                              </select>                          </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> رقم القاعة</label>
                            <input type="text" name="room_no" value="{{$row->room_no}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> السعة</label>
                            <input type="number" name="capacity" value="{{$row->capacity}}" class="form-control" id="">
                        </div>
                    </div>


                </div>
            <!-- /.card-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{route('room.index')}}" class="btn btn-danger">إلغاء</a>
            </div>
        </form>
            </div>
    </div>

@endsection



