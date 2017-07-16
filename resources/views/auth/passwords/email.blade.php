@extends('auth')

@section('content')

    <div class="am-wrapper am-login">
        <div class="am-content">
            <div class="main-content">
                <div class="login-container forgot-password">
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="/img/logo-full-retina.png" alt="logo" width="150px" height="39px" class="logo-img"><span>Digite as informações do usuário.</span></div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                <p class="text-center">Don't worry, we'll send you an email to reset your password.</p>
                                <div class="form-group">
                                    <div id="email-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">email</i></span>
                                        <input type="email" name="email" parsley-trigger="change" data-parsley-errors-messages-disabled="true" data-parsley-class-handler="#email-handler" required="" placeholder="Your Email" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary btn-lg">Reset Password</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center out-links"><a href="#">© {{ date('Y') }} Protego</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection