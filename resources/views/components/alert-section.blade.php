@if (session('magicLinkSent'))
    <div class="alert alert-success">
        {{ session('magicLinkSent') }}
    </div>
@endif


@if (session('invalidToken'))
    <div class="alert alert-danger">
        {{ session('invalidToken') }}
    </div>
@endif

@if (session('codeSend'))
    <div class="alert alert-success">
        {{ session('codeSend') }}
    </div>
@endif

@if (session('cantSendCode'))
    <div class="alert alert-danger">
        {{ session('cantSendCode') }}
    </div>
@endif

@if (session('twoFactorActivated'))
    <div class="alert alert-success text-center">
        {{ session('twoFactorActivated') }}
    </div>
@endif

@if (session('invalidCode'))
    <div class="alert alert-danger">
        {{ session('invalidCode') }}
    </div>
@endif

@if (session('twoFactorDeactivated'))
    <div class="alert alert-success">
        {{ session('twoFactorDeactivated') }}
    </div>
@endif 

