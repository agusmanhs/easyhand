<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Main Column (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Balance Card -->
            <div class="bg-[#111827] rounded-3xl p-8 relative overflow-hidden text-white shadow-lg">
                <!-- Abstract gradient decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="flex justify-between items-start mb-8 relative z-10">
                    <div>
                        <p class="text-gray-400 text-xs font-semibold tracking-widest mb-2 uppercase">Available Balance</p>
                        <h2 class="text-4xl sm:text-5xl font-bold tracking-tight">Rp 2.450.000</h2>
                    </div>
                    <div class="bg-white/10 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 relative z-10">
                    <button class="bg-[#b1773a] hover:bg-[#9e6931] text-white py-3.5 px-4 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Top Up
                    </button>
                    <button class="bg-[#374151] hover:bg-[#4b5563] text-white py-3.5 px-4 rounded-xl font-semibold flex items-center justify-center gap-2 transition-all border border-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Send Money
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="#" class="bg-white border border-gray-100 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                        <svg class="w-6 h-6 text-[#b1773a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-sm">Pulsa</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-100 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-sm">PLN</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-100 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center group-hover:bg-red-100 transition-colors">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-sm">Data</span>
                </a>
                
                <a href="#" class="bg-white border border-gray-100 p-6 rounded-3xl flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-sm">PDAM</span>
                </a>
            </div>

            <!-- Finance Insights -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Finance Insights</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm h-48 flex flex-col justify-end relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-transparent"></div>
                        <p class="relative z-10 text-xs font-bold text-orange-600 tracking-wider mb-1">MARKET NEWS</p>
                        <p class="relative z-10 text-gray-800 font-semibold leading-tight">IHSG diprediksi menguat pekan ini.</p>
                    </div>
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm h-48 flex flex-col justify-end relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent"></div>
                        <p class="relative z-10 text-xs font-bold text-blue-600 tracking-wider mb-1">NEW FEATURE</p>
                        <p class="relative z-10 text-gray-800 font-semibold leading-tight">Kini bisa bayar PBB langsung dari aplikasi.</p>
                    </div>
                    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm h-48 flex flex-col justify-end relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent"></div>
                        <p class="relative z-10 text-xs font-bold text-green-600 tracking-wider mb-1">SAVINGS</p>
                        <p class="relative z-10 text-gray-800 font-semibold leading-tight">Tips menabung cerdas untuk milenial.</p>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Right Side Column (1/3 width) -->
        <div class="space-y-6">
            
            <!-- Recent History -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">Recent History</h3>
                    <a href="#" class="text-[#b1773a] font-semibold text-sm hover:underline">See All</a>
                </div>
                
                <div class="space-y-6">
                    <!-- Item 1 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#b1773a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Pulsa Indosat</p>
                                <p class="text-xs text-gray-500">24 Oct 2023 • 14:20</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm">-Rp 50.000</p>
                            <span class="inline-block bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Token PLN...</p>
                                <p class="text-xs text-gray-500">23 Oct 2023 • 09:15</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm">-Rp 200.000</p>
                            <span class="inline-block bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#b1773a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Top Up - B...</p>
                                <p class="text-xs text-gray-500">22 Oct 2023 • 18:45</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-600 text-sm">+Rp 500.000</p>
                            <span class="inline-block bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider mt-1">Success</span>
                        </div>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Internet Bil...</p>
                                <p class="text-xs text-gray-500">21 Oct 2023 • 10:00</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm">-Rp 349.000</p>
                            <span class="inline-block bg-yellow-100 text-yellow-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider mt-1">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promo Banner -->
            <div class="bg-[#b1773a] rounded-3xl p-6 text-white shadow-md relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="inline-block bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-white/20">
                    Exclusive Offer
                </div>
                <h3 class="text-2xl font-bold mb-2">Get 10% Cashback</h3>
                <p class="text-white/80 text-sm mb-4">On all utility bill payments this weekend. T&C apply.</p>
            </div>

        </div>
    </div>
    
    <style>
        /* Customize the layout slightly to match screenshot background */
        .fi-main {
            background-color: #fafafa !important;
        }
        /* Make the topbar title larger like in the screenshot */
        .fi-header-heading {
            font-size: 1.5rem !important;
            font-family: 'Playfair Display', serif;
            font-weight: 700 !important;
            color: #111827 !important;
        }
        /* Inject fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap');
    </style>
</x-filament-panels::page>
