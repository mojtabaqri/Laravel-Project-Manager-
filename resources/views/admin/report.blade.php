@extends('layouts.layout')

@section('title','گزارش گیری')

@section('content')


<div class="w3-margin w3-row  w3-stretch" dir="rtl">

<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32 w3-green">
    <h3 class="persian">انجام شده</h3>
<span class="w3-xxlarge">
    1
</span>
</div>


<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32 w3-text-white w3-amber">
    <h3 class="persian">نیمه تمام</h3>
<span class="w3-xxlarge">
    1
</span>
</div>



<div class=" w3-third w3-round w3-border w3-right w3-card w3-center w3-padding-32
 w3-text-white w3-red">
    <h3 class="persian">ارجاع</h3>
<span class="w3-xxlarge">
    20
</span>
</div>

</div>




<div class="w3-margin w3-card w3-padding w3-round w3-border " style="height:200px; overflow-x: hidden; 
                overflow-x: auto; ">
@for($i=0;$i<10;$i++)
<div class="w3-card w3-margin-top w3-padding-16 w3-round w3-border persian w3-row-padding "> 
  <div class=" w3-col l3 w3-right" dir="rtl">
  عنوان :
    تعمیر کیس
  </div>  
   
  <div class=" w3-col l3 w3-right" dir="rtl">
   مجری :
    احمد رضا کوهی
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
   وضعیت :
    در حال انجام
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
 
   <div class="w3-light-grey">
  <div class="w3-container w3-green w3-center" style="width:25%">1٪</div>
</div> 
  </div>


</div>

@endfor

</div>


@endsection