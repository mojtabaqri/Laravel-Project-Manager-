@extends('layouts.layout')

@section('title','ثبت نام')

@section('content')


@role('admin')
<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

<form>
<div class="w3-row-padding" >
<div class="w3-half w3-right">
<label for="title">عنوان</label>
<input type="text" id="title" class="w3-input w3-border w3-round persian">
</div>
<div class="w3-half w3-right">
<label for="pid">کد پرسنلی</label>
<input type="text" id="pid" class="w3-input w3-border w3-round persian">
</div>
</div>
<div class="w3-row-padding w3-margin-top">
<div class="w3-col l12 w3-right">
<label for="des">توضیحات</label>
<textarea  id="des" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>
</div>
</div>
<input id="regBtn" type="submit" value="ارسال" class="w3-btn w3-orange w3-text-white w3-round w3-left w3-margin">
</form>
 <div class="errors text-right text-danger"></div>
</div>

@endrole

<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">
    <table class="table table-bordered data-table">

        <thead>

        <tr>

            <th>ردیف</th>

            <th>عنوان</th>
            <th> تاریخ </th>
            <th> از </th>
            <th width="100px">متن پیام</th>

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
                <h5 class="modal-title" id="userModalHeader"> پیغام  </h5>
            </div>

            <div class="modal-body">

                <!-- Start User  Modal  -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" style="margin-bottom:0!important;">
                            <header class="card-header">

                                <h4 class="card-title mt-2" id="userTitle"></h4>
                            </header>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col form-group text-right">
                                        <label>توضیحات</label>
                                        <textarea   class="form-control" placeholder=" " id="messageText">
                                            </textarea>
                                    </div> <!-- form-group end.// -->
                                </div>

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
                    "infoFiltered":   "(جستجو شده  از _MAX_  پیام)",
                    "lengthMenu":     "نمایش _MENU_ پیام",
                    "search": "جستجو",
                    "processing":"درحال پردازش",
                    "emptyTable":'پیامی یافت نشد',
                    "infoEmpty":"نمایش 0 پیام از 0 پیام ",
                    "loadingRecords":"درحال بارگزاری ",
                    "zeroRecords":"پیامی با این نام یافت نشد",
                    "info": "نمایش صفحات _PAGE_ از _PAGES_",
                    "paginate": {
                        "first":      "اولین",
                        "last":       "آخرین",
                        "next":       "بعدی",
                        "previous":   "قبلی"
                    },
                },
                ajax: "{{ route('messages.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'date', name: 'date'},
                    {data: 'from', name: 'from'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('body').on('click', '.edit', function () {
                editRecordId = $(this).attr('id');
                $("#userModal").modal();
                $.get("/messages" +'/' + editRecordId +'/edit', function (data) {
                    $("#messageText").val(data.message);
                    $("#userModalHeader").html("پیغام از طرف "+data.fromUser);
                })
            });

          @role('admin')   $("#regBtn").click(function (e) {
                e.preventDefault();
                axios.post('/messages', {
                    'title':$("#title ").val(),
                    'pid':$("#pid").val().trim(),
                    'des':$("#des").val().trim(),
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
          @endrole

        })
    </script>
@endsection

