<div class="clearfix" style="width:100px;">
    <ul class="gallery list-unstyled lightSlider">
        @foreach ( $Files as $File )

            @if( @is_array( getimagesize( $Path . $File ) ) )

                <?php $File = pathinfo($File); ?>

                <li>
                    <img src="/img{{ $Location }}thumb/{{ $File['filename'] }}-100x100.{{ $File['extension'] }}" />
                </li>
            @endif
        @endforeach
    </ul>
</div>