@props(['class' => '', 'type' => ''])
<button type="{{ $type }}" class="text-white px-4 py-2 rounded-lg w-max cursor-pointer {{ $class }}">
    {{ $slot }}
</button>
