
    <div class="box-body">


        {{-- <h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal"
            data-target="#add-tab7">إضافة</a></h3> --}}
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
            data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                               <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                    <th> الفرع</th>
                                    <th> رقم القاعة</th>
                                    <th>اسم الدورة</th>
                                    <th>المدرب</th>
                                    <th> تاريخ البداية</th>
                                    <th>تاريخ النهاية</th>
                                    <th>التكلفة</th>
                                    <th>الخصم %</th>
                                    <th>ملاحظات</th>
                                    {{-- <th>الاجراءات</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($row->rounds as $index => $round)
                                <tr>
                                    <td></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$round->branch->name ?? ''}}</td>
                                    <td>{{$round->room->room_no ?? ''}}</td>
                                    <td>{{$round->course->name ?? ''}}</td>
                                      <td>{{$round->trainer->name ?? ''}} </td>
                                    <td>{{date('d-m-Y', strtotime($round->start_date))}} </td>
                                    <td>{{date('d-m-Y', strtotime($round->end_date))}}</td>
                                    <td> {{$round->fees}}</td>
                                    <td>{{$round->discount_per}}</td>
                                    <td>{!!$round->course->note ?? ''!!}</td>
                                    {{-- <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delround{{ $round->id }}"><i class="fa fa-times" title="حذف"></i></button>
                                        </div>
                                    </td> --}}
                                      <!-- Delete Modal -->

                        </div>
                                </tr>

                                @endforeach



                        <!-- Delete Modal -->
            </tbody>
        </table>

         </div>

              <!-- Add Tab-7 Modal -->
              <div class="modal modal-light" id="add-tab7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة  الصورة</h5>
                            <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="fa fa-edit text-success"></i></h3>
                            <form action="" method="POST" enctype="multipart/form-data" >
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""> الاسم </label>
                                                <input type="text"
                                                    value="{{ old('title') }}"
                                                    name="title" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">الترتيب</label>
                                                <input type="number"
                                                    value="{{old('order')}}"
                                                    name="order" class="form-control"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">الوصف </label>
                                                <textarea class="form-control " name="text">{{ old('text') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" id="newTitle" name="active"  value="1"> {{ __('نشط') }}
                                                </label>
                                              </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">اضافة  صورة</label>
                                                {{-- <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="name" id="customFile">
                                                    <label class="custom-file-label" for="customFile">إختار ملف</label>
                                                </div> --}}

                                                <div class="custom-file">
                                                    <input type="file" name="img" class="custom-file-input" id="inputGroupFile02"/>
                                                    {{-- <label class="custom-file-label" for="inputGroupFile02">إختار ملف</label> --}}
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-success">تأكيد</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
