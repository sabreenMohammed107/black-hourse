@extends('layout.web')

@section('title', 'الأدوار')

@section('content')

<div class="box box-primary px-5">

            <div class="box-header">
                <h3 class="box-title">بيانات أدوار المستخدمين</h3>
                <a href="{{ route('roles.index') }}" class="btn btn-info btn-lg pull-right"> رجوع </a>

              </div>
            <!-- /.card-header -->
            <div class="box-body">
                <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الاسم:</strong>
                    {{ $data->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الصلاحيات:</strong>
                    @if(!empty($rolePermissions))
                    <div class="row">
                        @foreach($rolePermissions as $value)
                        <div class="col-sm-3">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    {{ Form::checkbox('permission[]', $value->id, true, ['disabled']) }}
                                    <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
                                    <span>{{ $value->name }}</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

<!-- /.row -->
@endsection
