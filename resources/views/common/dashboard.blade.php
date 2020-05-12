@extends('layouts.layout')

@section('title','داشبورد')

@section('content')



<div class="w3-margin w3-row-padding w3-animate-right" dir="rtl">


<div class="w3-third w3-right ">
نام :

{{$user->name}}

</div>

<div class="w3-third w3-right ">
نام خانوادگی :
{{$user->last_name}}

</div>

<div class="w3-third w3-right ">
کد پرسنلی :
{{$user->pid}}
</div>


</div>



@endsection