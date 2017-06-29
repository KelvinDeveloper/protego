@extends('auth')

@section('content')
    <div class="am-wrapper am-login am-signup">
        <div class="am-content">
            <div class="main-content">
                <div class="login-container sign-up">
                    <div class="panel panel-default">
                        <div class="panel-heading"><img src="/img/logo-full-retina.png" alt="logo" width="150px" height="39px" class="logo-img"><span>Termos e Condições.</span></div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <p>
                                Este Termos de Uso estabelece as regras para utilização da Plataforma Protego. Informamos que através da sua aceitação você está contratando nossos serviços e aceitando as condições
                                apresentadas neste contrato. Se você não concorda com os termos e condições apresentados, não finalize seu cadastro, nem utilize nossos serviços. A utilização da plataforma implica
                                em contratação tácita de nossos serviços e por força dessa contratação a concordância com as cláusulas aqui apresentadas.
                            </p> <br>

                            <h4>1. Sua Conta</h4>

                            <p>
                                O cliente fará o cadastro na plataforma da Protego através do site (<a href="http://www.protego.com" target="_blank">www.protego.com</a>), definindo um login e senha.
                            </p>

                            <p>
                                O cliente é o responsável por seu login e senha. A Protego recomenda que o cliente não compartilhe com terceiros tais informações e, caso estas informações sejam
                                extraviadas e ou hackeadas, pedimos que nos informe imediatamente para que possamos solucionar a questão.
                            </p>

                            <p>
                                ATENÇÃO: O cliente deve guardar o endereço de e-mail cadastrado como login. Esse endereço deverá ser válido e permanecer válido durante todo o prazo de utilização dos serviços,
                                todas as aplicações e atividades do cliente serão vinculadas ao endereço de e-mail cadastrado na conta.
                            </p>

                            <h4>2. Definição dos Serviços Prestados pela Protego</h4>

                            <p>A Protego é uma plataforma de gestão de aplicações WEB das mais diversas funções e seguimentos</p>

                            <p>
                                Ao utilizar os serviços da Protego o cliente é o único responsável pelo gerenciamento de suas aplicações, determinando os recursos que melhor atende sua necessidade.
                            </p>

                            <p>
                                A Protego não oferece serviço de backup de dados.
                            </p> <br>

                            <form action="/register/">
                                <button data-dismiss="modal" type="submit" class="btn btn-primary btn-lg">Quero me cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection