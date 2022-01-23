@extends('layout.web')

@section('title', 'الأدوار')

@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">بيانات أدوار المستخدمين</h3>
      <a href="{{ route('roles.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a>

    </div><!-- /.box-header -->
    <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                                   <thead>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                            <th> الاسم</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                        <tr>
                            <td></td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->name}}</td>
                            <td>
                                <div class="btn-group">


                                    <a href="{{ route('roles.show', $row->id) }}"><p class=" fa fa-eye"></p></a>

                                    <a href="{{ route('roles.edit', $row->id) }}"><p class=" fa fa-edit"></p></a>


                                    <a data-target="#confirm-delete" href="javascript:;" data-href="{{ route('roles.destroy', $row->id) }}"  data-placement="top" title="حذف بيانات السجل" data-toggle="modal">
                                        <p class="fa  fa-times"></p>                                    </a>



                                </div>
                            </td>
                        </tr>
                        @endforeach
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
