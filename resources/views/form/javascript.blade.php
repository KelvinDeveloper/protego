<script>
  $('form#form-{{ str_singular($Model->getTable()) }}').submit(function (e) {

    e.stopPropagation();

    var $Data = new FormData(this),
        Form  = $(this);

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      dataType: 'json',
      contentType: false,
      processData: false,
      data: $Data,
      success: function (json) {

        window.location.href = json.redirect;
      },
      error: function (request, status, error) {

        $.each(request.responseJSON, function (field, message) {

          Form.find('[name="' + field + '"]').addClass('error');

          $.gritter.add({
            title:"Ooops!",
            text:message,
            class_name:"color danger"
          })
        });
      }
    });
    return false;
  });

  $(document).ready(function () {

    $('form#form-{{ str_singular($Model->getTable()) }}').find('input, textarea').blur(function () {
      $(this).removeClass('error');
    });

    $('form#form-{{ str_singular($Model->getTable()) }}').find('select').change(function () {
      $(this).removeClass('error');
    });
  });

    $(document).off('click', '.delete-file');
    $(document).on('click', '.delete-file', function () {

      var This = $(this);

      swal({
        title: 'Deseja deletar o arquivo?',
        text: 'Tem certeza que deseja deletar permanentemente este arquivo?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Deletar',
        closeOnConfirm: false,
        html: false
      }, function(){

        $.ajax({
          url: '/{{ str_singular($Model->getTable()) }}/{{ $Value->id ?: 'new' }}/file/delete',
          data: {
            _token: '{{ csrf_token() }}',
            location: This.attr('data-location'),
            field: This.attr('name')
          },
          type: 'POST',
          dataType: 'json',
          success: function (json) {

            This.parents('li').remove();

            if ( This.attr('data-multi') == 'false' ) {

              $('#list-items-' + This.attr('name') + ' li.upload-file').show();
            }

            swal('Deletado!',
                'O registro foi deletado com sucesso',
                'success');
          }
        });
      });
    });
</script>