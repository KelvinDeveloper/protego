<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') Protego</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="/favicon.png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="/lib/stroke-7/style.css"/>
    <link rel="stylesheet" type="text/css" href="/lib/jquery.nanoscroller/css/nanoscroller.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/lib/theme-switcher/theme-switcher.min.css"/>
    <link type="text/css" href="/css/style.css" rel="stylesheet">
    <link type="text/css" href="/css/custom.css" rel="stylesheet">
</head>

<body class="am-splash-screen">

    @yield('content')

    <script src="/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.min.js" type="text/javascript"></script>
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/lib/theme-switcher/theme-switcher.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
      });

    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        App.livePreview();
      });

    </script>

</body>

</html>