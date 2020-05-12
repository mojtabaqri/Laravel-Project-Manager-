@extends('layouts.layout')

@section('title','داشبورد')

@section('content')


<div class="w3-margin w3-card w3-round w3-border w3-padding w3-padding w3-animate-right" style="" dir="rtl">
<div class="w3-content" style="max-width:500px">
<form>



<div class="w3-margin-top">
    <label for="newpass">پسورد جدید</label>
    <input id="newpass" type="password" class="w3-input w3-border w3-round " dir="ltr">
</div>


<div class="w3-margin-top">
    <label for="newpassrepeat">تکرار پسورد جدید</label>
    <input id="newpassrepeat" type="password" class="w3-input w3-border w3-round " dir="ltr">
</div>

<input type="submit" value="تغییر " class="w3-btn w3-yellow w3-margin-top w3-round w3-border " id="changeBtn">

</form>
</div>

</div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script type="text/javascript">
        $("document").ready(function () {
            $("#changeBtn").click(function (e) {
                e.preventDefault();
                let newpass=$("#newpass").val();
                let repeat=$("#newpassrepeat").val();
                if(newpass!==repeat)
                {
                    alert('پسورد و تکرار آن یکسان نیستند!');
                    return false;
                }
                axios.post('/change-password',{
                    'password':newpass
                }).then(res=>{

                }).catch(err=>{

                })
            })

        })
    </script>
    @endsection
