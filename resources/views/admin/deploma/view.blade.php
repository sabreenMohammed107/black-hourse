@extends('layout.web')
@section('title', ' الدورات')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title"> بيانات الدورة</h3>
                </div>







                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class=" card-info card-tabs">
                                    <div class="box-header p-0 pt-1 bg-white">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link text-dark " id="custom-tabs-one-1-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-1" role="tab" aria-controls="custom-tabs-one-1"
                                                    aria-selected="true">بيانات
                                                    اساسية</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-2" role="tab" aria-controls="custom-tabs-one-2"
                                                    aria-selected="false">الطلاب </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-3-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-3" role="tab"
                                                    aria-controls="custom-tabs-one-3" aria-selected="false">
                                                    الدورات</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
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
                                                            {{-- <button type="submit" class="btn btn-primary">حفظ</button> --}}
                                                            <a href="{{route('deploma.index')}}" class="btn btn-danger">إلغاء</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.deploma.students')
                                                <hr />


                                            </div>


                                            <div class="tab-pane fade " id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                @include('admin.deploma.courses')
                                                <hr />


                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->



        @endsection

        @section('scripts')

        @endsection
