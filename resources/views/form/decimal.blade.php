<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->name }}</label>
    <div class="col-sm-6">
        <input name="{{ $Field->key }}" type="text" class="form-control" value="{{ $Field->value }}">
    </div>
</div>

<script>
  $('[name="{{ $Field->key }}"]').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.',
    allowNegative: true,
    centsLimit: {{ $Field->scale }}
  });
</script>