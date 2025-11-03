<section class="bg-white px-8 py-4 border border-[#FB7116] flex justify-between items-center flex-wrap gap-4 rounded-lg">
        <a href="#funzionalita" class="text-[#FB7116] hover:text-orange-600">
            Funzionalità
        </a>
        <a href="#azienda" class="text-[#FB7116] hover:text-orange-600">
            Azienda
        </a>
        <a href="#prodotti" class="text-[#FB7116] hover:text-orange-600">
            Prodotti
        </a>
        <a href="#centri_assistenza" class="text-[#FB7116] hover:text-orange-600">
            Centri Assistenza
        </a>
        @if (Auth::check())
            @php
                $role = Auth::user()->ruolo;
                $dashboardRoute = match($role) {
                    'amministratore' => route('amministratore.dashboard'),
                    'tecnico_assistenza' => route('tecnicoAssistenza.dashboard'),
                    'tecnico_azienda' => route('tecnicoAzienda.dashboard'),
                    default => route('home'),
                };
            @endphp

            <a href="{{ $dashboardRoute }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
                Area Personale
            </a>

            <a href="{{ route('logout') }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
                Logout
            </a>
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
                Login
            </a>
        @endif
</section>


