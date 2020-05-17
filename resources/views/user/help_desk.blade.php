@extends('layouts.layout')

@section('title','مدیریت پروژه ها  ')

@section('content')



    @role('normal')

    <div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

        <form action="/help-desks" method="post">
            @csrf
            <div class="w3-row-padding" >

                <div class="w3-quarter w3-right">

                    <label for="section">داخلی</label>

                    <input type="text" name="section" id="phone_number" class="w3-input w3-border w3-round persian">

                </div>







                <div class="w3-quarter w3-right">

                    <label for="problem">نوع مشکل</label>

                    <input type="text" id="problem" class="w3-input w3-border w3-round persian">

                </div>





            </div>


            <div class="w3-row-padding w3-margin-top">
                <div class="w3-col l12 w3-right">

                    <label for="des">راه حل مشکل</label>

                    <label for="solution"></label><textarea id="solution" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>

                </div>

            </div>




            <input id="regHelpBtn" type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



        </form>






 <div class=" errors text-right text-danger">

 </div>



    </div>



    @endrole


    <div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">
        <table class="table table-bordered data-table">
            <thead>
            <tr style="text-align: center">
                <th>ردیف</th>
                <th>داخلی  </th>
                <th> کد پرسنلی   </th>
                <th > وضعیت پروژه  </th>
                <th>   نوع مشکل
                </th>
                <th>
                    راه حل مشکل

                </th>
                <th width="100px">عملیات</th>

            </tr>

            </thead>

            <tbody style="text-align: center">

            </tbody>
            <div class="row">
                <div class="col-9" >
                    <label class="text-right " style="margin-left: 4.2em;">کد پرسنلی
                        <input class="form-control form-control-sm" readonly type="text" value="{{auth()->user()->pid}}"/>
                    </label>
                </div>
                <div class="col-md-3"></div>
            </div>


        </table>







    </div>


    <div  class="modal fade "  id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title text-right" id="userModalHeader"> مشاهده و ویرایش  </h5>
                </div>

                <div class="modal-body">

                    <!-- Start User  Modal  -->
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card" style="margin-bottom:0!important;">
                                <div class="card-body">
                                    <form>

                                        <div class="form-row">
                                            <div class="col form-group text-right">
                                                <label>داخلی     </label>
                                                <label for="editPhoneNumber"></label><input type="number" class="form-control" placeholder=" " id="editPhoneNumber">
                                            </input>
                                            </div> <!-- form-group end.// -->
                                        </div>

                                        <div class="form-row">
                                            <div class="col form-group text-right">
                                                <label>مشکل     </label>
                                                <label for="editProblem"></label><textarea class="form-control" placeholder=" " id="editProblem">
                                            </textarea>
                                            </div> <!-- form-group end.// -->
                                        </div>

                                        <div class="form-row">
                                            <div class="col form-group text-right">
                                                <label>راه حل   </label>
                                                <textarea  class="form-control" placeholder=" " id="editSolution">
                                            </textarea>
                                            </div> <!-- form-group end.// -->
                                        </div>


                                        @role('admin')

                                        <div class="form-row">
                                            <div class="col form-group text-right">
                                                <label>  وضعیت پروژه   </label>
                                                <select class="w3-select" name="option" id="editState">
                                                    <option value="doing"> درحال انجام </option>
                                                    <option value="Completed">تکمیل شده </option>
                                                    <option value="incompleted">نیمه تمام</option>
                                                    <option value="referred">ارجاع شده</option>
                                                </select>
                                            </div> <!-- form-group end.// -->
                                        </div>

                                        <div class="form-row">
                                            <div class="col form-group text-right">
                                                <label for="byUser">در حال انجام توسط </label><input id="byUser"  class="w3-input" type="text">
                                            </div> <!-- form-group end.// -->
                                        </div>
                                        @endrole
                                        <!-- form-group end.// -->
                                        <div class="form-group">
                                            <button type="submit" id="editBtn" class="btn btn-primary btn-block waves-effect waves-light">ثبت و ویرایش نهایی</button>
                                        </div> <!-- form-group// -->
                                    </form>
                                </div> <!-- card-body end .// -->

                            </div> <!-- card.// -->
                        </div> <!-- col.//-->

                    </div>
                    <!-- End User  Modal  -->

                    @endsection

                    @section('css')
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
                        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
                        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
                    @endsection

                    @section('js')
                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                        <script type="text/javascript">
                            $("document").ready(function () {
                                let editRecordId;
                                let table = $('.data-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    "language": {
                                        "infoFiltered":   "(جستجو شده  از _MAX_  پروژه )",
                                        "lengthMenu":     "نمایش _MENU_ پروژه ",
                                        "search": "جستجو",
                                        "processing":"درحال پردازش",
                                        "emptyTable":'پروژه ی یافت نشد',
                                        "infoEmpty":"نمایش 0 پروژه  از 0 پروژه  ",
                                        "loadingRecords":"درحال بارگزاری ",
                                        "zeroRecords":"پروژه ی با این نام یافت نشد",
                                        "info": "نمایش صفحات _PAGE_ از _PAGES_",
                                        "paginate": {
                                            "first":      "اولین",
                                            "last":       "آخرین",
                                            "next":       "بعدی",
                                            "previous":   "قبلی"
                                        },
                                    },
                                    ajax: "{{ route('help-desks.index') }}",
                                    columns: [
                                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                        {data: 'phone_number', name: 'phone_number'},
                                        {data: 'user_id', name: 'user_id'},
                                        {data: 'state', name: 'state'},
                                        {data: 'problem', name: 'problem'},
                                        {data: 'solution', name: 'solution'},
                                        {data: 'action', name: 'action', orderable: false, searchable: false},
                                    ]
                                });
                            @role('admin') $('body').on('click', '.delete', function () {
                                    let recordId = $(this).attr("id");
                                    let cancle=confirm("آیا شما می خواهید این پروژه را حذف کنید؟");
                                    if(!cancle) return false;
                                    $.ajax({
                                        type: "DELETE",
                                        url: "/help-desks"+'/'+recordId,
                                        data: {
                                            "id": recordId ,
                                            "_token": "{{ csrf_token() }}",
                                        },
                                        success: function (data) {
                                            $(".data-table").DataTable().draw();
                                            alert('با موفقیت حذف شد!')
                                        },
                                        error: function (data) {
                                            console.log('Error:', data);
                                        }
                                    });
                                }); @endrole
                                $('body').on('click', '.edit', function () {
                                    editRecordId = $(this).attr('id');
                                    $("#userModal").modal();
                                    $("#userModalHeader").text('ویرایش و مشاهده ');
                                    $.get("/help-desks" +'/' + editRecordId +'/edit', function (data) {
                                        $("#editPhoneNumber").val(data.phone_number);
                                        $("#editProblem").val(data.problem);
                                        $("#editSolution").val(data.solution);
                                    @role('admin')
                                        $("#editState").val(data.state);
                                        $("#byUser").val(data.user_id);
                                    @endrole
                                    })
                                });

                                $("#editBtn").click(function (e) {
                                    e.preventDefault();
                                    let data={
                                        'id':editRecordId,
                                        'editPhoneNumber':$("#editPhoneNumber").val(),
                                        'editProblem':$("#editProblem").val(),
                                        'editSolution':$("#editSolution").val(),
                                        @role('admin')
                                        'pid':$("#byUser").val().trim(),
                                        'state':$("#editState").val(),
                                        @endrole
                                        "_token": "{{ csrf_token() }}",
                                    };

                                    axios.put("/help-desks"+'/'+editRecordId,data).then(res=>{
                                        alert('با موفقیت ویرایش شد');
                                        $(".data-table").DataTable().draw();
                                    }).catch(err=>{
                                    })
                                })


                            @role('normal') $("#regHelpBtn").click(function (e) {
                                    e.preventDefault();
                                    axios.post("{{route('help-desks.store')}}", {
                                        'phone_number':$("#phone_number").val(),
                                        'problem':$("#problem").val(),
                                        'solution':$("#solution").val(),
                                        "_token": "{{ csrf_token() }}",
                                    })
                                        .then(function (response) {
                                            location.reload();
                                        }).catch(err=>{
                                        $.each( err.response.data.errors, function( key, value ) {
                                            $(".errors").append('<h6>'+value+'</h6>')
                                        });
                                    }).then(function () {
                                        setTimeout(function () {
                                            $(".errors").html('');
                                        },2000)
                                    })


                                });
                            @endrole


                            })
                        </script>
@endsection
