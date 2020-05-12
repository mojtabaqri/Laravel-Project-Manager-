@extends('layouts.layout')

@section('title','مدیریت پروژه ها')

@section('content')



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-row-padding w3-animate-right" dir="rtl">

<form action="/projects" method="post">
@csrf
<div class="w3-row-padding" >

<div class="w3-half w3-right">

<label for="title">عنوان</label>

<input type="text" name="title" class="w3-input w3-border w3-round persian">

</div>


<div class="w3-half w3-right">

<label for="date">مهلت</label>

<input type="number" name="date" class="w3-input w3-border w3-round persian">

</div>








</div>


<div class="w3-row-padding w3-margin-top">
<div class="w3-col l12 w3-right">

<label for="description">توضیحات</label>

<textarea name="description" id="description" cols="5" rows="3" class="w3-input w3-border  w3-round persian"></textarea>

</div>

</div>


<input type="submit" value="ثبت" class="w3-btn w3-green w3-round w3-left w3-margin">



</form>










</div>



<div class="w3-margin w3-card w3-padding w3-round w3-border w3-animate-right" style="height:200px; overflow-x: hidden; 
                overflow-x: auto; ">
@foreach($projects as $project)
<div class="w3-card w3-margin-top w3-padding w3-round w3-border persian w3-row-padding "> 
  <div class=" w3-col l3 w3-right" dir="rtl">
    عنوان :
    {{$project->title}}
  </div>  
   
  <div class=" w3-col l3 w3-right" dir="rtl">
 مهلت :
    {{$project->date}}
    روز
  </div>
  <div class=" w3-col l3 w3-right" dir="rtl">
 توضیحات :
    {{$project->description}}
  </div>

  <div class=" w3-col l3 w3-right" dir="rtl">
<form action="{{route('projects.destroy',['id'=>$project->id])}}" method="post">
  @csrf
@method('DELETE') 
   <button type="submit" class="w3-button w3-white w3-text-red 
   w3-border-red w3-left w3-round w3-border w3-hover-red w3-hove-text-white">&times;</a>
   </form>
  </div>
</div>

@endforeach

</div>


@endsection