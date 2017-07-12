<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->label }} Atual</label>
    <div class="col-sm-6">
        <input name="{{ $Field->name }}_current" type="password" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Nova {{ $Field->label }}</label>
    <div class="col-sm-6">
        <input name="{{ $Field->name }}" type="password" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Repetir {{ $Field->label }}</label>
    <div class="col-sm-6">
        <input name="{{ $Field->name }}_confirmation" type="password" class="form-control">
    </div>
</div>