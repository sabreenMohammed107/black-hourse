
    <div class="box-body">


        <h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal"
            data-target="#add-tab7">إضافة</a></h3>
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
            data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                               <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                    <th>اسم المدرب</th>
                                    <th> الموبايل</th>
                                    <th>العنوان</th>
                                    <th>البريد الاكترنى</th>
                                    <th>cv</th>
                                    <th>صورة</th>


                                    <th> ملاحظات</th>
                                    <th>الاجراءات</th>
                                </tr>
            </thead>
            <tbody>
                @foreach ($row->trainer as $index => $trainer)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$trainer->name}}</td>
                                    <td>{{$trainer->mobile}}</td>
                                    <td>{{$trainer->address ?? ''}}</td>
                                    <td>{{$trainer->email ?? ''}}</td>
                                    <td> <a  id="downloadCurrent" href="{{ asset('uploads/trainers')}}/{{$trainer->cv_pdf ?? ''}}" download="" class="btn btn-default"><i class="fa fa-download" title="download"></i>
                                        {{$row->cv_pdf ?? ''}}</a></td>
                                    <td><img src="{{ asset('uploads/trainers') }}/{{$trainer->image ?? ''}}" width="80" height="80" class="img-table"/></td>

                                    <td>{!! $trainer->notes ?? ''!!}</td>
                                    <td>
                                        <div class="btn-group">
                                             <button type="button" class="btn btn-default" data-toggle="modal" data-target="#deltrainer{{ $trainer->id }}"><i class="fa fa-times" title="حذف"></i></button>
                                        </div>
                                    </td>
                                      <!-- Delete Modal -->
                             <div class="modal modal-danger" id="deltrainer{{ $trainer->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form action="{{ route('course-trainers.destroy', $trainer->id) }}"  method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                                            </button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <p><i class="fa fa-fire "></i></p>
                                            <p>حذف جميع البيانات ؟</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline pull-left">موافق </button>

                                            <button type="button" class="btn btn-outline "
                                                data-dismiss="modal">الغاء</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                                </tr>

                                @endforeach

                        <!-- Delete Modal -->

            </tbody>


        </table>

         </div>

            	<!-- Add Trainer Modal -->
		<div class="modal fade dir-rtl" id="add-tab7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-light">
						<h5 class="modal-title" id="exampleModalLabel">إضافة مدرب</h5>
						<button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
                    <form action="{{ route('course-trainers.store') }}"  method="POST" >
                        @csrf
					<div class="modal-body text-center">
						<h3><i class="fa fa-edit "></i></h3>
						<h4>تأكيد إضافة مدرب للدورة</h4>
                        <input type="hidden" name="course_id" value="{{$courseView->id}}" id="">
						<div class="box-body">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">اسم المدرب</label>
									<select name="trainer_id" class="custom-select form-control">
										<option>اختار المدرب ...</option>
                                        @foreach ($trainersAll as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach

									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
						<button type="submit" class="btn btn-success">تأكيد</button>
					</div>
                </form>
				</div>
			</div>
		</div>
