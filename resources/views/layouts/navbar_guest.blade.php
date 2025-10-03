<x-wrapper-navbar class="bg-[#FB7116] border-[#FB7116]">
    <x-left-navbar>
        <x-link-navbar href="#struttura" class="text-[#FB7116] hover:text-orange-600">
            Struttura
        </x-link-navbar>
        <x-link-navbar href="#funzionalita" class="text-[#FB7116] hover:text-orange-600">
            Funzionalità
        </x-link-navbar>
        <x-link-navbar href="#dipartimenti" class="text-[#FB7116] hover:text-orange-600">
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

            <x-button-navbar href="{{ $dashboardRoute }}" class="border-[#FB7116] text-[#FB7116] hover:bg-[#FB7116] hover:text-white">
                Area Personale
            </x-button-navbar>

            <x-button-navbar href="{{ route('logout') }}" class="border-[#FB7116] text-[#FB7116] hover:bg-[#FB7116] hover:text-white">
                Logout
            </x-button-navbar>
        @else
            <x-button-navbar href="{{ route('login') }}" class="border-[#FB7116] text-[#FB7116] hover:bg-[#FB7116] hover:text-white">
                Login
            </x-button-navbar>
            <x-button-navbar href="{{ route('register') }}" class="border-[#FB7116] text-[#FB7116] hover:bg-[#FB7116] hover:text-white">
                Register
            </x-button-navbar>
        @endif
    </x-right-navbar>
</x-wrapper-navbar>


