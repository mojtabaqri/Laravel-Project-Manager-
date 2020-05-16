@extends('layouts.layout')

@section('title','ثبت نام')

@section('content')



<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">

<form>

<div class="w3-row-padding" >

<div class="w3-third w3-right">

<label for="name">نام</label>

<input type="text" name="name" class="w3-input w3-border w3-round persian" id="name">

</div>


<div class="w3-third w3-right">

<label for="lastName">نام خانوادگی</label>

<input id="lastName" type="text" name="lastName" class="w3-input w3-border w3-round persian">

</div>





<div class="w3-third w3-right">

<label for="pid">کد پرسنلی</label>

<input id="pid" type="number"  class="w3-input w3-border w3-round persian">

</div>
    <div class="w3-third w3-right">

        <label for="email">ایمییل پرسنلی </label>

        <label>
            <input id="email" type="email" name="email" class="w3-input w3-border w3-round persian">
        </label>

    </div>
    <div class="w3-third w3-right">

        <label for="password"> پسورد </label>

        <label>
            <input id="password" type="password" name="password" class="w3-input w3-border w3-round persian">
        </label>

    </div>

</div>


<input type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin" id="registerbtn">



</form>


    <div class="errors w3-text-red">

    </div>








</div>


<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">
    <table class="table table-bordered data-table">

        <thead>

        <tr>

            <th>ردیف</th>

            <th>نام</th>
            <th>نام خانوادگی </th>
            <th>ایمیل  </th>
            <th>کد پرسنلی</th>

            <th width="100px">عملیات</th>

        </tr>

        </thead>

        <tbody>

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
                <h5 class="modal-title" id="userModalHeader">مدیریت کاربر </h5>
            </div>

            <div class="modal-body">

                <!-- Start User  Modal  -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="margin-bottom:0!important;">
                            <header class="card-header">

                                <h4 class="card-title mt-2" id="userTitle">نام کاربر : مهدی زمانی</h4>
                            </header>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>نام خانوادگی</label>
                                            <input type="text" class="form-control" placeholder="" id="editLname">
                                        </div> <!-- form-group end.// -->
                                        <div class="col form-group">
                                            <label>نام</label>
                                            <input type="text" class="form-control" placeholder=" " id="editName">
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row end.// -->
                                    <div class="form-group">
                                        <label>پست الکترونیک</label>
                                        <input type="email" class="form-control" placeholder="" id="editEmail">
                                        <small class="form-text text-muted">قبل از ثبت مطمئن شوید که این ایمیل توسط کاربر دیگری ثبت نشده باشد</small>
                                    </div> <!-- form-group end.// -->
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
                    "infoFiltered":   "(جستجو شده  از _MAX_  کاربر)",
                    "lengthMenu":     "نمایش _MENU_ کاربر",
                    "search": "جستجو",
                    "processing":"درحال پردازش",
                    "emptyTable":'کاربری یافت نشد',
                    "infoEmpty":"نمایش 0 کاربر از 0 کاربر ",
                    "loadingRecords":"درحال بارگزاری ",
                    "zeroRecords":"کاربری با این نام یافت نشد",
                    "info": "نمایش صفحات _PAGE_ از _PAGES_",
                    "paginate": {
                        "first":      "اولین",
                        "last":       "آخرین",
                        "next":       "بعدی",
                        "previous":   "قبلی"
                    },
                },
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'pid', name: 'pid'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('body').on('click', '.delete', function () {
                let recordId = $(this).attr("id");
                let cancle=confirm("آیا شما می خواهید این کاربر را حذف کنید؟");
                if(!cancle) return false;
                $.ajax({
                    type: "DELETE",
                    url: "/user"+'/'+recordId,
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
            });
            $('body').on('click', '.edit', function () {
                editRecordId = $(this).attr('id');
                $("#userModal").modal();
                $("#userModalHeader").text('ویرایش کاربر');
                $.get("/user" +'/' + editRecordId +'/edit', function (data) {
                    $("#editEmail").val(data.user.email);
                    $("#editLname").val(data.user.last_name);
                    $("#editName").val(data.user.name);
                    $("#userTitle").text(data.user.name+" "+data.user.last_name);
                })
            });

            $("#editBtn").click(function (e) {
                e.preventDefault();
                let data={
                    'id':editRecordId,
                    'email':$("#editEmail").val().trim(),
                    'last_name':$("#editLname").val().trim(),
                    'name':$("#editName").val().trim(),
                    "_token": "{{ csrf_token() }}",
                };

                axios.put("/user"+'/'+editRecordId,data).then(res=>{
                    alert('با موفقیت ویرایش شد');
                    $(".data-table").DataTable().draw();
                }).catch(err=>{
                 alert('ایمیل توسط کاربر دیگیری ثبت شده است ! ')
                })
            })


            $("#registerbtn").click(function (e) {
                e.preventDefault();
                axios.post('/user', {
                    'name':$("#name").val(),
                    'last_name':$("#lastName").val(),
                    'pid':$("#pid").val().trim(),
                    'email':$("#email").val(),
                    'password':$("#password").val(),
                    'role':'تعمیرکار',
                    "_token": "{{ csrf_token() }}",
                })
                    .then(function (response) {
                        $(".data-table").DataTable().draw();
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


        })
    </script>
    @endsection
