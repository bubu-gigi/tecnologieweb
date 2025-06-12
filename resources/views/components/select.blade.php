@props([
    'name',
    'id' => null,
    'label' => '',
    'value' => '',
    'class' => '',
    'autofocus' => false,
])

<div class="flex flex-col mb-4">
    @if($label)
        <x-label :for="$name">{{ $label }}</x-label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        @if($autofocus) autofocus @endif
        class="w-full rounded-md px-4 py-2 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm {{ $class }}"
    >
        {{ $slot }}
    </select>

    <x-errors :field="$name" />
</div>
