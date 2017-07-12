<?php $File = pathinfo($Location); ?>

@if ( is_dir( public_path('img') . $Location) == false && file_exists( public_path('img') . $Location ))
    <img src="/img{{ $File['dirname'] }}/thumb/{{ $File['filename'] }}-100x100.{{ $File['extension'] }}" />
@else
    <img src="{{ '/img/no-pic.png' }}" height="100" width="100" />
@endif