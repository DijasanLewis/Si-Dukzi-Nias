<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pemenuhan Bukti Dukung ZI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Baris ini akan memuat seluruh komponen interaktif Anda --}}
                <livewire:dashboard-checklist />
            </div>
        </div>
    </div>
</x-app-layout>