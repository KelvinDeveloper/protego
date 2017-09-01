<section class="no-padding" id="portfolio">
    <div class="container-fluid">
        <div class="row no-gutter popup-gallery">

            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Portfólio</h2>
                <hr class="primary">
            </div>

            @foreach($Portfolios as $Portfolio)
                <?php
                    unset($Portfolio->title);
                    $Image = (object) pathinfo( $Portfolio->pic );
                    ?>
                <div class="col-lg-4 col-sm-6">
                    <a href="/img{{ $Portfolio->pic }}" class="portfolio-box">
                        <img src="/img{{ $Image->dirname }}/thumb/{{ "{$Image->filename}-650x350.{$Image->extension}" }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    {{ $Portfolio->title }}
                                </div>
                                <div class="project-name">
                                    {!! $Portfolio->description !!}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>