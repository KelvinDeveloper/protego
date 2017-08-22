<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading">{{ $About->title  }}</h1>
            <hr>
            <p>{{ $About->subtitle }}</p>
            <a href="{!! isset( $Json->btn_href ) ? $Json->btn_text : '#services' !!}" class="btn btn-primary btn-xl page-scroll">{!! isset( $Json->btn_text ) ? $Json->btn_text : 'Conheça mais' !!}</a>
        </div>
    </div>
</header>