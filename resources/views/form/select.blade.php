<div class="form-group">
    <label class="col-sm-3 control-label">{{ $Field->label }}</label>
    <div class="col-sm-6">
        <select name="{{ $Field->name }}" class="form-control">
            <option>Selecione</option>
            @foreach($Field->options as $Value => $Option)
                <option value="{{ $Value }}" {{ $Value == $Field->value ? 'selected' : '' }}>{{ $Option }}</option>
            @endforeach
        </select>
    </div>
</div>