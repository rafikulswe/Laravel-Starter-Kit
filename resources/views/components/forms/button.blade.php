@props([
    'type' => 'button', // 'button', 'submit', 'link'
    'class' => 'btn btn-light',
    'icon' => '',
    'dropdown' => false,
    'dropdownItems' => [],
    'href' => 'javascript:void(0)', // default to js void for link type
])

@if($dropdown)
    <div {{ $attributes->class(['btn-group']) }}>
        @if($type === 'link')
            <a href="{{ $href }}" class="{{ $class }} dropdown-toggle" data-toggle="dropdown">
                @if($icon)
                    <i class="{{ $icon }} mr-2"></i>
                @endif
                {{ $slot }}
            </a>
        @else
            <button type="{{ $type }}" class="{{ $class }} dropdown-toggle" data-toggle="dropdown">
                @if($icon)
                    <i class="{{ $icon }} mr-2"></i>
                @endif
                {{ $slot }}
            </button>
        @endif
        <div class="dropdown-menu dropdown-menu-right">
            @foreach($dropdownItems as $item)
                <a href="{{ $item['url'] }}" class="dropdown-item">
                    <i class="{{ $item['icon'] }}"></i> {{ $item['text'] }}
                </a>
            @endforeach
        </div>
    </div>
@else
    @if($type === 'link')
        <a href="{{ $href }}" {{ $attributes->class([$class]) }}>
            @if($icon)
                <i class="{{ $icon }} mr-2"></i>
            @endif
            {{ $slot }}
        </a>
    @else
        <button {{ $attributes->class([$class]) }} type="{{ $type }}">
            @if($icon)
                <i class="{{ $icon }} mr-2"></i>
            @endif
            {{ $slot }}
        </button>
    @endif
@endif

{{-- 
<div class="row">
    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Submit button</h6>
                <p class="text-muted mb-3">Submit button example</p>

                <x-forms.button type="submit" class="btn btn-primary">Submit</x-forms.button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Link button</h6>
                <p class="text-muted mb-3">Link button example</p>

                <x-forms.button type="link" class="btn btn-light"
                    href="https://example.com">Link</x-forms.button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Button with icon</h6>
                <p class="text-muted mb-3">Button with icon example</p>

                <x-forms.button type="button" class="btn btn-light" icon="icon-make-group">With
                    icon</x-forms.button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Link with icon</h6>
                <p class="text-muted mb-3">Link with icon example</p>

                <x-forms.button type="link" class="btn btn-light" icon="icon-make-group"
                    href="https://example.com">With icon</x-forms.button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Button with dropdown</h6>
                <p class="text-muted mb-3">Button with dropdown example</p>

                <x-forms.button type="button" class="btn btn-light" dropdown="true" :dropdown-items="[
                    ['url' => '#', 'icon' => 'icon-menu7', 'text' => 'Action'],
                    ['url' => '#', 'icon' => 'icon-screen-full', 'text' => 'Another action'],
                    ['url' => '#', 'icon' => 'icon-mail5', 'text' => 'One more action'],
                    ['url' => '#', 'icon' => 'icon-gear', 'text' => 'Separated line'],
                ]">
                    Dropdown
                </x-forms.button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body border-top-primary">
            <div class="text-center">
                <h6 class="m-0 font-weight-semibold">Link with dropdown</h6>
                <p class="text-muted mb-3">Link with dropdown example</p>

                <x-forms.button type="link" class="btn btn-light" href="https://example.com" dropdown="true"
                    :dropdown-items="[
                        ['url' => '#', 'icon' => 'icon-menu7', 'text' => 'Action'],
                        ['url' => '#', 'icon' => 'icon-screen-full', 'text' => 'Another action'],
                        ['url' => '#', 'icon' => 'icon-mail5', 'text' => 'One more action'],
                        ['url' => '#', 'icon' => 'icon-gear', 'text' => 'Separated line'],
                    ]">
                    Dropdown
                </x-forms.button>
            </div>
        </div>
    </div>
</div> --}}