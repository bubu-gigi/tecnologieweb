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

            </div>
            <button type="button" id="aggiungi-fascia-btn" class="mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded font-semibold cursor-pointer">
                + Aggiungi Orario
            </button>
        </div>

        <template id="template-fascia">
            <div class="p-4 border rounded bg-gray-50 grid grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-gray-700">Giorno</label>
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
                    <label class="block text-gray-700">Inizio</label>
                    <select name="start_time[]" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Ora inizio --</option>
                        @for ($hour = 8; $hour <= 20; $hour++)
                            <option value="{{ $hour }}">
                                {{ $hour }}:00
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Fine</label>
                    <select name="end_time[]" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">-- Ora fine --</option>
                        @for ($hour = 9; $hour <= 20; $hour++)
                            <option value="{{ $hour }}">
                                {{ $hour }}:00
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-span-3 flex justify-end mt-2 gap-2">
                    <button type="button" class="conferma-fascia-btn px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">Conferma</button>
                    <button type="button" class="annulla-fascia-btn px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded font-semibold">Annulla</button>
                </div>
            </div>
        </template>

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
        const $container = $('#fasce-container');
        const $btnAggiungi = $('#aggiungi-fascia-btn');
        const $template = $('#template-fascia');

        let fasciaInCompilazione = false;

        $btnAggiungi.on('click', function () {
            if (fasciaInCompilazione) return;

            const $clone = $($template.html());
            const $startInput = $clone.find('select[name="start_time[]"]');
            const $endInput = $clone.find('select[name="end_time[]"]');

            $startInput.val('');
            $endInput.val('');

            $clone.find('.conferma-fascia-btn').on('click', function () {
                const $giornoSelect = $clone.find('select[name="giorno[]"]');
                const giorno = $giornoSelect.val();
                const giornoText = $giornoSelect.find('option:selected').text();
                const start = $startInput.val();
                const end = $endInput.val();

                if (!giorno || !start || !end) {
                    alert("Compila tutti i campi della fascia oraria.");
                    return;
                }

                const $fascia = $(`
                    <div class="p-4 border rounded bg-white shadow-sm grid grid-cols-4 gap-4 items-center">
                        <input type="hidden" name="giorno[]" value="${giorno}">
                        <input type="hidden" name="start_time[]" value="${start}">
                        <input type="hidden" name="end_time[]" value="${end}">
                        <div><strong>Giorno:</strong> ${giornoText}</div>
                        <div><strong>Inizio:</strong> ${start}</div>
                        <div><strong>Fine:</strong> ${end}</div>
                        <button type="button" class="rimuovi-fascia-btn px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">Rimuovi</button>
                    </div>
                `);

                $fascia.find('.rimuovi-fascia-btn').on('click', function () {
                    $fascia.remove();
                });

                $container.append($fascia);
                $clone.remove();
                fasciaInCompilazione = false;
                $btnAggiungi.show();
            });

            $clone.find('.annulla-fascia-btn').on('click', function () {
                $clone.remove();
                fasciaInCompilazione = false;
                $btnAggiungi.show();
            });

            $container.append($clone);
            fasciaInCompilazione = true;
            $btnAggiungi.hide();
        });

        const orariRaw = document.getElementById("orari-data").textContent;
        const orariJson = JSON.parse(orariRaw);

        Object.entries(orariJson).forEach(([giorno, fasce]) => {
            fasce.forEach(fascia => {
                const [start, end] = fascia.split("-");
                const giornoText = {
                    "1": "Lunedì",
                    "2": "Martedì",
                    "3": "Mercoledì",
                    "4": "Giovedì",
                    "5": "Venerdì",
                    "6": "Sabato"
                }[giorno];

                const $fascia = $(`
                    <div class="p-4 border rounded bg-white shadow-sm grid grid-cols-4 gap-4 items-center">
                        <input type="hidden" name="giorno[]" value="${giorno}">
                        <input type="hidden" name="start_time[]" value="${start}:00">
                        <input type="hidden" name="end_time[]" value="${end}:00">
                        <div><strong>Giorno:</strong> ${giornoText}</div>
                        <div><strong>Inizio:</strong> ${start}:00</div>
                        <div><strong>Fine:</strong> ${end}:00</div>
                        <button type="button" class="rimuovi-fascia-btn px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">Rimuovi</button>
                    </div>
                `);
                console.log(fascia);

                $fascia.find('.rimuovi-fascia-btn').on('click', function () {
                    $fascia.remove();
                });

                $container.append($fascia);
            });
        });
    });
</script>
@endpush
