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
		<link rel="stylesheet" type="text/css" href="/lib/theme-switcher/theme-switcher.min.css"/>
		<link type="text/css" href="/css/themes/theme-cake.css" rel="stylesheet">
	</head>
	<body>

        <div class="am-wrapper">
            @include('menu.top')

            @include('menu.left', ['Items' => [
                    0	=>	[
                        'name'	=>	'Home',
                        'href'	=>	'/',
                        'icon'	=>	'home'
                    ],
                    1	=>	[
                        'name'	=>	'Produtos',
                        'href'	=>	'/products',
                        'icon'	=>	'list'
                    ]
                ]])

			<div class="am-content" id="load-content">
				@yield('content')
			</div>
        </div>

        <script src="/lib/jquery/jquery.min.js" type="text/javascript"></script>
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
        <script type="text/javascript">
          $(document).ready(function(){
            //initialize the javascript
            App.init();
            App.charts();
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            App.livePreview();
          });

        </script>
	</body>
</html>
@else
	@yield('content')
@endif