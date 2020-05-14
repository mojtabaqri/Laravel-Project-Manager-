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
             <button id="report"  class="w3-btn w3-green w3-round w3-margin "  >
                 تهیه گزارش
                </button>
         </div>


{{--بخش گزارش --}}


    <div class="w3-margin  w3-row-padding" dir="rtl">


        <ul class="w3-ul w3-card-4" id="items">

        </ul>





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
             <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

    <script type="text/javascript">
        $("document").ready(function () {

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
                $("#items").html('');
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
                    $("#items").append(res.data)
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



