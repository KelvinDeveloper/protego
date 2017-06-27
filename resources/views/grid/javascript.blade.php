<script>
$('.delete').click(function () {

  var This = $(this);

  swal({
    title: 'Deseja deletar o registro?',
    text: 'Tem certeza que deseja deletar permanentemente o registro?',
    type: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Deletar',
    closeOnConfirm: false,
    html: false
  }, function(){

    $.ajax({
      url: '/{{ str_singular($Model->getTable()) }}/' + This.attr('data-id') + '/delete',
      data: {
        _token: '{{ csrf_token() }}'
      },
      type: 'DELETE',
      dataType: 'json',
      success: function (json) {

        This.parents('tr').remove();

        swal('Deletado!',
            'O registro foi deletado com sucesso',
            'success');
      }
    });
  });

  return false;
});

$(document).ready(function() {

    setTimeout(function () {
      $('.lightSlider').lightSlider({
        autoWidth: 100,
        slideMove: 1, // slidemove will be 1 if loop is true
        thumbItem:1,
        // gallery: false,
        // currentPagerPosition: 'middle',
      });
    }, 1000)
});
</script>