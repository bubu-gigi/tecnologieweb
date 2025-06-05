<x-wrapper-navbar>
    <x-left-navbar>
        <x-link-navbar href="{{ route('home') }}">
            Home
        </x-link-navbar>
        <x-link-navbar href="{{ route('admin.dashboard') }}">
            Dashboard
        </x-link-navbar>
        <x-link-navbar href="{{ route('admin.departments.index') }}">
            Dipartimenti
        </x-link-navbar>
        <x-link-navbar href="{{ route('admin.services.index') }}">
            Prestazioni
        </x-link-navbar>
        <x-link-navbar href="{{ route('admin.users.index') }}">
            Utenti
        </x-link-navbar>
        <x-link-navbar href="#">
            Statistiche 
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


