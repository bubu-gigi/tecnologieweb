@props(['name', 'label' => '', 'value' => '', 'rows' => 4, 'class' => ''])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm ' . $class]) }}
    >{{ old($name, $value) }}
    </textarea>
    <x-errors :field="$name" />
</div>
