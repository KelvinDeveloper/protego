<div class="clearfix col-sm-9">
    <ul class="form-pics">

        <li style="position: relative" class="upload-file">
            <span>
                <i class="material-icons">cloud_upload</i> <br>
                <span>Selecionar arquivos</span>
            </span>

            <button name="{{ $Field->key }}"></button>
        </li>

        @foreach ( $Files as $File )

            @if( @is_array( getimagesize( $Path . $File ) ) )

                <?php $File = pathinfo($File); ?>

                <li style="background-image: url( '/img{{ $Location }}thumb/{{ $File['filename'] }}-300x300.{{ $File['extension'] }}' )">
                    <i class="material-icons right delete-file" data-location="/img{{ $Location }}{{ $File['basename'] }}" name="{{ $Field->key }}">delete</i>
                </li>
            @endif
        @endforeach
    </ul>
</div>