@php
    $currentRoute = request()->route()->getName();
@endphp

<div class="fixed bottom-0 left-0 z-50 w-full md:hidden transition-all duration-300" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-top: 1px solid rgba(0,0,0,0.05); box-shadow: 0 -4px 20px rgba(0,0,0,0.03); padding-bottom: env(safe-area-inset-bottom);">
    <div class="flex items-center justify-around h-[64px] max-w-lg mx-auto">
        
        <!-- Beranda -->
        <a href="{{ url('member') }}" class="flex flex-col items-center justify-center w-full h-full group active:scale-95 transition-transform duration-200">
            <div class="mb-1 {{ str_contains($currentRoute, 'pages.dashboard') ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'pages.dashboard') ? 'heroicon-s-home' : 'heroicon-o-home' }}" class="w-6 h-6 mx-auto" />
            </div>
            <span class="text-[10px] leading-none {{ str_contains($currentRoute, 'pages.dashboard') ? 'text-primary-600 font-bold' : 'text-gray-400 group-hover:text-primary-600 font-medium' }}">Beranda</span>
        </a>

        <!-- Riwayat -->
        <a href="{{ url('member/transactions') }}" class="flex flex-col items-center justify-center w-full h-full group active:scale-95 transition-transform duration-200">
            <div class="mb-1 {{ str_contains($currentRoute, 'transactions') ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'transactions') ? 'heroicon-s-clock' : 'heroicon-o-clock' }}" class="w-6 h-6 mx-auto" />
            </div>
            <span class="text-[10px] leading-none {{ str_contains($currentRoute, 'transactions') ? 'text-primary-600 font-bold' : 'text-gray-400 group-hover:text-primary-600 font-medium' }}">Riwayat</span>
        </a>

        <!-- Langganan -->
        <a href="{{ url('member/auto-pays') }}" class="flex flex-col items-center justify-center w-full h-full group active:scale-95 transition-transform duration-200">
            <div class="mb-1 {{ str_contains($currentRoute, 'auto-pays') ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'auto-pays') ? 'heroicon-s-arrow-path-rounded-square' : 'heroicon-o-arrow-path-rounded-square' }}" class="w-6 h-6 mx-auto" />
            </div>
            <span class="text-[10px] leading-none {{ str_contains($currentRoute, 'auto-pays') ? 'text-primary-600 font-bold' : 'text-gray-400 group-hover:text-primary-600 font-medium' }}">Langganan</span>
        </a>

        <!-- Deposit -->
        <a href="{{ url('member/deposits') }}" class="flex flex-col items-center justify-center w-full h-full group active:scale-95 transition-transform duration-200">
            <div class="mb-1 {{ str_contains($currentRoute, 'deposits') ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'deposits') ? 'heroicon-s-wallet' : 'heroicon-o-wallet' }}" class="w-6 h-6 mx-auto" />
            </div>
            <span class="text-[10px] leading-none {{ str_contains($currentRoute, 'deposits') ? 'text-primary-600 font-bold' : 'text-gray-400 group-hover:text-primary-600 font-medium' }}">Deposit</span>
        </a>

    </div>
</div>
