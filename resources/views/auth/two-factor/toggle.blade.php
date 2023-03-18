@extends('layouts.auth')

@section('title', __('auth.two factor authentication'))

@section('class', 'log_in_page')

@section('content')
    <!--======= log_in_page =======-->
    <div id="log-in" class="site-form log-in-form">
        <div id="log-in-head">
            <h5 class="text-center text-info">@lang('auth.Two-step authentication')</h5>
            <div id="logo"><img src="/img/logo.png" alt=""></a></div>
        </div>
        <div class="form-output">
            <x-alert-section></x-alert-section>
            @if (auth()->user()->hasTwoFactor())
                <div class="card-body text-center">
                    <div>
                        <small>
                            @lang('auth.two factor is active', ['number' => auth()->user()->phone_number])
                        </small>
                    </div>
                    <a href="{{ route('auth.two-factor.deActive') }}" class="btn btn-primary mt-5">@lang('auth.deactivate')</a>
                </div>
            @else
                <div class="card-body text-center">
                    <div>
                        <small>
                            @lang('auth.two factor is inactive', ['number' => auth()->user()->phone_number])
                        </small>
                    </div>
                    <a href="{{ route('auth.two-factor.activate') }}" class="btn btn-primary mt-5">@lang('auth.activate')</a>
                </div>
            @endif
        </div>
    </div>
    <!--======= // log_in_page =======-->
@endsection
