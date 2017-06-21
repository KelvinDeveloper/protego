<div class="text-right">
    <a href="/{{ str_plural($Model->getTable()) }}" class="btn btn-space btn-default">Cancelar</a>
    <button type="submit" class="btn btn-space btn-primary">Salvar</button>
</div>

<script>
$('button').click(function () {
  $('form').submit();
});
</script>