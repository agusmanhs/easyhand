@php
    $currentRoute = request()->route()->getName();
@endphp

<div class="fixed bottom-0 left-0 z-50 w-full h-16 md:hidden transition-all duration-300" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-top: 1px solid rgba(0,0,0,0.05); box-shadow: 0 -4px 20px rgba(0,0,0,0.03);">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        
        <!-- Beranda -->
        <a href="{{ url('member') }}" class="inline-flex flex-col items-center justify-center px-5 group active:scale-95 transition-transform duration-200">
            <div class="p-1.5 rounded-full {{ str_contains($currentRoute, 'pages.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'pages.dashboard') ? 'heroicon-s-home' : 'heroicon-o-home' }}" class="w-6 h-6" />
            </div>
            <span class="text-[10px] mt-0.5 {{ str_contains($currentRoute, 'pages.dashboard') ? 'text-primary-600 font-bold' : 'text-gray-500 group-hover:text-primary-600' }}">Beranda</span>
        </a>

        <!-- Riwayat -->
        <a href="{{ url('member/transactions') }}" class="inline-flex flex-col items-center justify-center px-5 group active:scale-95 transition-transform duration-200">
            <div class="p-1.5 rounded-full {{ str_contains($currentRoute, 'transactions') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'transactions') ? 'heroicon-s-clock' : 'heroicon-o-clock' }}" class="w-6 h-6" />
            </div>
            <span class="text-[10px] mt-0.5 {{ str_contains($currentRoute, 'transactions') ? 'text-primary-600 font-bold' : 'text-gray-500 group-hover:text-primary-600' }}">Riwayat</span>
        </a>

        <!-- Langganan -->
        <a href="{{ url('member/auto-pays') }}" class="inline-flex flex-col items-center justify-center px-5 group active:scale-95 transition-transform duration-200">
            <div class="p-1.5 rounded-full {{ str_contains($currentRoute, 'auto-pays') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'auto-pays') ? 'heroicon-s-arrow-path-rounded-square' : 'heroicon-o-arrow-path-rounded-square' }}" class="w-6 h-6" />
            </div>
            <span class="text-[10px] mt-0.5 {{ str_contains($currentRoute, 'auto-pays') ? 'text-primary-600 font-bold' : 'text-gray-500 group-hover:text-primary-600' }}">Langganan</span>
        </a>

        <!-- Deposit -->
        <a href="{{ url('member/deposits') }}" class="inline-flex flex-col items-center justify-center px-5 group active:scale-95 transition-transform duration-200">
            <div class="p-1.5 rounded-full {{ str_contains($currentRoute, 'deposits') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }} transition-colors duration-200">
                <x-filament::icon icon="{{ str_contains($currentRoute, 'deposits') ? 'heroicon-s-wallet' : 'heroicon-o-wallet' }}" class="w-6 h-6" />
            </div>
            <span class="text-[10px] mt-0.5 {{ str_contains($currentRoute, 'deposits') ? 'text-primary-600 font-bold' : 'text-gray-500 group-hover:text-primary-600' }}">Deposit</span>
        </a>

    </div>
</div>
