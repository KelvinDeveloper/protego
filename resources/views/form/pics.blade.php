<?php $Path = $Value->id ? "/img{$Field->path}{$Value->id}/" : "/tmp{$Field->path}{$Model->hash}/"; ?>

<div class="form-group">
    <label class="col-sm-3 control-label">{!! $Field->label !!}</label>
    <div class="clearfix col-sm-9">

        @if ( $Field->multi == 'false' )
            <input type="hidden" name="{{ $Field->name }}">
        @endif

        <ul class="form-pics" id="list-items-{{ $Field->name }}">

            <li style="position: relative" class="upload-file">
                <span>
                    <i class="material-icons">cloud_upload</i> <br>
                    <span>{{ $Field->multi === "true" ? 'Escolher imagens' : 'Escolher arquivo' }}</span>
                </span>

                <button name="{{ $Field->name }}"></button>
            </li>

            @if ( $Field->multi == 'false' )
                <?php $File = pathinfo($Field->value); ?>
                @if ( ! empty( $Field->value ) && isset( $File['extension'] ) && file_exists( public_path('img') . "{$File['dirname']}/thumb/{$File['filename']}-150x150.{$File['extension']}" ) )
                    <li style="background-image: url( '/img{{ $File['dirname'] }}/thumb/{{ $File['filename'] }}-150x150.{{ $File['extension'] }}' )">
                        <i class="material-icons right delete-file" data-location="{{ $Path }}{{ $File['basename'] }}" name="{{ $Field->name }}" data-multi="{{ $Field->multi }}">delete</i>
                    </li>
                @endif
            @else
                {!! $Field->value !!}
            @endif
        </ul>
    </div>
</div>

<script>
    <?php $timestamp = time();?>
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
      timestamp: '{{ $timestamp }}',
      token: '{{ md5('unique_salt' . $timestamp) }}',
      _token: '{{ csrf_token() }}',
      name: '{{ $Field->name }}',
      hash: '{{ $Model->hash }}'
    },
    queueID: 'list-items-{{ $Field->name }}',
    itemTemplate: '<li class="uploadifive-queue-item">' +
    '<div class="progress">' +
        '<div style="width: 0%" class="progress-bar progress-bar-success progress-bar-striped active">0%</div>' +
      '</div>' +
    '</li>',

    onProgress: function (file, e) {

      var percent = 0;

      if (e.lengthComputable) {

        percent = Math.round((e.loaded / e.total) * 100);
      }

      file.queueItem.find('.progress-bar').css('width', percent + '%').text( percent + '%' );
    },

    onUploadComplete: function (file, data) {

        @if ( $Field->multi == 'false' )
            $('[name="{{ $Field->name }}"]').val( file.name );
            $('#list-items-{{ $Field->name }}').find('li.upload-file').hide();
        @endif

        file.queueItem.css({
          backgroundImage: "url('{{ $Path }}" + file.name + " ')"
        });

        file.queueItem.prepend('<i class="material-icons right delete-file" data-location="{{ $Path }}' + file.name + '" name="{{ $Field->name }}" data-multi="{{ $Field->multi }}">delete</i>');
    }
  });

  $('document').ready(function () {

    @if ( $Field->multi == 'false' )

        var $List = $('#list-items-{{ $Field->name }}');

        if ( $List.find('li').length > 1 ) {

          $List.find('li.upload-file').hide();
        }
    @endif
  });
</script>