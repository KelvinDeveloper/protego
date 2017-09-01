<footer>

    <div class="row">

        <div class="twelve columns">

            <ul class="social-links">
                {!! $Social->facebook ? '<li><a href="' . $Social->facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : ''          !!}
                {!! $Social->twitter ? '<li><a href="' . $Social->twitter . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : ''            !!}
                {!! $Social->google_plus ? '<li><a href="' . $Social->google_plus . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>' : ''    !!}
                {!! $Social->linkedin ? '<li><a href="' . $Social->linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : ''          !!}
                {!! $Social->instagram ? '<li><a href="' . $Social->instagram . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' : ''        !!}
                {!! $Social->dribbble ? '<li><a href="' . $Social->dribbble . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' : ''          !!}
                {!! $Social->skype ? '<li><a href="' . $Social->skype . '" target="_blank"><i class="fa fa-skype"></i></a></li>' : ''                !!}
            </ul>

            <ul class="copyright">
                <li>&copy; Copyright {{ date('Y') }} {{ $Website->title }}</li>
            </ul>

        </div>

        <div id="go-top"><a class="smoothscroll" title="Back to Top" href="#home"><i class="icon-up-open"></i></a></div>

    </div>

</footer> <!-- Footer End-->