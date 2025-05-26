<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="#struttura">
            Struttura
        </x-link-navbar>
        <x-link-navbar href="#funzionalita">
            Funzionalita
        </x-link-navbar>
        <x-link-navbar href="#dipartimenti">
            Dipartimenti
        </x-link-navbar>
    </x-left-navbar>
    <x-right-navbar>
        @if (Auth::check())
            @php
                $role = Auth::user()->ruolo;
                $dashboardRoute = match($role) {
                    'admin' => route('admin.dashboard'),
                    'user' => route('customers.dashboard'),
                    'staff' => route('staff.dashboard'),
                    default => url('/'), // fallback se ruolo non previsto
                };
            @endphp

            <x-button-navbar href="{{ $dashboardRoute }}">
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
