<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

@yield('css')
</head>
<body>
<!-- hearder -->

<div class="w3-bar w3-red w3-padding  w3-card-4">


     <a href="{{url('logout')}}" class="w3-bar-item w3-button w3-left">
         <i class="material-icons">
             person
             </i>

     </a>
   </div>


<!-- end of header -->




 <div class="w3-row-padding w3-stretch persian">

<!-- sidebar -->

<div class="w3-col l2  w3-padding w3-card-2 w3-sidebar persian" style="right:0;">


<a href="{{route('dashboard')}}" class="w3-button w3-bar-item w3-block  w3-padding-small w3-right-align w3-round">
    <span class="w3-medium "><b>داشبورد</b></span><span class="
    w3-padding-small material-icons w3-text-red ">
    home
    </span></a>

<hr>

<div>
    <a href="{{route('help-desks.index')}}" class="w3-button w3-bar-item w3-block  w3-padding-small w3-right-align w3-round
    ">
        <span class="w3-medium ">Help Desk </span><span class="
        w3-padding-small material-icons w3-text-green ">
        live_help
        </span></a>

    <a href="{{route('messages.index')}}" class="w3-button w3-bar-item w3-block  w3-padding-small w3-right-align w3-round
    ">
        <span class="w3-medium ">پیام ها</span><span class="
        w3-padding-small material-icons w3-text-orange ">
        mail
        </span></a>
    @role('normal')

        <a href="{{route('projects.index')}}" class="w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
            <span class="w3-medium ">ایجاد پروژه</span><span class="
            w3-padding-small material-icons w3-text-blue ">
           folder
            </span></a>
   @endrole





          @role('normal')
          <a href="{{route('repairs.index')}}" class="w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
            <span class="w3-medium ">تعمیر و نگهداری </span><span class="
            w3-padding-small material-icons w3-text-pink ">
            build
            </span></a>
            @endrole


            <a href="{{route('chpass')}}" class="w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
            <span class="w3-medium ">تغییر پسورد</span><span class="
            w3-padding-small material-icons w3-text-yellow">
            vpn_key
            </span></a>


        @role('admin')
        <a href="{{route('registerUser')}}" class="w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
        <span class="w3-medium  "> اضافه کردن کاربران</span><span class="
            w3-padding-small material-icons w3-text-green">
            account_box
            </span></a>
         @endrole

    @role('admin')
    <a href="{{route('projects.index')}}" class=" w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
        <span class="w3-medium  ">    پروژه ها</span><span class="
            w3-padding-small material-icons  w3-text-gray">
            chrome_reader_mode
            </span></a>
    @endrole

    @role('admin')
    <a href="{{route('AdminReport')}}" class="w3-button w3-bar-item w3-block w3-margin-top w3-padding-small w3-right-align w3-round">
        <span class="w3-medium "> گزارشگیری  </span><span class="
            w3-padding-small material-icons w3-text-orange">
            book
            </span></a>
    @endrole

</div>



</div>


<!-- end of sidebar -->

<div class="w3-col l10  ">


     @yield('content')
</div>


      </div>

</div>

</div>
@yield('js')
</body>
</html>
