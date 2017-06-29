<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->label }}</label>
    <div class="clearfix col-sm-9">

        @if ( $Field->multi == 'false' )
            <input type="hidden" name="{{ $Field->name }}">
        @endif

        <ul class="form-pics">

            <li style="position: relative" class="upload-file">
            <span>
                <i class="material-icons">cloud_upload</i> <br>
                <span>Selecionar arquivos</span>
            </span>

                <button name="{{ $Field->name }}"></button>
            </li>

            @if ( $Field->multi == 'false' )
                <?php $File = pathinfo($Field->value); ?>
                @if ( ! empty( $Field->value ) )
                    <li style="background-image: url( '/img{{ $File['dirname'] }}/thumb/{{ $File['filename'] }}-150x150.{{ $File['extension'] }}' )">
                        <i class="material-icons right delete-file" data-location="/img{{ $Field->path }}{{ $File['basename'] }}" name="{{ $Field->name }}">delete</i>
                    </li>
                @endif
            @else
                {!! $Field->value !!}
            @endif
        </ul>
    </div>
</div>

<script>
  $('button[name="{{ $Field->name }}"]').uploadifive({
    auto: {{ $Field->auto }},
    uploadScript: '/{{ str_singular($Model->getTable()) }}/{{ $Value->id ?: 'new' }}/file/upload',
    buttonText: '{{ $Field->buttonText }}',
    buttonClass: 'btn btn-primary',
    fileObjName: '{{ $Field->objName }}',
    fileSizeLimit: '{{ $Field->sizeLimit }}MB',
    width: 150,
    height: 150,
    multi: {{ $Field->multi }},
    formData: {
      _token: '{{ csrf_token() }}',
      name: '{{ $Field->name }}',
      hash: '{{ $Model->hash }}'
    },
    queueID: undefined,
    itemTemplate: undefined,

    onProgress: function (file, e) {

//      Loader(true);
//      var percent = 0;
//
//      if (e.lengthComputable) {
//
//        percent = Math.round((e.loaded / e.total) * 100);
//      }
//
//      file.queueItem.parents('.image-upload').find('.progress').show().find('.determinate').css('width', percent + '%');

    },

    onUploadComplete: function (file, data) {

        @if ( $Field->multi == 'false' )
            $('[name="{{ $Field->name }}"]').val( file.name );
        @endif

//
//      $('#form-' + Array.Target + ' [name="' + Array.Field + '"]').val(json.file);
//      file.queueItem.parents('.image-upload').css({
//        'background-image': 'url(\'' + urlBucket + UploadConfig.location + '/' + json.file + '\')'
//      });
//
//      setTimeout(function () {
//
//        file.queueItem.parents('.image-upload').find('.progress').hide();
//        Loader(false);
//      }, 100);
    }
  });
</script>