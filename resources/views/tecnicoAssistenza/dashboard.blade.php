@extends('layouts.layout_tecnicoAssistenza')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

    <div class="max-w-4xl mx-auto mb-6">
        <h1 class="text-3xl font-bold text-[#FB7116] mb-4">Catalogo Prodotti</h1>
        <form id="searchForm" class="flex gap-2">
            <input
                type="text"
                name="q"
                id="searchInput"
                placeholder="Cerca per descrizione (usa * come wildcard finale)"
                class="flex-grow border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FB7116] focus:border-[#FB7116]"
            />
            <button
                type="submit"
                class="cursor-pointer bg-[#FB7116] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors"
            >
                Cerca
            </button>
        </form>
    </div>

    <div id="prodottiContainer" class="max-w-4xl mx-auto grid grid-cols-3 gap-6">
        <!-- Le card dei prodotti saranno generate qui -->
        <div id="placeholder" class="col-span-full text-center text-gray-500">
            Inserisci un termine di ricerca e premi "Cerca".
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
$('#searchForm').on('submit', function(e){
    e.preventDefault();
    let query = $('#searchInput').val().replace('*','');
    caricaProdotti(query);
});

function caricaProdotti(query = '') {
    $.ajax({
        url: "{{ route('prodotti.search') }}",
        type: 'GET',
        data: { q: query },
        success: function(response) {
            $('#prodottiContainer').html(''); 

            if(response.prodotti.length > 0){
                response.prodotti.forEach(function(prodotto){
                    let descrizioneTroncata = prodotto.descrizione.length > 100 
                        ? prodotto.descrizione.substring(0, 100) + '...' 
                        : prodotto.descrizione;

                    $('#prodottiContainer').append(`
                        <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 mb-2">${prodotto.name}</h2>
                                <p class="text-gray-700 mb-4">${descrizioneTroncata}</p>
                            </div>
                            <button 
                                onclick="window.location.href='/prodotti/${prodotto.id}'"
                                class="cursor-pointer mt-auto bg-[#FB7116] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors"
                            >
                                Vedi dettagli
                            </button>
                        </div>
                    `);
                });
            } else {
                $('#prodottiContainer').html(`
                    <div class="col-span-full text-center text-gray-500">
                        Nessun prodotto trovato.
                    </div>
                `);
            }
        },
        error: function() {
            alert('Errore durante la ricerca.');
        }
    });
}


});
</script>
@endpush
