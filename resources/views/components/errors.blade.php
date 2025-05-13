@props(['field'])

@if ($errors->has($field))
    <ul class="error">
        @foreach ($errors->get($field) as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
