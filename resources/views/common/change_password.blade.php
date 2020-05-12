@extends('layouts.layout')

@section('title','داشبورد')

@section('content')


<div class="w3-margin w3-card w3-round w3-border w3-padding w3-padding w3-animate-right" style="" dir="rtl">
<div class="w3-content" style="max-width:500px">
<form action="" method="post">

<div class="w3-margin-top">
    <label for="password">پسورد فعلی</label>
    <input type="password" class="w3-input w3-border w3-round" dir="ltr">
</div>

<div class="w3-margin-top">
    <label for="newpass">پسورد جدید</label>
    <input type="password" class="w3-input w3-border w3-round " dir="ltr">
</div>


<div class="w3-margin-top">
    <label for="newpassrepeat">تکرار پسورد جدید</label>
    <input type="password" class="w3-input w3-border w3-round " dir="ltr">
</div>

<input type="submit" value="تغییر " class="w3-btn w3-yellow w3-margin-top w3-round w3-border ">

</form>
</div>

</div>


@endsection