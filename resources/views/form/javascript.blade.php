<script>
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

        swal('Deletado!',
            'O registro foi deletado com sucesso',
            'success');
      }
    });
  });
});
</script>