@extends('layout.web')

@section('title', 'الشركات')

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">بيانات الرئيسية</h3>
        <a href="{{ route('company.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a>

    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="box-body">
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
            data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                               <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                    <th>اسم الشركة</th>
                                    <th>لوجو الشركة</th>
                                    <th>هواتف الشركة</th>
                                    <th>عنوان الشركة</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $index => $row)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>

                                    <td>
                                        <div class="btn-group">
                                             <a href="{{ route('potential-clients.show', $row->id) }}"  class="btn btn-default">{{$row->name}}</a>
                                        </div>
                                    </td>
                                    <td><img src="{{ asset('uploads/companies') }}/{{ $row->logo }}" width="80" height="80" class="img-table"/></td>
                                    <td>{{$row->phone}}</td>
                                    <td>{!! $row->address !!}</td>


                                </tr>

                                @endforeach

                        <!-- Delete Modal -->



                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
@endsection
