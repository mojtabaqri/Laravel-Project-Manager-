@extends('layouts.layout')

@section('title','مدیریت پروژه ها  ')

@section('content')



@role('normal')
<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">

    <form class="text-right">
        <div class="w3-row-padding" >

            <div class="w3-half w3-right">

                <label for="title">عنوان</label>

                <input id="regProjectTitle" type="text" name="title" class="w3-input w3-border w3-round persian">

            </div>


            <div class="w3-half w3-right">

                <label for="date">مهلت</label>

                <input id="regProjectDate" type="number" name="date" class="w3-input w3-border w3-round persian">

            </div>








        </div>


        <div class="w3-row-padding w3-margin-top">
            <div class="w3-col l12 w3-right">

                <label for="description">توضیحات</label>

                <textarea name="description" id="regProjectDescription" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>

            </div>

        </div>


        <input id="registerProjectBtn" type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



    </form>


    <div class="errors w3-text-red">

    </div>








</div>@endrole


<div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">
    <table class="table table-bordered data-table">

        <thead>

        <tr style="text-align: center">

            <th>ردیف</th>
            <th>کد پروژه </th>
            <th>عنوان پروژه </th>
            <th >زمان تحویل پروژه  </th>
            <th> وضعیت پروژه</th>
            <th>  توسط </th>
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

                                    @role('admin')
                                    <div class="form-row">
                                        <div class="col form-group text-right">
                                            <input id="addDate" class="w3-check" type="checkbox" onchange="date(this);">
                                            <label>میخاهم مدت زمان تحویل را اضافه کنم
                                            </label>
                                        </div> <!-- form-group end.// -->
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group text-right  ">
                                             <div class="dateShowHide">
                                            <label>اضافه کردن  زمان مهلت تحویل ( به تعداد روز )  </label>
                                            <input type="number"  min="0" class="form-control " placeholder="تعداد روز اضافی را وارد کنید" id="editExpireDate" />
                                             </div>
                                        </div> <!-- form-group end.// -->

                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group text-right">
                                            <label>  وضعیت پروژه   </label>
                                            <select class="w3-select" name="option" id="editState">
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
        function date(elem)
        {
            if (elem.checked)
                $(".dateShowHide").show(1000);
            else
                $(".dateShowHide").hide(1000);



        }
        $("document").ready(function () {
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
                ajax: "{{ route('projects.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'expire_date', name: 'expire_date'},
                    {data: 'state', name: 'state'},
                    {data: 'user_id', name: 'user_id'},
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


           @role('normal') $("#registerProjectBtn").click(function (e) {
                e.preventDefault();
                axios.post('/projects', {
                    'title':$("#regProjectTitle").val(),
                    'description':$("#regProjectDescription").val(),
                    'expireDate':$("#regProjectDate").val(),
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
