@extends('layouts.master')
@section('title','ورود')





@section('content')


  <div class="w3-display-container" style="width:100%">

               <div class="w3-content  " style="max-width:500px;margin-top:150px">

                <div class="w3-round-xxlarge  w3-border w3-card w3-container  persian w3-padding-32 w3-margin " >
                     <div class="  w3-xlarge w3-text-blue " style="" dir="rtl">
                    {{ __('ورود') }}
                </div>
                <hr class="w3-margin-top w3-margin-bottom">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <label for="email" class="w3-margin-top w3-margin-bottom w3-right persian" dir="rtl">{{ __('ایمیل:') }}</label>


                                <input id="email" type="email" class="w3-input w3-border w3-round @error('email') is-invalid @enderror"
                                 name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>





                        <div class="form-group row">
                            <label for="password" class="w3-margin-top w3-margin-bottom w3-right persian" dir="rtl">{{ __('پسورد:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="w3-input w3-border w3-round @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                                <div   class="w3-display-topmiddle">


                                    @error('email')
                                    <div
                                    id="emailError"
                                    class="w3-margin-top w3-panel w3-paddding-32 w3-red  w3-round persian" role="alert" dir="rtl">
                                        <p>{{ "ایمیل وارد شده نا معتبر است. یا گذروازه اشتباه است" }}</p>
                                    </div>

                                        <script>
                                        $('document').ready(function () {
                                            $('#emailError').fadeOut(5000);

                                        });

                                        </script>

                                @enderror





                                @error('password')
                                    <div id="passwordError"
                                    class="w3-panel w3-paddding-32 w3-red  w3-round persian" dir="rtl">
                                        <p>{{ 'فیلد پسورد نباید خالی باشد.' }}</p>
                                    </div>

                                    <script>
                                        $('document').ready(function () {
                                            $('#passwordError').fadeOut(5000);

                                        });

                                        </script>
                                @enderror

                                    </div>



                            </div>
                        </div>

                       <div class="w3-right-align w3-margin-top w3-margin-bottom">
                                <label class="" for="remember">
                                        {{ __('مرا به یاد آور') }}
                                    </label>

                                    <input class="w3-check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>


                            </div>



                            <div class="w3-right-align">


                                @if (Route::has('password.request'))
                                    <a class="w3-button
                                    w3-white w3-text-blue w3-hover-white
                                     w3-hover-text-gray w3-hide" href="{{ route('password.request') }}">
                                        {{ __('پسورد را فراموش کرده اید؟') }}
                                    </a>
                                @endif
                                 <button type="submit" class="w3-btn w3-blue w3-round-large">
                                    {{ __('ورود') }}
                                </button>
                            <a href="{{route('register')}}" class="w3-left
                            w3-button  w3-white w3-text-red
                            w3-hover-white w3-hover-text-gray w3-hide">ثبت نام نکرده ایید؟</a>
                            </div>

                    </form>
                </div>
                </div>

                </div>



@endsection
