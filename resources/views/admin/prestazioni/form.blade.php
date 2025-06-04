@props(['prestazione' => null])

@php
    $isEdit = $prestazione !== null;
    $action = $isEdit
        ? route('admin.prestazioni.update', $prestazione->id)
        : route('admin.prestazioni.store');
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
            <label for="descrizione">Descrizione</label>
            <x-input
                name="descrizione"
                value="{{ old('descrizione', $prestazione->descrizione ?? '') }}"
                autofocus
            />
        </div>

        <div class="col-span-2">
            <label for="prescrizioni">Prescrizioni</label>
            <x-textarea
                name="prescrizioni"
                :value="old('prescrizioni', $prestazione->prescrizioni ?? '')"
            />
        </div>

        <div>
            <label for="medico_id">Medico</label>
            <select name="medico_id" id="medico_id" class="w-full border border-gray-300 rounded px-3 py-2">
                @foreach($medici as $medico)
                    <option value="{{ $medico->id }}" {{ old('medico_id', $prestazione->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                        {{ $medico->nome }} {{ $medico->cognome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="staff_id">Staff (opzionale)</label>
            <select name="staff_id" id="staff_id" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Nessuno --</option>
                @foreach($staff as $membro)
                    <option value="{{ $membro->id }}" {{ old('staff_id', $prestazione->staff_id ?? '') == $membro->id ? 'selected' : '' }}>
                        {{ $membro->nome }} {{ $membro->cognome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-2">
            <label for="fasce_container">Orari</label>
            <div id="fasce-container" class="space-y-4">
                <!-- Le fasce confermate verranno aggiunte qui -->
            </div>
            <button type="button" id="aggiungi-fascia-btn" class="mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded font-semibold">
                + Aggiungi Orario
            </button>
        </div>

        <!-- Template nascosto per nuova fascia -->
        <template id="template-fascia">
            <div class="p-4 border rounded bg-gray-50 grid grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block font-semibold text-gray-700">Giorno</label>
                    <select name="giorno[]" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Seleziona giorno --</option>
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        <option value="6">Sabato</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700">Inizio</label>
                    <input type="time" name="start_time[]" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700">Fine</label>
                    <input type="time" name="end_time[]" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="col-span-3 flex justify-end mt-2 gap-2">
                    <button type="button" class="conferma-fascia-btn px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">Conferma</button>
                    <button type="button" class="annulla-fascia-btn px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded font-semibold">Annulla</button>
                </div>
            </div>
        </template>

        <div class="col-span-2 flex justify-center gap-4 mt-6">
            <x-button type="button"
                onclick="window.location.href='{{ route('admin.prestazioni') }}'"
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('fasce-container');
        const btnAggiungi = document.getElementById('aggiungi-fascia-btn');
        const template = document.getElementById('template-fascia');

        let fasciaInCompilazione = false;

        btnAggiungi.addEventListener('click', function () {
            if (fasciaInCompilazione) return;

            const clone = template.content.cloneNode(true);
            const newCard = clone.querySelector('div');

            const startInput = newCard.querySelector('input[name="start_time[]"]');
            const endInput = newCard.querySelector('input[name="end_time[]"]');

            [startInput, endInput].forEach(input => {
                input.min = "08:00";
                input.max = "20:00";
                input.value = "";
            });

            const btnConferma = newCard.querySelector('.conferma-fascia-btn');
            btnConferma.addEventListener('click', function () {
                const giornoSelect = newCard.querySelector('select[name="giorno[]"]');
                const giorno = giornoSelect.value;
                const giornoText = giornoSelect.selectedOptions[0]?.text ?? '';
                const start = startInput.value;
                const end = endInput.value;

                if (!giorno || !start || !end) {
                    alert("Compila tutti i campi della fascia oraria.");
                    return;
                }

                const fasciaConfermata = document.createElement('div');
                fasciaConfermata.className = "p-4 border rounded bg-white shadow-sm grid grid-cols-4 gap-4 items-center";
                fasciaConfermata.innerHTML = `
                    <input type="hidden" name="giorno[]" value="${giorno}">
                    <input type="hidden" name="start_time[]" value="${start}">
                    <input type="hidden" name="end_time[]" value="${end}">
                    <div><strong>Giorno:</strong> ${giornoText}</div>
                    <div><strong>Inizio:</strong> ${start}</div>
                    <div><strong>Fine:</strong> ${end}</div>
                    <button type="button" class="rimuovi-fascia-btn px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">Rimuovi</button>
                `;

                fasciaConfermata.querySelector('.rimuovi-fascia-btn').addEventListener('click', function () {
                    fasciaConfermata.remove();
                });

                container.appendChild(fasciaConfermata);
                newCard.remove();
                fasciaInCompilazione = false;
                btnAggiungi.style.display = 'inline-block';
            });

            const btnAnnulla = newCard.querySelector('.annulla-fascia-btn');
            btnAnnulla.addEventListener('click', function () {
                newCard.remove();
                fasciaInCompilazione = false;
                btnAggiungi.style.display = 'inline-block';
            });

            container.appendChild(newCard);
            fasciaInCompilazione = true;
            btnAggiungi.style.display = 'none';
        });
    });
</script>
@endpush
