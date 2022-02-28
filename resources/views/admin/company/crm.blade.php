<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Form</title>


    <link rel="stylesheet" href="{{ asset('adminassets/new/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminassets/new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/new/dist/css/adminlte.css') }}">
</head>

<body class="form-body">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
                <div class="AppForm shadow-lg">
                    <div class="row">


                        <div class="col-md-7 d-flex justify-content-center align-items-center" style="width: 100%">

                                <div class="AppFormLeft" style="width: 80% !important">
                                    <form method="POST" id="myf" action="{{url('/crm')}}" >
                                        @csrf
                                        <input type="hidden" name="company_id" value="{{$row->id}}">
                                    <div class="row" style="direction:rtl;text-align:right">
                                        <div class="col-md-4">
                                            <img src="{{ asset('uploads/companies') }}/{{ $row->logo }}"
                                                style="height:90px;padding-top:10px;width:100%" />
                                        </div>
                                        <div class="col-md-8">
                                            <h1>كورسات {{ $row->name }}</h1>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative mb-2">
                                        <input type="text" name="name"
                                            class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                            placeholder="الإسم">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group position-relative mb-2">
                                        <input type="tel" name="mobile"
                                            class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                            placeholder="التليفون">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="form-group position-relative mb-2">
                                        <input type="tel" name="mobile2"
                                            class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                            placeholder="الواتساب">
                                        <i class="fa fa-comments"></i>
                                    </div>

                                    <h6>الكورسات</h6>
                                    <div class="form-group position-relative mb-2 Scroll"
                                        style="width: 100% !important">
                                        @foreach ($courses as $index => $course)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="course_id[]"
                                                    id="exampleRadios{{ $index + 1 }}" value="{{ $course->id }}">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    {{ $course->name }}
                                                </label>
                                            </div>
                                        @endforeach


                                    </div>

                                    <h6>الفروع</h6>
                                    <div class="form-group position-relative mb-2 Scroll">
                                        @foreach ($branches as $index => $branch)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="branch_id[]"
                                                    id="exampleRadios{{ $index + 1 }}" value="{{ $branch->id }}">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    {{ $branch->name }}
                                                </label>
                                            </div>
                                        @endforeach


                                    </div>

                                    <div class="form-group position-relative mb-2">
                                        <input type="text"
                                            class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                            placeholder="السن" name="age">
                                        <i class="fa fa-calendar"></i>
                                    </div>

                                    <div class="form-group position-relative mb-2">
                                        <textarea name="note"
                                            class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                            placeholder="ملاحظات"></textarea>
                                        <i class="fa fa-user-plus"></i>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-success btn-block shadow border-0 py-2 text-uppercase mb-4 mt-4" >
                                        إرسال
                                    </button>

                                </form>

                                </div>

                        </div>

                        <div class="col-md-5">
                            <div class="AppFormRight position-relative d-flex justify-content-center flex-column align-items-center text-center p-5 text-white"
                                style="background-image: url({{ asset('adminassets/dist/img/bg.jpg') }})">
                                <h2 class="position-relative px-4 pb-3 mb-4">Welcome</h2>
                                <p>Lorem ipsuing elit. Molomos totam est voluptatum i omos totam est voluptatum i ure
                                    sit consectetur ill</p>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
