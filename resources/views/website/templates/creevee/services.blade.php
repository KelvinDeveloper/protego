<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Serviços</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            @foreach($Services as $Service)
                <?php unset($Service->title) ?>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        {!! $Service->icon !!}
                        <h3>{{ $Service->title }}</h3>
                        <p class="text-muted">{{ $Service->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>