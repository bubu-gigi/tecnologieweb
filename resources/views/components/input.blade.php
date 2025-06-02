@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'class' => '',
])

<div class=" flex flex-col mb-4">
    @if($label)
        <x-label :for="$name">{{ $label }}</x-label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-md px-4 py-2 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
    >

    <x-errors :field="$name" />
</div>
