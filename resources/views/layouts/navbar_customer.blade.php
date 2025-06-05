<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="{{ route('home') }}">
            Home
        </x-link-navbar>
        <x-link-navbar href="{{ route('customers.dashboard') }}">
            Dashboard
        </x-link-navbar>
        <x-link-navbar href="{{ route('customers.profile.edit') }}">
            Profilo
        </x-link-navbar>
        <x-link-navbar href="{{ route('customers.services.index') }}">
            Prestazioni
        </x-link-navbar>
        <x-link-navbar href="{{ route('customers.bookings.index') }}">
            Prenotazioni
        </x-link-navbar>
    </x-left-navbar>
    <x-right-navbar>
        <x-button-navbar href="{{ route('logout') }}">
            Logout
        </x-button-navbar>
    </x-right-navbar>
</x-wrapper-navbar>
