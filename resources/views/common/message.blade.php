@extends('layouts.layout')

@section('title','ثبت نام')

@section('content')



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

<form action="/messages" method="post">
@csrf
<div class="w3-row-padding" >

<div class="w3-half w3-right">

<label for="title">عنوان</label>

<input type="text" name="title" class="w3-input w3-border w3-round persian">

</div>


<!-- <div class="w3-half w3-right">

<label for="pid">کد پرسنلی</label>

<input type="text" name="pid" class="w3-input w3-border w3-round persian">

</div> -->









</div>


<div class="w3-row-padding w3-margin-top">
<div class="w3-col l12 w3-right">

<label for="des">توضیحات</label>

<textarea name="des" id="des" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>

</div>

</div>

<input type="submit" value="ارسال" class="w3-btn w3-orange w3-text-white w3-round w3-left w3-margin">



</form>










</div>



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-animate-right " style="height:200px; overflow-x: hidden; 
                overflow-x: auto; ">
@foreach($messages as $message)
<div class="w3-card w3-margin-top w3-padding w3-round w3-border persian w3-row-padding "> 
  <div class=" w3-col l4 w3-right" dir="rtl">
    
    عنوان :

{{$message->title}}
  </div>  
   
  <!-- <div class=" w3-col l3 w3-right" dir="rtl">
   کد پرسنلی :
    
  </div> -->

  <div class=" w3-col l4 w3-right" dir="rtl">
   توضیحات :
   {{$message->des}}
  </div>


  <div class=" w3-col l4 w3-right" dir="rtl">
  <form action="{{route('messages.destroy',['id'=>$message->id])}}" method="post">
  @csrf
@method('DELETE') 
   <button type="submit" class="w3-button w3-white w3-text-red 
   w3-border-red w3-left w3-round w3-border w3-hover-red w3-hove-text-white">&times;</a>
   </form>
  </div>
  </div>

</div>

@endforeach

</div>


<div>

</div>

@endsection


