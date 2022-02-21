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
                <th>الغاء الطبع </th>


            </tr>
        </thead>
        <tbody>
            @foreach ($printing as $index => $row)
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

                </td>
                <td><button type="button" class="btn btn-default"data-toggle="modal" data-target="#confirm22{{$row->id}}"><i class="fa fa-book" title="تم طبع"></i></button></td>
            </tr>

            <!-- Confirmation2 Modal -->
    <div class="modal fade dir-rtl" id="confirm22{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تأكيد</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('updatingCerificate')}}"  method="post" >

                      @csrf
                      <input type="hidden" value="{{$row->id}}" name="certificate_id">
                <div class="modal-body text-center">
                    <h3><i class="fa fa-fire"></i></h3>
                    <h4 class="">هل تريد تاكيد الغاء طباعة شهادة {{ $row->student->name ?? '' }} ؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <input type="submit"   value="تأكيد" class="btn btn-success">

                </button>
                </div>
                </form>
            </div>
        </div>
    </div>
                </tr>
            @endforeach

            <!-- Delete Modal -->



        </tbody>
    </table>
</div>
</div>
</div>
