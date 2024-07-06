@props([
    'class' => 'col-form-label col-lg-2',
    'for' => '',
])

<label {{ $attributes->merge(['class' => $class, 'for' => $for]) }}>
    {{ $slot }}
</label>
