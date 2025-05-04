@extends('layouts.layout_customer')

@section('title', 'Area Prestazioni')

@section('content')
<div class="user-area-container">
    <section class="search-prestazioni">
        <h3>Ricerca Prestazioni</h3>
        {!! html()->form('GET', route('customers.prestazioni.search'))->open() !!}
            <label for="prestazione">Ricerca per prestazione:</label>
            <input type="text" name="prestazione" placeholder="es. Visita, Radiografia o R*">

            <button type="submit" class="btn">Cerca</button>
        {{ html()->form()->close() }}
        {!! html()->form('GET', route('customers.prestazioni.search'))->open() !!}
        <form method="GET">
            <label for="dipartimento">Ricerca per dipartimento:</label>
            <input type="text" name="dipartimento" placeholder="es. Cardiologia o C*">
            <button type="submit" class="btn">Cerca</button>
        </form>
        {{ html()->form()->close() }}
    </section>

    @if(isset($prestazioni) && count($prestazioni) > 0)
    <section class="grid-prestazioni">
        @foreach($prestazioni as $prestazione)
            <div class="card-prestazione">
                <h4>{{ $prestazione->descrizione }}</h4>
                <p><strong>Dipartimento:</strong> {{ $prestazione->medico->dipartimento->nome ?? 'N/A' }}</p>
                <p><strong>Medico:</strong> {{ $prestazione->medico->nome }} {{ $prestazione->medico->cognome }}</p>
                <p><strong>Giorni:</strong> {{ $prestazione->giorni ?? 'Non specificati' }}</p>
                <p><strong>Orari:</strong> {{ $prestazione->orari ?? 'Non specificati' }}</p>
                <a class="btn-sm btn-prenota" data-id="{{ $prestazione->id }}">Prenota</a>
                <div id="user-data" data-user-id="{{ auth()->id() }}"></div>
            </div>
        @endforeach
    </section>
    @endif

    <section class="note">
        <p>Ricorda: quando richiedi una prestazione, non devi specificare data e ora. Lo staff assegnerà il primo slot disponibile e te lo comunicherà direttamente.</p>
    </section>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-prenota').on('click', function (e) {
            e.preventDefault();
            console.log('jQuery è attivo!');
            const prestazioneId = $(this).data('id');
            const userId = $('#user-data').data('user-id');

            $.ajax({
                url: "{{ route('reservations.store') }}",
                type: 'POST',
                data: JSON.stringify({
                    user_id: userId,
                    prestazione_id: prestazioneId,
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert('Prenotazione effettuata con successo!');
                },
                error: function (error) {
                    console.error('Errore durante la prenotazione:', error.responseText);
                    alert('Errore durante la prenotazione.');
                }
            });
        });
    });
</script>
@endpush
