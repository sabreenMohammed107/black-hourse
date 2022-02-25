@extends('layout.web')

@section('title', 'حضور المجموعات الحالية')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">بيانات الرئيسية</h3>

        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <?php

                $counter = 1;

                ?>
                <?php
                $counterrrr = 1;
                ?>
                <form action="{{ route('attendance.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
                        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="false"></th>
                                <th data-field="id">#</th>
                                <th> اسم الطالب</th>
                                <th>حضور / غياب </th>
                                <th>ايجار القاعة</th>
                                <th>المبلغ المدفوع</th>
                                <th>مبلغ الشهادة</th>
                                <th>المبلغ المدفوع للشهادة </th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($studentsAttendance as $index => $student)
                                <?php
                                // $exist = 1;
                                $existInvoice = App\Models\Invoice::where('student_id', $student->studentRound->student_id)
                                    ->where('round_id', $round->id)
                                    ->where('payment_type_id', 104)
                                    ->orderBy('created_at', 'Desc')
                                    ->first();
                                    if($existInvoice){
                                        $exist = 1;
                                    }else{
                                        $exist = 2;
                                    }

                                ?>
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <input type="hidden" name="student_round_id{{ $counter }}"
                                            value="{{ $student->studentRound->id }}">
                                        <input type="hidden" name="session_id" value="{{ $student->session_id }}">

                                        {{ $student->studentRound->student->name ?? '' }}
                                    </td>
                                    <td width="15%">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="is_atend{{ $counter }}"
                                                    onchange="func({{ $counter }})" value="1"
                                                    @if ($student->is_atend == 1) checked @endif id="radioSuccess1">
                                                <label for="radioSuccess1">
                                                    حضور
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="is_atend{{ $counter }}"
                                                    onchange="func({{ $counter }})"
                                                    @if ($student->is_atend == 2 || $student->is_atend == 0) checked @endif value="2"
                                                    id="radioSuccess2">
                                                <label for="radioSuccess2">
                                                    غياب
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="room_rent_fees{{ $counter }}" readonly
                                            value="{{ $round->rent_room_fees }}" class="form-control"
                                            id="room_rent_fees{{ $counter }}"
                                            placeholder="{{ $round->rent_room_fees }}">
                                    </td>
                                    <td>
                                        <input type="text" name="room_rent_paid{{ $counter }}"
                                            value="{{ $student->room_rent_paid }}" class="form-control"
                                            id="room_rent_paid{{ $counter }}" placeholder="25">
                                    </td>
                                    <td>
                                        <input type="text" name="certificate_fees{{ $counter }}" readonly
                                            value="{{ $round->certificate_fees }}" class="form-control"
                                            id="certificate_fees" placeholder="{{ $round->certificate_fees }}">
                                    </td>
                                    <td>
                                        <input type="text" name="certificate_paid{{ $counter }}"
                                            value="{{ $student->certificate_paid }}"
                                            @if ($exist != 2) disabled @endif class="form-control" id=""
                                            placeholder="50">
                                    </td>
                                    <td>
                                        <input type="text" name="notes{{ $counter }}" value="{{ $student->notes }}"
                                            class="form-control" id="" placeholder="ملاحظات">
                                    </td>
                                </tr>
                                <?php
                                ++$counter;

                                if ($counter > count($studentsAttendance)) {
                                ?>
                            @break

                            <?php }
                                $counterrrr++;

                                ?>
                        @endforeach

                        <!-- Delete Modal -->



                    </tbody>
                </table>
                <input type="hidden" name="counter" value="{{ $counterrrr }}">


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    {{-- <button type="button" class="btn btn-danger">إلغاء</button> --}}
                </div>
            </form>
        </div>
        <!-- /.card-body -->
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
{{-- </div> --}}
<!-- /.row -->


@endsection
@section('scripts')

<script>
    function func(index) {
        $piad = $('#room_rent_fees' + index).val();
        if ($('input[name=is_atend' + index + ']:checked').val() == 1) {
            $('#room_rent_paid' + index).val($piad);
        } else {
            $('#room_rent_paid' + index).val(0);

        }
    }
    $(function() {

    });
</script>
@endsection
