@extends('layout.web')

@section('title', 'الأدوار')

@section('content')

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-10">
                            <div class="box box-primary">
                        <div class="box-header">
                          <h3 class="box-title">إضافه بيانات الدور</h3>
                        </div>








                {{ Form::open(array('route' => 'roles.store')) }}
                <div class="box-body">

                <div class="form-group">
                    {{ Form::label('name', 'الاسم') }}
                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'الاسم']) !!}
                </div>
                <div class="form-group ">
                    <label for="name" class="col-form-label required">الصلاحيات</label>
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($permission as $value)
                            <div class="col-sm-3">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        {{ Form::checkbox('permission[]', $value->id, false) }}
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>{{ $value->name }}</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    {!! Form::submit('حفظ ', ['class'=>'btn btn-primary']) !!}
                </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.col -->
@endsection
