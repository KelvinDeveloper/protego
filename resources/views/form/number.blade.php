<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->label }}</label>
    <div class="col-sm-6">
        <input name="{{ $Field->name }}" type="number" class="form-control" value="{{ $Field->value }}" {{ $Field->notNull ? 'required' : '' }}>
    </div>
</div>