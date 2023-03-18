@extends('layouts.auth')

@section('class', 'sing-up-page')
@section('content')
    <!--======= register =======-->
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>ثبت نام</h1>
            <div id="logo"><a href="01-home.html"><img src="/img/logo.png" alt=""></a></div>
        </div>

        <div class="form-output">
            <x-error-validations />
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group label-floating">
                    <label class="control-label">نام</label>
                    <input name="name" class="form-control" placeholder="" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">ایمیل</label>
                    <input name="email" class="form-control" placeholder="" type="email">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">شماره تلفن</label>
                    <input name="phone_number" class="form-control" placeholder="" type="number">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">رمز عبور</label>
                    <input name="password" class="form-control" placeholder="" type="password">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">تأیید رمز عبور</label>
                    <input name="password_confirmation" class="form-control" placeholder="" type="password">
                </div>

                <div class="remember">
                    <div class="checkbox">
                        <label>
                            <input name="optionsCheckboxes" type="checkbox">
                            <a href="#">شرایط و ضوابط</a> سایت را قبول میکنم
                        </label>
                    </div>
                </div>

                <button class="btn btn-lg btn-primary full-width">ثبت نام</button>

                <div class="or"></div>

                <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fa fa-facebook"
                        aria-hidden="true"></i>ورود با فیس بوک</a>

                <a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fa fa-twitter"
                        aria-hidden="true"></i>ورود با توییتر</a>


                <p>شما یک حساب کاربری دارید؟ <a href="07-log_in_page.html"> ورود!</a> </p>
            </form>
        </div>
    </div>
    <!--======= // register =======-->
@endsection
