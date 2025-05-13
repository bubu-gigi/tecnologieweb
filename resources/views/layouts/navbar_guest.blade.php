<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="#struttura">
            Struttura
        </x-link-navbar>
        <x-link-navbar href="#dipartimenti">
            Dipartimenti
        </x-link-navbar>
        <x-link-navbar href="#funzionalita">
            Funzionalita
        </x-link-navbar>
    </x-left-navbar>
    <x-right-navbar>
    @if (Auth::check())
        <x-button-navbar href="/customers">
            Area Personale
        </x-button-navbar>
        <x-button-navbar href="/logout">
            Logout
        </x-button-navbar>
    @else
        <x-button-navbar href="/login">
            Login
        </x-button-navbar>
        <x-button-navbar href="/register">
            Register
        </x-button-navbar>
    @endif
    </x-right-navbar>
</x-wrapper-navbar>
