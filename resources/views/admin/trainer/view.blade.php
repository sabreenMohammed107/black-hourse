@extends('layout.web')
@section('title', ' المدربين')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title">  بيانات المدرب - {{$row->name}} </h3>
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
                                                    aria-selected="false">الدورات </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-3-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-3" role="tab"
                                                    aria-controls="custom-tabs-one-3" aria-selected="false">الفروع
                                                     </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-4-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-4" role="tab"
                                                    aria-controls="custom-tabs-one-4" aria-selected="false">المجموعات الحالية
                                                     </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-5-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-5" role="tab"
                                                    aria-controls="custom-tabs-one-5" aria-selected="false">المجموعات السابقة
                                                     </a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
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

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.trainer.courses')
                                                <hr />


                                            </div>


                                            <div class="tab-pane fade " id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                @include('admin.trainer.branches')
                                                <hr />


                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-4" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-4-tab">
                                            @include('admin.trainer.new_rounds')
                                            <hr />


                                        </div>


                                        <div class="tab-pane fade" id="custom-tabs-one-5" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-5-tab">
                                        @include('admin.trainer.old_rounds')
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
