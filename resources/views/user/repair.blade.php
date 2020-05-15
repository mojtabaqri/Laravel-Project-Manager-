@extends('layouts.layout')

@section('title','تعمیرات')

@section('content')
{{--    اضافه کردن تعمیر --}}
@role('normal')
<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">
<form>
<div class="w3-row-padding" >
<div class="w3-quarter w3-right">
            <label>  شیفت کاری    </label>
            <select class="w3-select" name="option" id="shift">
                <option value="6-14">6-14  </option>
                <option value="14-22">14-22</option>
                <option value="22-6">22-6</option>
            </select>
</div>
<div class="w3-quarter w3-right">
<label for="system_id">کد سیستم</label>
<input type="text" name="system_id" id="system_id" class="w3-input w3-border w3-round persian">
</div>
<div class="w3-quarter w3-right">
<label for="section_report">واحد اعلام کننده</label>
<input type="text" id="section_report" class="w3-input w3-border w3-round persian">
</div>



<div class="w3-quarter w3-right">
<label for="reporter">فرد اعلام کننده</label>
<input type="text" id="reporter" class="w3-input w3-border w3-round persian">
</div>
</div>


<div class="w3-row-padding w3-margin-top" >

<div class="w3-quarter w3-right">

<label for="date">تاریخ</label>

<input type="text" name="date" id="date" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="problem">مشکل به وجود آمده</label>

<input type="text" id="problem" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="delivery">‫‪نام تحویل دهنده</label>

<input type="text" id="delivery" class="w3-input w3-border w3-round persian">

</div>





</div>




<input id="regRepairBtn" type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



</form>
    <div class="errors text-right p-4 text-danger"></div>
</div>
@endrole
{{--    اضافه کردن تعمیر --}}



<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">
    <table class="table table-bordered data-table">
        <thead>
        <tr style="text-align: center">
            <th>#</th>
            <th>کد سیستم </th>
            <th>واحد اعلام کننده  </th>
            <th > فرد اعلام کننده</th>
            <th > شیفت</th>
            <th> ثبت شده توسط</th>
            <th> تاریخ</th>
            <th width="100px">عملیات</th>
        </tr>

        </thead>

        <tbody style="text-align: center">

        </tbody>

    </table>







</div>
<div  class="modal fade "  id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-right" id="userModalHeader">مدیریت پروژه </h5>
            </div>

            <div class="modal-body">

                <!-- Start User  Modal  -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="margin-bottom:0!important;">
                            <header class="card-header">

                                <h4 class="card-title mt-2 text-right" id="userTitle">عنوان پروژه :   برای تست</h4>
                            </header>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="col form-group text-right">
                                            <label>عنوان  پروژه </label>
                                            <input type="text" class="form-control" placeholder="" id="editTitle">
                                        </div> <!-- form-group end.// -->

                                    </div> <!-- form-row end.// -->

                                    <div class="form-row">
                                        <div class="col form-group text-right">
                                            <label>توضیحات</label>
                                            <textarea  class="form-control" placeholder=" " id="editDescription">
                                            </textarea>
                                        </div> <!-- form-group end.// -->
                                    </div>
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
                    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.css') }}">

                @endsection
                @section('js')
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
                    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
                    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
                    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                    <script type="text/javascript">
                        $("document").ready(function () {
                            document.querySelector("#system_id").addEventListener("keypress", function (evt) {
                                if (evt.which < 48 || evt.which > 57)
                                {
                                    evt.preventDefault();
                                }
                            });
                            let date=  $("#date").pDatepicker();
                            date.options={
                                format:"L",
                                calendar:{
                                    persian: {
                                        locale: 'en'
                                    }
                                }
                            };
                            $(".dateShowHide").css('display','none');
                            $("#addDate").prop('checked',false);
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
                                ajax: "{{ route('repairs.index') }}",
                                columns: [
                                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                    {data: 'system_id', name: 'system_id'},
                                    {data: 'section_report', name: 'section_report'},
                                    {data: 'reporter', name: 'reporter'},
                                    {data: 'shift', name: 'shift'},
                                    {data: 'user_id', name: 'user_id'},
                                    {data: 'date', name: 'date'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                ]
                            });
                        @role('admin') $('body').on('click', '.delete', function () {
                                let recordId = $(this).attr("id");
                                let cancle=confirm("آیا شما می خواهید این پروژه را حذف کنید؟");
                                if(!cancle) return false;
                                $.ajax({
                                    type: "DELETE",
                                    url: "/projects"+'/'+recordId,
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
                                $("#userModalHeader").text('ویرایش پروژه ');
                                $.get("/projects" +'/' + editRecordId +'/edit', function (data) {
                                    $("#editDescription").val(data.description);
                                    $("#editTitle").val(data.title);
                                    $("#userTitle").html(data.title+"ویرایش پروژه : ");
                                @role('admin')
                                    $("#editExpireDate").val(data.day);
                                    $("#editState").val(data.state);
                                    $("#byUser").val(data.byUser);
                                @endrole
                                })
                            });

                            $("#editBtn").click(function (e) {
                                e.preventDefault();
                                let checked = $('#addDate:checked').length;
                                let expire=0;
                                if(checked>0)
                                    expire=$("#editExpireDate").val();
                                let data={
                                    'id':editRecordId,
                                    'title':$("#editTitle").val(),
                                    'description':$("#editDescription").val(),
                                    'expire_date':expire,
                                    'state':$("#editState").val(),
                                    @role('admin') 'pid':$("#byUser").val().trim(),@endrole
                                    "_token": "{{ csrf_token() }}",
                                };

                                axios.put("/projects"+'/'+editRecordId,data).then(res=>{
                                    alert('با موفقیت ویرایش شد');
                                    $(".data-table").DataTable().draw();
                                }).catch(err=>{
                                })
                            })


                        @role('normal') $("#regRepairBtn").click(function (e) {
                                e.preventDefault();
                                axios.post("{{route('repairs.store')}}", {
                                    'shift':$("#shift").val(),
                                    'system_id':$("#system_id").val(),
                                    'section_report':$("#section_report").val(),
                                    'reporter':$("#reporter").val(),
                                    'date':$("#date").val(),
                                    'problem':$("#problem").val(),
                                    'delivery':$("#delivery").val(),
                                    "_token": "{{ csrf_token() }}",
                                })
                                    .then(function (response) {
                                        alert('با موفقیت ثبت شد ')
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
