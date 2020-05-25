<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <title>دریافت گزارش</title>
</head>
<body>

<div class="container">


    <div class="row">
        <div class="col pw" dir="rtl">
            <div class="col-md-12">
                <div class="card" style="margin-bottom:0!important;">
                    <header class="card-header">
                        <h4 class="card-title mt-2 text-center" id="userTitle">تعمیرات و نگه داری سیستم </h4>
                    </header>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col form-group ">
                                    <label for="editDate">  شیفت کاری    </label><input readonly="" class="form-control"  value="{{$info['shift']}}">
                                </div> <!-- form-group end.// -->
                            </div>
                            <div class="form-row">
                                <div class="col form-group ">
                                    <label for="editDate">  تاریخ  دریافت   </label><input readonly="" class="form-control" value="{{$info['date']}}">
                                </div> <!-- form-group end.// -->
                            </div>

                            <div class="form-row">
                                <div class="col form-group ">
                                    <label>کد  سیستم </label>
                                    <input readonly="" type="text" class="form-control" value="{{$info['system_id']}}">
                                </div> <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->



                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="editSolution">  راه حل :</label>
                                  <div class="card">
                                      <div class="card-body">
                                          {{$info['solution']}}

                                      </div>
                                  </div>
                                </div> <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->

                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label>واحد اعلام کننده</label>
                                    <input readonly="" class="form-control "  value="{{$info['section_report']}}">

                                </div> <!-- form-group end.// -->
                            </div>

                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="editReporter">فرد اعلام کننده </label><input readonly="" class="form-control" value="{{$info['reporter']}}">
                                </div> <!-- form-group end.// -->
                            </div>
                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="editProblem">  مشکل بوجود آمده  </label><input readonly="" class="form-control" value="{{$info['problem']}}">
                                </div> <!-- form-group end.// -->
                            </div>
                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="editDelivery">    فرد تحویل دهنده  </label><input class="form-control" value="{{$info['delivery']}}">
                                </div> <!-- form-group end.// -->
                            </div>

                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="girande">    فرد تحویل گیرنده  </label><input class="form-control" value="{{$info['girande']}}">
                                </div> <!-- form-group end.// -->
                            </div>

                            <div class="form-row">
                                <div class="col form-group  ">
                                    <label for="editRegister">ثبت شده توسط   </label><input readonly="" class="form-control" value="{{$info['user_id']}}">
                                </div> <!-- form-group end.// -->
                            </div>



                        </form>
                    </div> <!-- card-body end .// -->

                </div> <!-- card.// -->
            </div>

        </div>
    </div>



</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
