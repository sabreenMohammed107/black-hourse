<div class="box-body">
    <form action="{{route('certificates.store')}}" id="myform"  method="post" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">طباعة الكل </button>

    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-resizable="true"
        data-cookie="true" data-show-export="true" data-locale="ar-SA" style="direction: rtl">
        <thead>
            <tr>
                {{-- <th data-field="state" data-checkbox="false"></th> --}}
                <th class="active">
                    <input type="checkbox" class="select-all checkbox" id="selectAll" name="" />
                </th>
                <th data-field="id">#</th>
                <th>اسم الطالب</th>
                <th> الفرع</th>
                <th>اسم الكورس</th>
                <th>رقم المجموعه </th>
                <th> المبلغ المدفوع</th>
                <th>تاريخ الدفع</th>
                <th>رقم الفاتورة </th>
                <th>تم الطبع </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($Booking as $index => $row)
                <tr>
                    {{-- <td></td> --}}

                    <td class="active">
                        <input type="checkbox" class="select-item checkbox" name="cerificate[]"
                            value="{{ $row->id }}" />
                    </td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->student->name ?? '' }}</td>
                    <td>{{ $row->round->branch->name ?? '' }}</td>
                    <td>{{ $row->round->course->name ?? '' }}</td>
                    <td>{{ $row->round->round_no ?? '' }}</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test

                    </td>
                    <td><button type="button" class="btn btn-default"data-toggle="modal" data-target="#confirm2{{$row->id}}"><i class="fa fa-book" title="تم طبع"></i></button></td>
                </tr>

                <!-- Confirmation2 Modal -->
		<div class="modal fade dir-rtl" id="confirm2{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <input type="hidden" name="cerification" id="cerification" value="">

					<div class="modal-body text-center">
						<h3><i class="fa fa-fire"></i></h3>
						<h4 class=""> هل تريد تاكيد طباعة شهادة {{ $row->student->name ?? '' }} ؟</h4>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
						<input type="button" onclick="cerificationfunc({{ $row->id }})"  value="تأكيد" class="btn btn-success">

                    </button>
					</div>
                    </form>
				</div>
			</div>
		</div>

            @endforeach

            <!-- Delete Modal -->



        </tbody>
    </table>

     <!-- /.card-body -->
     <div class="box-footer">
        {{-- <a href="{{route('company.index')}}" class="btn btn-danger">إلغاء</a> --}}
    </div>
</form>
</div>

