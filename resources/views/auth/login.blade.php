@extends('auth')
@section('title', 'Login | ')

@section('content')
	<div class="am-wrapper am-login">
		<div class="am-content">
			<div class="main-content">
				<div class="login-container">
					<div class="panel panel-default">
						<div class="panel-heading"><img src="/img/logo-full-retina.png" alt="logo" width="150px" height="39px" class="logo-img"><span>Insira suas informações de usuário.</span></div>
						<div class="panel-body">
							<form role="form" method="POST" action="{{ route('login') }}" class="form-horizontal" id="login">
									{{ csrf_field() }}
								<div class="login-form">
									<div class="form-group">
										<div class="input-group"><span class="input-group-addon"><i class="material-icons">person</i></span>
											<input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group"><span class="input-group-addon"><i class="material-icons">vpn_key</i></span>
											<input type="password" class="form-control" name="password" placeholder="Senha" required>
										</div>
									</div>
									<div class="form-group login-submit">
										<button data-dismiss="modal" type="submit" class="btn btn-primary btn-lg">Logar</button>
									</div>
									<div class="form-group footer row">
										<div class="col-xs-6"><a href="/password/reset">Esqueceu a senha?</a></div>
										<div class="col-xs-6 remember">
											<label for="remember">Lembrar-me</label>
											<div class="am-checkbox">
												<input type="checkbox" id="remember" name="rememberme" class="needsclick">
												<label for="remember"></label>
											</div>
										</div>
										<div class="col-xs-6"><a href="/register">Registrar agora!</a></div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('form#login').submit(function (e) {

      	e.stopPropagation();

      	var $Data = new FormData(this);

      	$.ajax({
		  url: '/login',
		  type: 'POST',
		  dataType: 'json',
          contentType: false,
          processData: false,
		  data: $Data,
		  success: function (json) {

            window.location.href = '/home';
		  },
          error: function (request, status, error) {

            $.each(request.responseJSON, function (field, message) {
              $.gritter.add({
                title:"Ooops!",
                text:message,
                class_name:"color danger"
              })
			});
		  }
		});
	  	return false;
	});
	</script>
@endsection