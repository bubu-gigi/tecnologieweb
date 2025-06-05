<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="{{ route('home') }}">
            Home
        </x-link-navbar>
        <x-link-navbar href="{{ route('staff.dashboard') }}">
            Dashboard
        </x-link-navbar>
        <x-link-navbar href="{{ route('staff.bookings.index') }}">
            Prenotazioni
        </x-link-navbar>
        <x-link-navbar href="{{ route('staff.services.index') }}">
            Agende
        </x-link-navbar>
    </x-left-navbar>
    <x-right-navbar>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button-navbar type="submit">
                Logout
            </x-button-navbar>
        </form>
    </x-right-navbar>
</x-wrapper-navbar>
