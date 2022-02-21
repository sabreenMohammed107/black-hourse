@extends('layout.web')
@section('title', ' الشهادات')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">
            <div class="box box-primary px-5">
                <div class="box-header">
                    <h3 class="box-title"> بيانات الشهادات</h3>
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
                                                    aria-selected="true">شهادات لم يتم حجزها</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-2" role="tab" aria-controls="custom-tabs-one-2"
                                                    aria-selected="false">شهادات جاهزة للطباعه </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link text-dark active" id="custom-tabs-one-3-tab"
                                                    data-toggle="pill" href="#custom-tabs-one-3" role="tab"
                                                    aria-controls="custom-tabs-one-3" aria-selected="false">
                                                    شهادات تمت طباعتها</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade in active" id="custom-tabs-one-1" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-1-tab">
                                                <div class="card card-primary">
                                                    <!-- form start -->
                                                    <div class="box-body">
                                                        <table id="table" data-toggle="table" data-pagination="true"
                                                            data-search="true" data-resizable="true" data-cookie="true"
                                                            data-show-export="true" data-locale="ar-SA"
                                                            style="direction: rtl">
                                                            <thead>
                                                                <tr>
                                                                    <th data-field="state" data-checkbox="false"></th>
                                                                    <th data-field="id">#</th>
                                                                    <th>اسم الطالب</th>
                                                                    <th> الفرع</th>
                                                                    <th>اسم الكورس</th>
                                                                    <th>رقم المجموعه </th>
                                                                    <th> المبلغ المدفوع</th>
                                                                    <th>تاريخ الدفع</th>
                                                                    <th>رقم الفاتورة </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($notBooking as $index => $row)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $row->student->name ?? '' }}</td>
                                                                        <td>{{ $row->round->branch->name ?? '' }}</td>
                                                                        <td>{{ $row->round->course->name ?? '' }}</td>
                                                                        <td>{{ $row->round->round_no ?? '' }}</td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                        <td>test</td>

                                                                    </tr>
                                                                @endforeach

                                                                <!-- Delete Modal -->



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.certificates.booking')
                                                <hr />


                                            </div>


                                            <div class="tab-pane fade " id="custom-tabs-one-3" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-3-tab">
                                                @include('admin.certificates.printing')
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
            <script>
                $(function() {
                    //button select all or cancel
                    $('#selectAll').click(function(e) {
                        var table = $(e.target).closest('table');
                        $('td input:checkbox', table).prop('checked', this.checked);
                    });
                    $('#selectAll2').click(function(e) {
                        var table = $(e.target).closest('table');
                        $('td input:checkbox', table).prop('checked', this.checked);
                    });
                });

                function cerificationfunc(index) {
                    $('#cerification').val(index);
                    $('#myform').submit();

                }
            </script>
        @endsection
