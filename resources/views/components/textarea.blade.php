@props(['name', 'label' => '', 'value' => '', 'class' => ''])

<div class="mb-4">
    @if($label)
        <x-label :for="$name">{{ $label }}</x-label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="4"
        {{ $attributes->merge(['class' => 'block w-full rounded-md px-4 py-2 border-gray-300 shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500 ' . $class]) }}
    >{{ trim(old($name, $value)) }}</textarea>
    <x-errors :field="$name" />
</div>
