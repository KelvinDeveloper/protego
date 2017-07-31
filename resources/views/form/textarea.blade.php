<div class="form-group">
    <label class="col-sm-3 control-label">{!! $Field->label !!}</label>
    <div class="col-sm-6">
        <textarea name="{{ $Field->name }}" class="form-control">{{ $Field->value }}</textarea>
    </div>
</div>