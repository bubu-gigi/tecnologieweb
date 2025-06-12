@props(['prestazione' => null, 'orari' => []])
@php
    $isEdit = $prestazione !== null;
    $action = $isEdit
        ? route('admin.services.update', $prestazione->id)
        : route('admin.services.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

<x-card class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-indigo-700 mb-6">
        {{ $isEdit ? 'Modifica Prestazione' : 'Nuova Prestazione' }}
    </h3>

    <form method="POST" action="{{ $action }}" class="grid grid-cols-2 gap-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="col-span-2">
            <x-input
                label="Descrizione"
                name="descrizione"
                value="{{ old('descrizione', $prestazione->descrizione ?? '') }}"
                autofocus
            />
        </div>

        <div class="col-span-2">
            <x-textarea
                label="Prescrizioni"
                name="prescrizioni"
                :value="old('prescrizioni', $prestazione->prescrizioni ?? '')"
            />
        </div>

        <div>
            <x-select name="medico_id" label="Medico">
                @foreach($medici as $medico)
                    <option value="{{ $medico->id }}" {{ old('medico_id', $prestazione->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                        {{ $medico->nome }} {{ $medico->cognome }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div>
            <x-select name="staff_id" label="Staff (opzionale)">
                <option value="">-- Nessuno --</option>
                @foreach($staff as $membro)
                    <option value="{{ $membro->id }}" {{ old('staff_id', $prestazione->staff_id ?? '') == $membro->id ? 'selected' : '' }}>
                        {{ $membro->nome }} {{ $membro->cognome }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="col-span-2">
            <x-label for="orari">Orari</x-label>

            <div id= "orari" class="flex items-center gap-4 mb-4">
                <x-select id="giorno-select" name="giorno_sel">
                    <option value="">Giorno</option>
                    @foreach ([1 => 'Lunedì', 2 => 'Martedì', 3 => 'Mercoledì', 4 => 'Giovedì', 5 => 'Venerdì', 6 => 'Sabato'] as $num => $nome)
                        <option value="{{ $num }}">{{ $nome }}</option>
                    @endforeach
                </x-select>

                <x-select id="start-select" name="start_sel">
                    <option value="">Inizio</option>
                    @for ($h = 8; $h <= 19; $h++)
                        <option value="{{ $h }}">{{ $h }}:00</option>
                    @endfor
                </x-select>

                <x-select id="end-select" name="end_sel">
                    <option value="">Fine</option>
                    @for ($h = 9; $h <= 20; $h++)
                        <option value="{{ $h }}">{{ $h }}:00</option>
                    @endfor
                </x-select>

                <button type="button" id="aggiungi-orario" class="px-3 py-1 bg-indigo-600 text-white rounded" style="margin-top: -16px;">Aggiungi</button>
            </div>

            <div id="orari-container" class="space-y-4"></div>
            <input type="hidden" name="orari" id="orari-json" />
        </div>

        <div class="col-span-2 flex justify-center gap-4 mt-6">
            <x-button type="button"
                onclick="window.location.href='{{ route('admin.services.index') }}'"
                class="w-1/2 bg-gray-400 hover:bg-gray-500 text-white font-semibold">
                Torna indietro
            </x-button>
            <x-button type="submit"
                class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">
                {{ $isEdit ? 'Aggiorna' : 'Crea' }}
            </x-button>
        </div>
    </form>
</x-card>

<script id="orari-data" type="application/json">
    {!! json_encode($orari) !!}
</script>

@push('scripts')
<script>
$(function () {
    const giorni = {
        1: 'Lunedì',
        2: 'Martedì',
        3: 'Mercoledì',
        4: 'Giovedì',
        5: 'Venerdì',
        6: 'Sabato'
    };

    const orari = [];

    const iniziali = JSON.parse(document.getElementById("orari-data").textContent || '{}');
    Object.entries(iniziali).forEach(([giorno, fasce]) => {
        fasce.forEach(fascia => {
            const [start, end] = fascia.split('-').map(Number);
            orari.push({ giorno: parseInt(giorno), start, end });
        });
    });

    renderOrari();

    $('#aggiungi-orario').on('click', () => {
        const giorno = parseInt($('#giorno-select').val());
        const start = parseInt($('#start-select').val());
        const end = parseInt($('#end-select').val());

        if ([giorno, start, end].some(x => isNaN(x))) {
            alert("Compila tutti i campi.");
            return;
        }

        if (start >= end) {
            alert("L'orario di fine deve essere maggiore di quello di inizio.");
            return;
        }

        orari.push({ giorno, start, end });
        renderOrari();

        $('#giorno-select').val('');
        $('#start-select').val('');
        $('#end-select').val('');
    });

    function renderOrari() {
        const $container = $('#orari-container').empty();

        orari.forEach((entry, index) => {
            const $row = $(`
                <div class="p-4 border rounded bg-white grid grid-cols-4 gap-4 items-center">
                    <div><strong>Giorno:</strong> ${giorni[entry.giorno] || 'N/A'}</div>
                    <div><strong>Inizio:</strong> ${entry.start}:00</div>
                    <div><strong>Fine:</strong> ${entry.end}:00</div>
                    <button type="button" class="rimuovi-orario bg-red-500 text-white rounded px-2 py-1" data-index="${index}">Rimuovi</button>
                </div>
            `);

            $row.find('.rimuovi-orario').on('click', function () {
                orari.splice(index, 1);
                renderOrari();
            });

            $container.append($row);
        });

        $('#orari-json').val(JSON.stringify(orari));
    }
});
</script>
@endpush
