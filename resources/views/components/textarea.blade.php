@props(['name', 'label' => '', 'value' => '', 'class' => ''])

<div class="mb-4">
    @if($label)
        <x-label :for="$name">{{ $label }}</x-label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="4"
        {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm ' . $class]) }}
    >{{ trim(old($name, $value)) }}</textarea>
    <x-errors :field="$name" />
</div>
