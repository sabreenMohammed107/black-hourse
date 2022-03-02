@extends('layout.web')
@section('title', ' الدورات')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title">{{ $row->name }}  - بيانات الدورة</h3>
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
                                                    aria-selected="false">المدربين المرتبطين بالدورة </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-3-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-3" role="tab"
                                                    aria-controls="custom-tabs-one-3" aria-selected="false">المجموعات
                                                    المرتبطه بالدورة</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
                                                    <form action="{{ route('course.update', $row->id) }}" method="post"
                                                        enctype="multipart/form-data">

                                                        @method('PUT')
                                                        @csrf
                                                        <div class="box-body">
                                                            <div class="widget-body-form row">
                                                                <div class="col-lg-3">
                                                                    <img src="{{ asset('uploads/courses') }}/{{ $row->image }}"
                                                                        style="height: 250px" width="100%"
                                                                        class="col-12 h-150">
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">اسم الدورة</label>
                                                                                <input type="text" name="name"
                                                                                    value="{{ $row->name }}"
                                                                                    class="form-control" id="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for=""> مجال الدورة</label>
                                                                                <input type="text" name="category"
                                                                                    value="{{ $row->category }}"
                                                                                    class="form-control" id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for=""> التكلفة</label>
                                                                                <input type="text" name="fees"
                                                                                    value="{{ $row->fees }}"
                                                                                    class="form-control" id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">ساعات الدورة</label>
                                                                                <input type="text" name="course_hours"
                                                                                    value="{{ $row->course_hours }}"
                                                                                    class="form-control" id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""> الصورة</label>
                                                                                <div class="custom-file">
                                                                                    <input type="file" name="img"
                                                                                        class="custom-file-input"
                                                                                        id="customFile">
                                                                                    <label
                                                                                        for="">{{ $row->image }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for=""> المحتوي</label>
                                                                                <div class="custom-file">
                                                                                    <input type="file" name="pdf_file"
                                                                                        class="custom-file-input"
                                                                                        id="customFile">
                                                                                    <label
                                                                                        for="">{{ $row->pdf_file }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="">ملاحظات</label>
                                                                                <textarea class="form-control "
                                                                                    name="note">{{ $row->note }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- /.card-body -->
                                                            <div class="box-footer">
                                                                <button type="submit" class="btn btn-primary">حفظ</button>
                                                                <a href="{{ route('course.index') }}"
                                                                    class="btn btn-danger">إلغاء</a>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.course.trainers')
                                                <hr />


                                            </div>


                                            <div class="tab-pane fade " id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                @include('admin.course.rounds')
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
