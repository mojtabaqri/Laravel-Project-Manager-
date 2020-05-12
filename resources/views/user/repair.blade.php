@extends('layouts.layout')

@section('title','تعمیرات')

@section('content')



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

<form action="/repairs" method="post">
@csrf
<div class="w3-row-padding" >

<div class="w3-quarter w3-right">

<label for="section">شیفت</label>

<input type="text" name="shift" id="section" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="system_id">کد سیستم</label>

<input type="text" name="system_id" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="section_report">واحد اعلام کننده</label>

<input type="text" name="section_report" class="w3-input w3-border w3-round persian">

</div>



<div class="w3-quarter w3-right">

<label for="reporter">فرد اعلام کننده</label>

<input type="text" name="reporter" class="w3-input w3-border w3-round persian">

</div>





</div>


<div class="w3-row-padding w3-margin-top" >

<div class="w3-quarter w3-right">

<label for="date">تاریخ</label>

<input type="text" name="date" id="date" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="problem">مشکل به وجود آمده</label>

<input type="text" name="problem" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="responsible">مسئول تعمیر کننده</label>

<input type="text" name="responsible" class="w3-input w3-border w3-round persian">

</div>



<div class="w3-quarter w3-right">

<label for="delivery">‫‪نام تحویل دهنده</label>

<input type="text" name="delivery" class="w3-input w3-border w3-round persian">

</div>





</div>




<input type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



</form>










</div>



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-animate-right" style="height:200px; overflow-x: hidden; 
                overflow-x: auto; ">
@foreach($repairs as $repair)
<div class="w3-card w3-margin-top w3-padding w3-round w3-border  persian "> 
  <div class="w3-row-padding">
  <div class=" w3-col l3 w3-right" dir="rtl">
  شیفت :
  {{$repair->shift}}
  </div>  
   
  <div class=" w3-col l3 w3-right" dir="rtl">
   کد سیستم :
   {{$repair->system_id}}
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
   فرد اعلام کننده :
   {{$repair->reporter}}
   </div>

   <div class=" w3-col l3 w3-right" dir="rtl">
   واحد اعلام کننده :
   {{$repair->section_report}}
   </div>


</div>



<div class="w3-margin-top  w3-row-padding">



<div class=" w3-col l3 w3-right" dir="rtl">
  تاریخ  :
  {{$repair->date}}
  </div>  
   
  <div class=" w3-col l3 w3-right" dir="rtl">
   مشکل به وجود آمده :
   {{$repair->problem}}
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
   مسئول تعمیر کننده  : 
   {{$repair->responsible}}
   </div>

   <div class=" w3-col l3 w3-right" dir="rtl">
   نام تحویل دهنده :
   {{$repair->delivery }}
   </div>
  


</div>


</div>

@endforeach

</div>


@endsection