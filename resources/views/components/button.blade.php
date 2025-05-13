@props(['class' => '', 'type' => '', 'onclick' => null])
<button type="{{ $type }}" @if($onclick) onclick="{{ $onclick }}" @endif class="text-white px-4 py-2 rounded-lg w-max cursor-pointer {{ $class }}">
    {{ $slot }}
</button>
