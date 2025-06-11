@props(['class' => '', 'type' => 'button', 'onclick' => null, 'id' => null])

<button
    id="{{ $id }}"
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "text-white px-4 py-2 rounded-lg w-max cursor-pointer $class"]) }}
    @if($onclick) onclick="{{ $onclick }}" @endif
>
    {{ $slot }}
</button>
