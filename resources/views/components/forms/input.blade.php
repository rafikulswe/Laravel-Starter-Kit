@props([
    'type' => 'text',
    'id' => '',
    'name' => '',
    'value' => '',
    'class' => 'form-control',
    'placeholder' => '',
    'readonly' => false,
    'disabled' => false,
    'maxlength' => null,
    'autocomplete' => null,
    'size' => null,
    'icon' => '',
    'iconPosition' => 'left',
    'textStyle' => '',
    'min' => null,
    'max' => null,
])

@php
    $sizeClass = $size ? 'form-control-' . $size : '';
    $iconClass = $icon ? 'form-group-feedback form-group-feedback-' . $iconPosition . ' form-group-feedback-' . $size : '';
    $textStyleClass = '';

    switch ($textStyle) {
        case 'light':
            $textStyleClass = 'font-weight-light';
            break;
        case 'semibold':
            $textStyleClass = 'font-weight-semibold';
            break;
        case 'bold':
            $textStyleClass = 'font-weight-bold';
            break;
        case 'capitalize':
            $textStyleClass = 'text-capitalize';
            break;
        case 'center':
            $textStyleClass = 'text-center';
            break;
        case 'right':
            $textStyleClass = 'text-right';
            break;
        case 'uppercase':
            $textStyleClass = 'text-uppercase';
            break;
    }

    $inputClass = trim("form-control $sizeClass $textStyleClass $class");
@endphp

@if($type === 'file')
    <div class="custom-file">
        <input {{ $attributes->merge([
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'class' => 'custom-file-input',
            'placeholder' => $placeholder,
            'readonly' => $readonly ? 'readonly' : null,
            'disabled' => $disabled ? 'disabled' : null,
            'maxlength' => $maxlength,
            'autocomplete' => $autocomplete,
        ]) }}>
        <label class="custom-file-label" for="{{ $id }}">{{ $placeholder ?: 'Choose file' }}</label>
    </div>
@else
    <div class="{{ $iconClass }}">
        <input {{ $attributes->merge([
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'value' => $value,
            'class' => $inputClass,
            'placeholder' => $placeholder,
            'readonly' => $readonly ? 'readonly' : null,
            'disabled' => $disabled ? 'disabled' : null,
            'maxlength' => $maxlength,
            'autocomplete' => $autocomplete,
            'min' => $min,
            'max' => $max,
        ]) }}>
    </div>
@endif
