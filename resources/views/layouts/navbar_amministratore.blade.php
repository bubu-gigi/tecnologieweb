<section class="bg-white px-8 py-4 border border-[#FB7116] flex justify-between items-center flex-wrap gap-4 rounded-lg">
    <div class="flex items-center gap-6">
        <a href="{{ route('amministratore.dashboard') }}" class="text-[#FB7116] hover:text-orange-600">
            Dashboard
        </a>
    </div>

    <nav class="flex items-center justify-end gap-4 px-6 py-3">
        <a href="/" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
            Home
        </a>
        <a href="{{ route('logout') }}" class="px-4 py-2 border-2 border-[#FB7116] text-[#FB7116] font-semibold rounded-md hover:bg-[#FB7116] hover:text-white transition">
            Logout
        </a>
    </nav>
</section>