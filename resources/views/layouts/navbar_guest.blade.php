<x-wrapper-navbar class="bg-[#FB7116] border-[#FB7116]">
    <x-left-navbar>
        <x-link-navbar href="#struttura" class="text-white hover:text-orange-100">
            Struttura
        </x-link-navbar>
        <x-link-navbar href="#funzionalita" class="text-white hover:text-orange-100">
            Funzionalità
        </x-link-navbar>
        <x-link-navbar href="#dipartimenti" class="text-white hover:text-orange-100">
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
                    default => route('home'),
                };
            @endphp

            <x-button-navbar href="{{ $dashboardRoute }}" class="border-white text-white hover:bg-white hover:text-[#FB7116]">
                Area Personale
            </x-button-navbar>

            <x-button-navbar href="{{ route('logout') }}" class="border-white text-white hover:bg-white hover:text-[#FB7116]">
                Logout
            </x-button-navbar>
        @else
            <x-button-navbar href="{{ route('login') }}" class="border-white text-white hover:bg-white hover:text-[#FB7116]">
                Login
            </x-button-navbar>
            <x-button-navbar href="{{ route('register') }}" class="border-white text-white hover:bg-white hover:text-[#FB7116]">
                Register
            </x-button-navbar>
        @endif
    </x-right-navbar>
</x-wrapper-navbar>

