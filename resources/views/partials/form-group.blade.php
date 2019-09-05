<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <input id="{{ $name }}" type="{{ $type }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : '') }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" {{ $required ? 'required' : ''}}>
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>