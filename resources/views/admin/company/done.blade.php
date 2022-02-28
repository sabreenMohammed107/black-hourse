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



                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <div id="confirm">
                                            <div class="icon icon--order-success svg add_bottom_15">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" style="display: block;margin:auto">
                                                    <g fill="none" stroke="#8EC343" stroke-width="2">
                                                        <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                                        <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            @if(Session::has('flash_success'))
                                            {{-- <h2>Order completed!</h2> --}}
                                            <p style="margin: auto;text-align:center;padding:10px 0">{{session('flash_success') }}!</p>

                                        @endif
                                        @if(Session::has('flash_danger'))
                                        {{-- vv
                                        <h2>Order completed!</h2> --}}
                                        <p>{{session('flash_danger') }}!</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /container -->


                    </div>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
