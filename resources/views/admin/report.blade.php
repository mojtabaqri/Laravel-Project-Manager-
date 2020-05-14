@extends('layouts.layout')

@section('title','گزارش گیری')

@section('content')


 @role('normal')<div class="w3-margin w3-row  w3-stretch" dir="rtl">

<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32 w3-green">
    <h3 class="persian">انجام شده</h3>
<span class="w3-xxlarge " id="completed">
    {{$statistic['com']}}
</span>
</div>


<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32 w3-text-white w3-amber">
    <h3 class="persian">نیمه تمام</h3>
<span class="w3-xxlarge" id="incomplete">
    {{$statistic['inc']}}

</span>
</div>



<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32
 w3-text-white w3-red">
    <h3 class="persian">ارجاع</h3>
<span class="w3-xxlarge" id="refered">
    {{$statistic['ref']}}

</span>
</div>

</div> @endrole


 <div class="w3-margin w3-card w3-padding-32 w3-round w3-border w3-row-padding" dir="rtl">

     <form class="text-right">
         <div class="w3-row-padding" >

             <div class="w3-third w3-right">
                 <label>  تهیه گزارش از بخش:     </label>
                 <select class="w3-select" name="option" id="editState">
                     <option selected value="0">  انتخاب بخش   </option>
                     <option value="1">  پروژه   </option>
                     <option value="2"> تعمیرات نگه داری </option>
                 </select>

             </div>


             <div class="w3-third w3-right d-inline-flex">

                 <div>
                     <label for="fromDate">از تاریخ </label>
                     <input type="text" class="fromDate"  />
                 </div>
                <div> <label for="toDate">تا تاریخ </label>
                 <input type="text" class="toDate" />
                </div>
             </div>


         <div class="w3-third w3-left">
             <div> <label for="code">  کد پرسنلی کاربر </label>
                 <input required id='code' type="number" class="w3-input" />
             </div>
              </div>




 </div>
         <div class="row justify-content-center">
             <input id="report" value="تهیه گزارش" class="w3-btn w3-green w3-round w3-left w3-margin">
         </div>


{{--بخش گزارش --}}


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

         {{--بخش گزارش --}}





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
             <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
             <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
             <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
             <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

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
            let fromDate= $(".fromDate").pDatepicker();
           let toDate=  $(".toDate").pDatepicker();
           toDate.options={
               format:"L",
               calendar:{
                   persian: {
                       locale: 'en'
                   }
               }
           };
           fromDate.options=toDate.options;
            //    ---------------------------------------------------------------- Get Report --------------------------------------------
            $("#report").click(function (e) {
                e.preventDefault();
                if($("#code").val() == "" || $("#code").val() == null)
                {
                    alert('کد را وارد نکردید!')
                    return false;
                }
                else if($("#editState").val()!=0 )
                {
                axios.post('{{route('getReport')}}',{
                    "_token": "{{ csrf_token() }}",
                    'state':$("#editState").val(),
                    'code':$("#code").val().trim(),
                    'fromDate':$(".fromDate").val(),
                    'toDate':$(".toDate").val(),
                }).then(res=>{

                }).catch(err=>{
                    alert(err.response.data.state)
                })
                }
                else{
                    return alert('انتخاب بخش الزامیست ')
                }
            })
            //    ---------------------------------------------------------------- Get Report --------------------------------------------
        })
    </script>
@endsection



