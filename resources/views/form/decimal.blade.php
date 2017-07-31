<div class="form-group">
    <label class="col-sm-3 control-label">{!! $Field->label !!}</label>
    <div class="col-sm-6">
        <input name="{{ $Field->name }}" type="text" class="form-control" value="{{ $Field->value }}">
    </div>
</div>

<script>
  $('[name="{{ $Field->name }}"]').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.',
    allowNegative: true,
    centsLimit: {{ $Field->scale }}
  });
</script>