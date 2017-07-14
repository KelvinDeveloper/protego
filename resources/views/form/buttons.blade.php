<div class="text-right">
    <a href="/{{ str_plural($Model->getTable()) }}" class="btn btn-space btn-default"><i class="material-icons left">close</i> Cancelar</a>
    <button type="submit" class="btn btn-space btn-primary"><i class="material-icons left">save</i> Salvar</button>
</div>

<script>
$('button').click(function () {
  $('form').submit();
});
</script>