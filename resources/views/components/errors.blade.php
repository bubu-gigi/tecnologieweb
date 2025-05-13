@props(['field'])

@if ($errors->has($field))
    <ul>
        @foreach ($errors->get($field) as $message)
            <li class="text-red-700">{{ $message }}</li>
        @endforeach
    </ul>
@endif
