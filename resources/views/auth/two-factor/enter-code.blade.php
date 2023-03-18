@extends('layouts.auth')

@section('title', __())

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
            <p class="small text-center card-text">@lang('auth.we\'ve send a SMS to your number')</p>
            <form action="{{ route('auth.two-factor.confirmCode') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="form-control">
                        <input type="text" name="code" class="form-control" id="code" aria-describedby="codeHelp"
                            placeholder="@lang('auth.enter code')">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">@lang('auth.confirm')</button>
                    <a class="small ml-2" href="#">@lang('auth.didNotGetCode')</a>
                </div>
            </form>
        </div>
    </div>
    <!--======= // log_in_page =======-->
@endsection








