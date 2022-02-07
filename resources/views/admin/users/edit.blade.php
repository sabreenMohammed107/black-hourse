@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary px-5">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>







{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}  <div class="box-body">

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>إسم المستخدم:</strong>
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>البريد الإلكترونى:</strong>
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>العنوان:</strong>
            {!! Form::text('address', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>كلمه السر:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>تأكيد كلمه السر :</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','value'=> '{{$user->password}}')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>الأدوار:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}


            {{-- {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!} --}}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>الفروع:</strong>
            {!! Form::select('branches[]', $branches,$userBranch, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('users.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
</div>
{!! Form::close() !!}
    </div>
</div>
{{-- </div> --}}

@endsection
