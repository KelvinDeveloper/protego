@extends('auth')

@section('content')
    <div class="am-wrapper am-login am-signup">
        <div class="am-content">
            <div class="main-content">
                <div class="login-container sign-up">
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="/img/logo-full-retina.png" alt="logo" width="150px" height="39px" class="logo-img"><span>Digite as informações do usuário.</span></div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('register') }}" class="form-horizontal">
                                    {{ csrf_field() }}
                                <!--div class="title"><span>Sign up with</span></div-->
                                <div class="sign-up-form">
                                    <!-- div class="form-group row social-signup">
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook icon icon-left"></i> Facebook</button>
                                        </div>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn btn-block btn-social btn-twitter"><i class="fa fa-twitter icon icon-left"></i> Twitter</button>
                                        </div>
                                    </div>
                                    <div class="title"><span class="title">Or</span></div-->
                                    <div class="form-group">
                                        <div id="nick-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <input type="text" name="name" data-parsley-trigger="change" data-parsley-errors-messages-disabled="true" data-parsley-class-handler="#nick-handler" required="" placeholder="Nome" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="nick-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <input type="text" name="lastname" data-parsley-trigger="change" data-parsley-errors-messages-disabled="true" data-parsley-class-handler="#nick-handler" required="" placeholder="Sobrenome" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="email-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">email</i></span>
                                            <input type="email" name="email" data-parsley-trigger="change" data-parsley-errors-messages-disabled="true" data-parsley-class-handler="#email-handler" required="" placeholder="E-mail" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-6">
                                            <div id="password-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
                                                <input id="pass1" type="password" data-parsley-errors-messages-disabled="true" placeholder="Senha" data-parsley-class-handler="#password-handler" required="" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div id="confirm-handler" class="input-group"><span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
                                                <input parsley-equalto="#pass1" type="password" data-parsley-errors-messages-disabled="true" data-parsley-class-handler="#confirm-handler" required="" placeholder="Confirmar senha" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="conditions">Ao criar uma conta, você concorda com os <a href="/terms-and-conditions">Termos e Condições</a>.</p>
                                <button type="submit" class="btn btn-block btn-primary btn-lg">Cadastrar</button> <br>
                                <div class="m-t-25 m-b--5 align-center">
                                    <p>
                                        <a href="/login">Já é cadastrado?</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center out-links"><a href="#">© {{ date('Y') }} Protego</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection