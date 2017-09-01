<section id="portfolio">
    <div class="row">
        <div class="twelve columns collapsed">
            <h1>{!! isset( $Json->title ) ? $Json->title : 'Confira alguns dos meus trabalhos.' !!}</h1>

            <!-- portfolio-wrapper -->
            <div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-thirds cf">

            @foreach($Portfolios as $Portfolio)
                <?php
                unset($Portfolio->title);
                $Image = (object) pathinfo( $Portfolio->pic );
                ?>

                <div class="columns portfolio-item">
                    <div class="item-wrap">

                        <a href="#modal-{{ $Portfolio->id }}" title="">
                            <img alt="" src="/img{{ $Image->dirname }}/thumb/{{ "{$Image->filename}-650x350.{$Image->extension}" }}">
                            <div class="overlay">
                                <div class="portfolio-item-meta">
                                    <h5>{{ $Portfolio->title }}</h5>
                                </div>
                            </div>
                            <div class="link-icon"><i class="icon-plus"></i></div>
                        </a>

                    </div>
                </div> <!-- item end -->

                <div id="modal-{{ $Portfolio->id }}" class="popup-modal mfp-hide">

                    <img class="scale-with-grid" src="/img{{ $Portfolio->pic }}" alt="" />

                    <div class="description-box">
                        <h4>{{ $Portfolio->title }}</h4>
                        <p>{!! $Portfolio->description !!}</p>
                    </div>

                    <div class="link-box">
                        <a class="popup-modal-dismiss">Close</a>
                    </div>

                </div><!-- modal-01 End -->
            @endforeach
            </div> <!-- portfolio-wrapper end -->
        </div> <!-- row End -->
    </div>
</section> <!-- Portfolio Section End-->