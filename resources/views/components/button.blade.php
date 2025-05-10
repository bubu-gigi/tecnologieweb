@props(['class' => ''])
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg w-max {{ $class }}">
    {{ $slot }}
</button>
