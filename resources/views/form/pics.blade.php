<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->name }}</label>
    {!! $Field->value !!}
</div>

<script>
  $('button[name="{{ $Field->key }}"]').uploadifive({
    auto: {{ $Field->auto }},
    uploadScript: '/{{ str_singular($Model->getTable()) }}/{{ $Value->id ?: 'new' }}/file/upload',
    buttonText: '{{ $Field->buttonText }}',
    buttonClass: 'btn btn-primary',
    fileObjName: '{{ $Field->objName }}',
    fileSizeLimit: '{{ $Field->sizeLimit }}MB',
{{--    fileType: '{{ $Field->fileType }}',--}}
    multi: {{ $Field->multi }},
    formData: {
      _token: '{{ csrf_token() }}',
      name: '{{ $Field->key }}',
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

//      var json = JSON.parse(data);
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