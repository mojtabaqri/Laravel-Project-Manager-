<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous"></head>
<body>

<div class="container-fluid">


    <div class="row">


        <div class="col">

            <table class="table table-striped" dir="rtl">
                <thead>
                <tr>
                    <th scope="col">کد پروژه </th>
                    <th scope="col">عنوان</th>
                    <th scope="col">تاریخ دریافت </th>
                    <th scope="col">نام تحویل گیرنده</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">زمان  تحویل </th>
                    <th scope="col">مهلت باقی مانده</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$info['id']}}</th>
                    <th scope="row">{{$info['title']}}</th>
                    <th scope="row">{{$info['created_at']}}</th>
                    <th scope="row">{{$info['userName']}}</th>
                    <th scope="row">{{$info['state']}}</th>
                    <th scope="row">{{$info['expireDay']}}</th>
                    <th scope="row">  {{$info['day']}} روز </th>
                </tr>
                </tbody>
            </table>

            <div class="card">
                <div class="card-title">توضیحات </div>
                <div class="card-body">
                    <div class="card-text">
                        {{$info['description']}}

                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
