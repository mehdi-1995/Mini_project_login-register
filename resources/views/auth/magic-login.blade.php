@extends('layouts.auth')

@section('class', 'log_in_page')
@section('content')
    <!--======= log_in_page =======-->
    <div id="log-in" class="site-form log-in-form">
        <div id="log-in-head">
            <h1 class="text-danger">ورود جادویی</h1>
            <div id="logo"><a href="01-home.html"><img src="/img/logo.png" alt=""></a></div>
        </div>
        <div class="form-output">
            <x-alert-section></x-alert-section>
            <x-error-validations />
            <form action="{{ route('auth.magic.link.send') }}" method="post">
                @csrf
                <div class="form-group label-floating">
                    <label class="control-label">ایمیل</label>
                    <input name="email" class="form-control" placeholder="" type="email">
                </div>
                <button class="btn btn-lg btn-primary full-width">ورود</button>
                <div class="or"></div>

                <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fa fa-facebook"
                        aria-hidden="true"></i>ورود با فیس بوک</a>

                <a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fa fa-twitter"
                        aria-hidden="true"></i>ورود با توییتر</a>


                <p>آیا شما یک حساب کاربری ندارید؟ <a href="{{ route('register') }}">ثبت نام کنید!</a> </p>
            </form>
        </div>
    </div>
    <!--======= // log_in_page =======-->
@endsection
