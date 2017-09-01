<!DOCTYPE html>
<html lang="en">

<head>

    <!--- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ $Website->title }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="/creevee/css/default.css">
    <link rel="stylesheet" href="/creevee/css/layout.css">
    <link rel="stylesheet" href="/creevee/css/media-queries.css">
    <link rel="stylesheet" href="/creevee/css/magnific-popup.css">

    <!-- Script
    ================================================== -->
    <script src="/creevee/js/modernizr.js"></script>

    <!-- Favicons
     ================================================== -->
    <link rel="shortcut icon" href="favicon.png" >

</head>

<body id="page-top">

    {!! $Build !!}

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/creevee/js/jquery-1.10.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="/creevee/js/jquery-migrate-1.2.1.min.js"></script>

    <script src="/creevee/js/jquery.flexslider.js"></script>
    <script src="/creevee/js/waypoints.js"></script>
    <script src="/creevee/js/jquery.fittext.js"></script>
    <script src="/creevee/js/magnific-popup.js"></script>
    <script src="/creevee/js/init.js"></script>

    @if( ! empty( $Website->ga ) )
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '{{ $Website->ga }}', 'auto');
            ga('send', 'pageview');

        </script>
    @endif
</body>

</html>