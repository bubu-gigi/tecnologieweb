<section class="bg-white px-8 py-4 border border-[#FB7116] flex justify-between items-center flex-wrap gap-4 rounded-lg">

    <div class="flex items-center gap-6">
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

    <nav class="flex items-center justify-end gap-4 px-6 py-3">
        <a href="{{ route('tecnicoAssistenza.dashboard') }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
            Home
        </a>
        <a href="{{ route('logout') }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
            Logout
        </a>
    </nav>
</section>
