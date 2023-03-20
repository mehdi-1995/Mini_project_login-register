@extends('layouts.auth')

@section('title', __())
@section('class', 'log_in_page')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @lang('auth.two factor authentication')
                </div>
                <div class="card-body">
                    <x-alert-section></x-alert-section>
                    <p class="small text-center card-text">@lang('auth.we\'ve send a SMS to your number')</p>
                    <form method="POST" action="{{ route('auth.login.confirmCode') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-2">
                                <input type="text" name="code" class="form-control" id="code"
                                    aria-describedby="codeHelp" placeholder="@lang('auth.enter code')">
                            </div>
                        </div>
                        <div class="col-sm-9 offset-sm-3">
                            <x-error-validations></x-error-validations>
                        </div>
                        <div class="offset-sm-3">
                            <button type="submit" class="btn btn-primary">@lang('auth.confirm')</button>
                            <a class="small ml-2" href="#">@lang('auth.didNotGetCode')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
