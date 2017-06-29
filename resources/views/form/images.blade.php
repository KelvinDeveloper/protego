@foreach ( $Files as $File )

    @if( @is_array( getimagesize( $Path . $File ) ) )

        <?php $File = pathinfo($File); ?>

        <li style="background-image: url( '/img{{ $Location }}thumb/{{ $File['filename'] }}-150x150.{{ $File['extension'] }}' )">
            <i class="material-icons right delete-file" data-location="/img{{ $Location }}{{ $File['basename'] }}" name="{{ $Field->name }}">delete</i>
        </li>
    @endif
@endforeach