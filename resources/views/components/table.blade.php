@props([
    'headers' => []
])

<div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200 bg-white">
        <thead class="bg-indigo-100">
            <tr>
                @foreach($headers as $header)
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
            {{ $slot }}
        </tbody>
    </table>
</div>
