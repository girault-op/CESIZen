@props(['name', 'label', 'type' => 'text', 'required' => false])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}@if($required)*@endif</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        class="form-control"
        value="{{ old($name) }}"
        @if($required) required @endif
    >
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
