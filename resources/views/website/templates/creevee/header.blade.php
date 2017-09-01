<header id="home">

    <nav id="nav-wrap">

        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
        <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

        <ul id="nav" class="nav">
            <li class="current"><a class="smoothscroll" href="#home">Home</a></li>
            @foreach($Menu as $Item)
                <li><a class="smoothscroll" href="{{ $Item->href }}">{{ $Item->name }}</a></li>
            @endforeach
        </ul> <!-- end #nav -->

    </nav> <!-- end #nav-wrap -->

    <div class="row banner">
        <div class="banner-text">
            <h1 class="responsive-headline">{{ $About->title  }}</h1>
            <h3>{{ $About->subtitle }}</h3>
            <hr />
            <ul class="social">
                @if( $Social )
                    {!! $Social->facebook ? '<li><a href="' . $Social->facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : ''          !!}
                    {!! $Social->twitter ? '<li><a href="' . $Social->twitter . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : ''            !!}
                    {!! $Social->google_plus ? '<li><a href="' . $Social->google_plus . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>' : ''    !!}
                    {!! $Social->linkedin ? '<li><a href="' . $Social->linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : ''          !!}
                    {!! $Social->instagram ? '<li><a href="' . $Social->instagram . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' : ''        !!}
                    {!! $Social->dribbble ? '<li><a href="' . $Social->dribbble . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' : ''          !!}
                    {!! $Social->skype ? '<li><a href="' . $Social->skype . '" target="_blank"><i class="fa fa-skype"></i></a></li>' : ''                !!}
                @endif
            </ul>
        </div>
    </div>

    <p class="scrolldown">
        <a class="smoothscroll" href="#about"><i class="icon-down-circle"></i></a>
    </p>

</header>