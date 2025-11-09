@extends('layouts.layout_amministratore')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        @php
            $isEdit = isset($prodotto);
        @endphp

        <h1 class="text-3xl font-bold text-[#FB7116] mb-6 text-center">
            {{ $isEdit ? 'Modifica prodotto' : 'Nuovo prodotto' }}
        </h1>

        <form 
            action="{{ $isEdit 
                ? route('amministratore.prodotto.update', $prodotto->id) 
                : route('amministratore.prodotto.store') }}"
            method="POST"
            enctype="multipart/form-data" 
            class="bg-white shadow-lg rounded-lg p-6"
        >
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="mb-5">
                <label for="name" class="block text-gray-700 font-semibold mb-2">
                    Nome del prodotto
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name', $prodotto->name ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="descrizione" class="block text-gray-700 font-semibold mb-2">
                    Descrizione
                </label>
                <textarea 
                    id="descrizione" 
                    name="descrizione"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('descrizione', $prodotto->descrizione ?? '') }}</textarea>
                @error('descrizione')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="note_uso" class="block text-gray-700 font-semibold mb-2">
                    Note d'uso
                </label>
                <textarea 
                    id="note_uso" 
                    name="note_uso"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('note_uso', $prodotto->note_uso ?? '') }}</textarea>
                @error('note_uso')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="mod_installazione" class="block text-gray-700 font-semibold mb-2">
                    Modalità di installazione
                </label>
                <textarea 
                    id="mod_installazione" 
                    name="mod_installazione"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >{{ old('mod_installazione', $prodotto->mod_installazione ?? '') }}</textarea>
                @error('mod_installazione')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="immagine" class="block text-gray-700 font-semibold mb-2">
                    Immagine del prodotto
                </label>

                @if($isEdit && !empty($prodotto->image_name))
                    <div id="current-image" class="mb-3 relative inline-block w-32 h-32">
                        <img src="{{ asset('storage/prodotti/' . $prodotto->image_name) }}" 
                            alt="Immagine prodotto" 
                            class="w-full h-full object-cover rounded-lg shadow">

                        <button type="button" id="delete-image-btn" 
                                class="absolute top-1 right-1 bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs cursor-pointer z-10">
                            ✕
                        </button>
                    </div>
                @endif


                <input 
                    type="file" 
                    id="image" 
                    name="image"
                    accept=".jpeg,.jpg,.png"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
                >
                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-5">
                <label for="staff" class="block text-sm font-medium text-gray-700 mb-1">
                    Seleziona membro dello staff
                </label>
                <select 
                    name="staff_id" 
                    id="staff" 
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400"
                >
                    <option value="">-- Seleziona membro --</option>
                    @foreach($staff as $membro)
                        <option 
                            value="{{ $membro->id }}" 
                            {{ old('staff_id', $prodotto->staff_id ?? '') == $membro->id ? 'selected' : '' }}
                        >
                            {{ $membro->nome }}
                        </option>
                    @endforeach
                </select>
                @error('staff_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('amministratore.gestioneProdotti') }}"
                   class="bg-gray-200 text-gray-700 cursor-pointer font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-300 transition-all duration-200">
                    Annulla
                </a>

                <button 
                    type="submit"
                    class="bg-[#FB7116] text-white cursor-pointer font-semibold px-4 py-2 rounded-lg shadow hover:bg-[#e35f0f] transition-all duration-200"
                >
                    {{ $isEdit ? 'Salva modifiche' : 'Crea prodotto' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
   $(document).ready(function() {
    $('#delete-image-btn').click(function() {
        if(confirm('Sei sicuro di voler eliminare l\'immagine?')) {
            $.ajax({
                url: "{{ route('amministratore.prodotto.deleteImage', $prodotto->id) }}",
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.success) {
                        $('#current-image').remove();
                        alert('Immagine eliminata con successo.');
                    } else {
                        alert('Errore durante l\'eliminazione dell\'immagine.');
                    }
                },
                error: function() {
                    alert('Errore durante l\'eliminazione dell\'immagine.');
                }
            });
        }
    });
});
</script>
@endpush
@endsection
