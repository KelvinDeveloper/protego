@if(!Request::ajax())
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') Admin</title>
		<link rel="stylesheet" type="text/css" href="/lib/jquery.nanoscroller/css/nanoscroller.css"/><!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <script src="/lib/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="/lib/jquery.moneymask/jquery.moneymask-min.js" type="text/javascript"></script>
        <script src="/lib/jquery.uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
        <script src="/lib/lightslider/src/js/lightslider.js" type="text/javascript"></script>

        <link type="text/css" rel="stylesheet" href="/lib/lightslider/src/css/lightslider.css" />
		<link rel="stylesheet" type="text/css" href="/lib/theme-switcher/theme-switcher.min.css"/>
        <link type="text/css" href="/css/style.css" rel="stylesheet">
        <link type="text/css" href="/css/custom.css" rel="stylesheet">
        <link type="text/css" href="/css/themes/theme-cake.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/lib/sweetalert/dist/sweetalert.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	</head>
	<body>

        <div class="am-wrapper">
            @include('menu.top')

            @include('menu.left', ['Menu' => [
                    0	=>	[
                        'name'	=>	'Produtos',
                        'icon'  =>  'layers',
                        'items' =>  [
                            0   =>  [
                                'name'  =>  'Todos os produtos',
                                'href'	=>	'/products'
                            ],
                            1   =>  [
                                'name'  =>  'Novo produto',
                                'href'	=>	'/product/new'
                            ]
                        ]
                    ]
                ]])

			<div class="am-content" id="load-content">
				@yield('content')
			</div>
        </div>

        <script src="/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.min.js" type="text/javascript"></script>
        <script src="/js/main.js" type="text/javascript"></script>
        <script src="/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/lib/theme-switcher/theme-switcher.min.js" type="text/javascript"></script>
        <script src="/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
        <script src="/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
        <script src="/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
        <script src="/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
        <script src="/lib/chartjs/Chart.min.js" type="text/javascript"></script>
        <script src="/lib/countup/countUp.min.js" type="text/javascript"></script>
        <script src="/lib/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            //initialize the javascript
            App.init();
          });
        </script>
	</body>
</html>
@else
	@yield('content')
@endif