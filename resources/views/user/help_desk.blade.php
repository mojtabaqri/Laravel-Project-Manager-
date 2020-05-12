@extends('layouts.layout')

@section('title','تعمیرات')

@section('content')



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

<form action="/help-desks" method="post">
@csrf
<div class="w3-row-padding" >

<div class="w3-quarter w3-right">

<label for="section">داخلی</label>

<input type="text" name="section" id="section" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">

<label for="pid">کد پرسنلی</label>

<input type="text" name="pid" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-quarter w3-right">
<label for="">وضعیت پروژه</label>
<select class="w3-select w3-white w3-border w3-round" name="status">
  <option value="" disabled selected>انتخاب کنید</option>
  <option value="">تمام شده</option>
  <option value="2">نیمه تمام</option>
  <option value="3">ارجاع</option>
</select> 

</div>



<div class="w3-quarter w3-right">

<label for="problem">نوع مشکل</label>

<input type="text" name="problem" class="w3-input w3-border w3-round persian">

</div>





</div>


<div class="w3-row-padding w3-margin-top">
<div class="w3-col l12 w3-right">

<label for="des">راه حل مشکل</label>

<textarea name="description" id="des" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>

</div>

</div>




<input type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



</form>










</div>



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-animate-right" style="height:200px; overflow-x: hidden; 
                overflow-x: auto; ">

<div class="w3-card w3-margin-top w3-padding w3-round w3-border  persian "> 
  <div class="w3-row-padding">
  <div class=" w3-col l3 w3-right" dir="rtl">
  داخلی :
  </div>  
   
  <div class=" w3-col l3 w3-right" dir="rtl">
   کد پرسنلی :
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
   وضعیت پروژه : 
   </div>

   <div class=" w3-col l3 w3-right" dir="rtl">
   نوع مشکل :
   </div>


</div>

<div class="w3-margin-top  w3-row-padding">
  <div class=" w3-col l12 w3-right" dir="rtl">
 توضیحات :
  </div>  
   
  


</div>


</div>



</div>


@endsection