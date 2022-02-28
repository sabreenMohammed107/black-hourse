@include('layout.head')
<body class="hold-transition login-page dark-mode  dir-rtl">
    <div class="login-box">
  <!-- /.login-logo -->
  <div class="box box-outline box-primary">
    <div class="box-header text-center">
      <a href="" class="h4"><img src="{{ asset('adminassets/dist/img/zz.png')}}" style="width:100px" /> <b> بلاك هورس</b></a>
    </div>
    <div class="box-body">
      <p class="login-box-msg">تسجيل دخول إلى لوحة تحكم بلاك هورس </p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group mb-3">
            <input id="email" placeholder="البريد الإلكترونى" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="form-group-append">
            <div class="form-group-text">
              <span class="fa fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
            <input id="password" placeholder="كلمه المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <div class="form-group-append">
            <div class="form-group-text">
              <span class="fa fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" class="btn btn-block btn-primary">
                تسجيل دخول
            </button>

          </div>
      </form>


      <!-- /.social-auth-links -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.login-box -->


@include('layout.footerScripts')

