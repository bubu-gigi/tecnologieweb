@props(['name', 'label' => '', 'value' => '', 'class' => ''])

<div class="mb-4">
    @if($label)
        <x-label :for="$name">{{ $label }}</x-label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="4"
    >{{ trim(old($name, $value)) }}</textarea>
    <x-errors :field="$name" />
</div>
