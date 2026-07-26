<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 text-gray-900">
        
        <!-- Left Main Column (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Balance Card -->
            <div class="rounded-3xl p-8 relative overflow-hidden text-white shadow-lg" style="background-color: #111827;">
                <!-- Abstract gradient decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="flex justify-between items-start mb-8 relative z-10">
                    <div>
                        <p class="text-gray-400 text-xs font-semibold tracking-widest mb-2 uppercase">Available Balance</p>
                        <h2 class="text-4xl sm:text-5xl font-bold tracking-tight text-white">Rp 2.450.000</h2>
                    </div>
                    <div class="bg-white/10 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 relative z-10">
                    <button class="text-white py-3.5 px-4 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all hover:brightness-110" style="background-color: #d28522;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Top Up
                    </button>
                    <button class="text-white py-3.5 px-4 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all border border-gray-600 hover:bg-gray-600" style="background-color: #374151;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Send Money
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="#" class="bg-white border border-gray-200 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-colors" style="background-color: #fff4eb;">
                        <svg class="w-6 h-6" style="color: #b1773a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">Pulsa</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-200 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center transition-colors dark:bg-blue-900/50">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">PLN</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-200 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center transition-colors dark:bg-red-900/50">
                        <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">Data</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-200 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center transition-colors dark:bg-indigo-900/50">
                        <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">PDAM</span>
                </a>
            </div>

            <!-- Finance Insights -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 -ml-1">Finance Insights</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-[20px] shadow-sm flex flex-col overflow-hidden group hover:shadow-md transition-all">
                        <div class="h-32 bg-gray-200 overflow-hidden relative">
                            <img src="{{ asset('images/market_news.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Market News">
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800">
                            <p class="text-[10px] font-bold text-orange-600 tracking-wider mb-1 uppercase">MARKET NEWS</p>
                            <p class="text-sm text-gray-800 dark:text-gray-200 font-bold leading-tight">IHSG diprediksi menguat pekan ini.</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-[20px] shadow-sm flex flex-col overflow-hidden group hover:shadow-md transition-all">
                        <div class="h-32 bg-gray-200 overflow-hidden relative">
                            <img src="{{ asset('images/new_feature.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="New Feature">
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800">
                            <p class="text-[10px] font-bold text-blue-600 tracking-wider mb-1 uppercase">NEW FEATURE</p>
                            <p class="text-sm text-gray-800 dark:text-gray-200 font-bold leading-tight">Kini bisa bayar PBB langsung dari aplikasi.</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-[20px] shadow-sm flex flex-col overflow-hidden group hover:shadow-md transition-all">
                        <div class="h-32 bg-gray-200 overflow-hidden relative">
                            <img src="{{ asset('images/savings.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Savings">
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-800">
                            <p class="text-[10px] font-bold text-gray-600 tracking-wider mb-1 uppercase">SAVINGS</p>
                            <p class="text-sm text-gray-800 dark:text-gray-200 font-bold leading-tight">Tips menabung cerdas untuk milenial.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Right Side Column (1/3 width) -->
        <div class="space-y-6">
            
            <!-- Recent History -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent History</h3>
                    <a href="#" class="font-semibold text-sm hover:underline" style="color: #b1773a;">See All</a>
                </div>
                
                <div class="space-y-6">
                    <!-- Item 1 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #fff4eb;">
                                <svg class="w-6 h-6" style="color: #b1773a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Pulsa Indosat</p>
                                <p class="text-[11px] text-gray-500">24 Oct 2023 • 14:20</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 dark:text-white text-sm">-Rp 50.000</p>
                            <span class="inline-block bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-widest mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Token PLN...</p>
                                <p class="text-[11px] text-gray-500">23 Oct 2023 • 09:15</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 dark:text-white text-sm">-Rp 200.000</p>
                            <span class="inline-block bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-widest mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #fff4eb;">
                                <svg class="w-6 h-6" style="color: #b1773a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Top Up - B...</p>
                                <p class="text-[11px] text-gray-500">22 Oct 2023 • 18:45</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-sm" style="color: #10b981;">+Rp 500.000</p>
                            <span class="inline-block bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-widest mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-red-50 dark:bg-red-900/50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Internet Bil...</p>
                                <p class="text-[11px] text-gray-500">21 Oct 2023 • 10:00</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 dark:text-white text-sm">-Rp 349.000</p>
                            <span class="inline-block bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-500 text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-widest mt-1">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promo Banner -->
            <div class="rounded-3xl p-6 text-white shadow-md relative overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/promo_banner.png') }}'); background-color: #d28522;">
                <!-- Gradient overlay to ensure text is readable -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#d28522]/90 to-[#b1773a]/50 mix-blend-multiply"></div>
                
                <div class="relative z-10">
                    <div class="inline-block bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-white/20">
                        Exclusive Offer
                    </div>
                    <h3 class="text-2xl font-bold mb-2 text-white">Get 10% Cashback</h3>
                    <p class="text-white/90 text-sm mb-4 max-w-[200px]">On all utility bill payments this weekend. T&C apply.</p>
                </div>
            </div>

        </div>
    </div>
    
    <style>
        /* Customize the layout slightly to match screenshot background */
        html:not(.dark) .fi-main {
            background-color: #fafafa !important;
        }
        /* Make the topbar title larger like in the screenshot */
        .fi-header-heading {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif !important;
            letter-spacing: -0.025em;
        }
    </style>
</x-filament-panels::page>
