<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="{{ url('/') }}">
            Home
        </x-link-navbar>
        <x-link-navbar href="{{ route('staff.dashboard') }}">
            Dashboard
        </x-link-navbar>
        <x-link-navbar href="/staff/prestazioni">
            Prestazioni
        </x-link-navbar>
    </x-left-navbar>
    <x-right-navbar>
        <x-button-navbar href="/logout">
            Logout
        </x-button-navbar>
    </x-right-navbar>
</x-wrapper-navbar>
