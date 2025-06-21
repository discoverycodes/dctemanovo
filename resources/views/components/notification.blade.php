@php
    $types = [
        'success' => ['Cor' => 'green', 'Ícone' => '✅'],
        'error' => ['Cor' => 'red', 'Ícone' => '❌'],
        'warning' => ['Cor' => 'yellow', 'Ícone' => '⚠️'],
        'info' => ['Cor' => 'blue', 'Ícone' => 'ℹ️'],
    ];

    $type = session('notify.type', 'info');
    $color = $types[$type]['Cor'] ?? 'blue';
    $icon = $types[$type]['Ícone'] ?? 'ℹ️';
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition
    class="fixed bottom-4 right-4 z-50 w-full max-w-sm bg-white border-l-4 border-{{ $color }}-500 text-slate-800 shadow-lg rounded-lg p-4"
>
    <div class="flex items-start justify-between">
        <div>
            <p class="font-semibold">{{ $icon }} {{ ucfirst($type) }}</p>
            <p class="text-sm mt-1">{{ session('notify.message') }}</p>
        </div>
        <button @click="show = false" class="ml-4 text-slate-400 hover:text-slate-600">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6.707 4.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 101.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586 6.707 4.293z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
