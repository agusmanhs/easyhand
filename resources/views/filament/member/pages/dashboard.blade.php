<x-filament-panels::page>
    <!-- Stitch Dependencies -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }
        /* Hide Filament's default header since the stitch layout has its own title flow */
        .fi-header {
            display: none !important;
        }
        .fi-main {
            background-color: #f9f9ff !important;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            important: '.stitch-container',
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed-dim": "#ffb77d",
                        "on-secondary-fixed": "#121c2a",
                        "tertiary-container": "#737576",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#141b2b",
                        "on-primary-fixed-variant": "#6e3900",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#dce2f7",
                        "primary": "#8d4b00",
                        "background": "#f9f9ff",
                        "on-surface-variant": "#554336",
                        "tertiary-fixed-dim": "#c5c7c8",
                        "on-secondary-container": "#596374",
                        "on-error": "#ffffff",
                        "surface-container": "#e9edff",
                        "on-background": "#141b2b",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#bdc7db",
                        "surface-dim": "#d3daef",
                        "on-primary-container": "#fffbff",
                        "surface-bright": "#f9f9ff",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "inverse-primary": "#ffb77d",
                        "tertiary-fixed": "#e1e3e4",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#904d00",
                        "secondary": "#555f70",
                        "on-tertiary-fixed-variant": "#454748",
                        "primary-fixed": "#ffdcc3",
                        "outline": "#887364",
                        "surface": "#f9f9ff",
                        "surface-container-high": "#e1e8fd",
                        "secondary-fixed": "#d9e3f7",
                        "surface-container-low": "#f1f3ff",
                        "on-tertiary-container": "#fcfdfe",
                        "on-secondary-fixed-variant": "#3d4757",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#2f1500",
                        "primary-container": "#b15f00",
                        "surface-variant": "#dce2f7",
                        "inverse-surface": "#293040",
                        "inverse-on-surface": "#edf0ff",
                        "tertiary": "#5a5c5d",
                        "on-tertiary-fixed": "#191c1d",
                        "outline-variant": "#dbc2b0",
                        "secondary-container": "#d6e0f4",
                        "brand-orange": "#D97706"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1280px",
                        "xl": "32px",
                        "md": "16px",
                        "xxl": "48px",
                        "gutter": "24px",
                        "xs": "4px",
                        "sm": "8px",
                        "base": "4px",
                        "lg": "24px"
                    },
                    "fontFamily": {
                        "button-text": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Inter"],
                        "label-caps": ["JetBrains Mono"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "button-text": ["15px", {"lineHeight": "20px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>

    <!-- Stitch Dashboard Canvas -->
    <div class="stitch-container text-on-surface font-body-md w-full max-w-screen-2xl mx-auto pb-20">
        
        <div class="mb-lg">
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-body-sm text-on-surface-variant">Manage your finances with speed and precision.</p>
        </div>

        <!-- Dashboard Bento Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
            <!-- Wallet Balance Card (Main Highlight) -->
            <section class="lg:col-span-8 flex flex-col gap-lg">
                <div class="relative overflow-hidden p-xxl rounded-[32px] bg-[#111827] text-white shadow-xl min-h-[220px] flex flex-col justify-between group">
                    <div class="relative z-10 flex justify-between items-start">
                        <div>
                            <p class="font-label-caps text-label-caps text-surface-container-highest opacity-70">AVAILABLE BALANCE</p>
                            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg mt-xs">{{ 'Rp ' . number_format(auth()->user()->saldo, 0, ',', '.') }}</h2>
                        </div>
                        <div class="bg-white/10 p-sm rounded-xl backdrop-blur-md">
                            <span class="material-symbols-outlined text-[32px]">payments</span>
                        </div>
                    </div>
                    <div class="relative z-10 flex gap-md mt-xl">
                        <a href="{{ url('member/deposits/create') }}" class="flex-1 py-md bg-brand-orange text-white rounded-xl font-button-text text-button-text flex items-center justify-center gap-sm hover:brightness-110 active:scale-95 transition-all">
                            <span class="material-symbols-outlined">add_circle</span>
                            Top Up
                        </a>
                        <button class="flex-1 py-md bg-white/20 text-white rounded-xl font-button-text text-button-text flex items-center justify-center gap-sm hover:bg-white/30 active:scale-95 transition-all backdrop-blur-sm border border-white/20">
                            <span class="material-symbols-outlined">send</span>
                            Send Money
                        </button>
                    </div>
                </div>

                @php
                    $excludePrepaid = ['Aktivasi Perdana', 'Aktivasi Voucher', 'Masa Aktif', 'Paket SMS & Telpon'];
                    $prepaidCategories = \App\Models\Product::where('category', '!=', 'Pascabayar')
                        ->whereNotIn('category', $excludePrepaid)
                        ->select('category')
                        ->distinct()
                        ->pluck('category');

                    $postpaidBrands = \App\Models\Product::where('category', 'Pascabayar')
                        ->select('brand')
                        ->distinct()
                        ->pluck('brand');

                    $getIconInfo = function($name) {
                        $nameLower = strtolower($name);
                        
                        if (str_contains($nameLower, 'pulsa')) return ['icon' => 'smartphone', 'color' => 'primary', 'bg' => 'primary-container/30'];
                        if (str_contains($nameLower, 'data')) return ['icon' => 'wifi', 'color' => 'tertiary', 'bg' => 'tertiary-container/30'];
                        if (str_contains($nameLower, 'pln')) return ['icon' => 'bolt', 'color' => 'secondary', 'bg' => 'secondary-container/30'];
                        if (str_contains($nameLower, 'game')) return ['icon' => 'sports_esports', 'color' => 'purple-600', 'bg' => 'purple-100'];
                        if (str_contains($nameLower, 'e-money') || str_contains($nameLower, 'ewallet')) return ['icon' => 'account_balance_wallet', 'color' => 'blue-600', 'bg' => 'blue-100'];
                        if (str_contains($nameLower, 'gas')) return ['icon' => 'local_fire_department', 'color' => 'orange-600', 'bg' => 'orange-100'];
                        if (str_contains($nameLower, 'streaming') || str_contains($nameLower, 'tv')) return ['icon' => 'live_tv', 'color' => 'red-600', 'bg' => 'red-100'];
                        if (str_contains($nameLower, 'voucher')) return ['icon' => 'confirmation_number', 'color' => 'yellow-600', 'bg' => 'yellow-100'];
                        
                        if (str_contains($nameLower, 'pdam')) return ['icon' => 'water_drop', 'color' => 'blue-600', 'bg' => 'blue-100'];
                        if (str_contains($nameLower, 'bpjs')) return ['icon' => 'health_and_safety', 'color' => 'green-600', 'bg' => 'green-100'];
                        if (str_contains($nameLower, 'internet') || str_contains($nameLower, 'wifi')) return ['icon' => 'router', 'color' => 'orange-600', 'bg' => 'orange-100'];
                        if (str_contains($nameLower, 'hp') || str_contains($nameLower, 'pasca')) return ['icon' => 'phone_android', 'color' => 'gray-700', 'bg' => 'gray-200'];

                        return ['icon' => 'storefront', 'color' => 'brand-orange', 'bg' => 'orange-50'];
                    };
                @endphp

                <!-- Prabayar Section -->
                <div class="mb-sm flex items-center justify-between">
                    <h3 class="font-headline-sm text-body-lg font-bold text-on-surface">Prabayar (Isi Ulang)</h3>
                </div>
                <div class="grid grid-cols-4 gap-md mb-lg">
                    @foreach($prepaidCategories as $category)
                        @php $style = $getIconInfo($category); @endphp
                        <a href="{{ url('/member/purchase-product?type=prepaid&filter=' . urlencode($category)) }}" class="flex flex-col items-center justify-center p-sm bg-white dark:bg-gray-900 rounded-2xl border border-outline-variant/30 dark:border-white/10 hover:border-{{ explode('-', $style['color'])[0] }}-400 hover:shadow-md transition-all cursor-pointer group active:scale-95 text-center">
                            <div class="w-10 h-10 rounded-full bg-{{ $style['bg'] }} flex items-center justify-center mb-sm group-hover:brightness-95 transition-colors">
                                <span class="material-symbols-outlined text-{{ $style['color'] }} text-[20px]">{{ $style['icon'] }}</span>
                            </div>
                            <span class="text-[10px] font-bold text-on-surface line-clamp-2 leading-tight">{{ $category }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- Pascabayar Section -->
                <div class="mb-sm flex items-center justify-between">
                    <h3 class="font-headline-sm text-body-lg font-bold text-on-surface">Pascabayar (Tagihan)</h3>
                </div>
                <div class="grid grid-cols-4 gap-md mb-lg">
                    @foreach($postpaidBrands as $brand)
                        @php $style = $getIconInfo($brand); @endphp
                        <a href="{{ url('/member/purchase-product?type=postpaid&filter=' . urlencode($brand)) }}" class="flex flex-col items-center justify-center p-sm bg-white dark:bg-gray-900 rounded-2xl border border-outline-variant/30 dark:border-white/10 hover:border-{{ explode('-', $style['color'])[0] }}-400 hover:shadow-md transition-all cursor-pointer group active:scale-95 text-center">
                            <div class="w-10 h-10 rounded-full bg-{{ $style['bg'] }} flex items-center justify-center mb-sm group-hover:brightness-95 transition-colors">
                                <span class="material-symbols-outlined text-{{ $style['color'] }} text-[20px]">{{ $style['icon'] }}</span>
                            </div>
                            <span class="text-[10px] font-bold text-on-surface line-clamp-2 leading-tight">{{ ucwords(strtolower($brand)) }}</span>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Recent Transactions (Sidebar Layout on Desktop) -->
            <aside class="lg:col-span-4 flex flex-col gap-lg">
                <div class="bg-white dark:bg-gray-900 p-lg rounded-[24px] border border-outline-variant/30 dark:border-white/10 shadow-sm flex flex-col h-full max-h-[500px]">
                    <div class="flex justify-between items-center mb-lg">
                        <h3 class="font-headline-md text-headline-md">Recent History</h3>
                        <a class="text-primary font-button-text text-button-text hover:underline" href="#">See All</a>
                    </div>
                    @php
                        $recentHistory = \App\Models\Transaction::where('user_id', auth()->id())->latest()->take(4)->get();
                    @endphp
                    <div class="space-y-sm">
                        @forelse($recentHistory as $trx)
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center flex-shrink-0">
                                @if(str_contains(strtolower($trx->buyer_sku_code), 'pln'))
                                    <span class="material-symbols-outlined text-secondary">bolt</span>
                                @elseif(str_contains(strtolower($trx->buyer_sku_code), 'data'))
                                    <span class="material-symbols-outlined text-tertiary">wifi</span>
                                @else
                                    <span class="material-symbols-outlined text-primary">smartphone</span>
                                @endif
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="font-semibold text-body-sm truncate">{{ $trx->buyer_sku_code }} - {{ $trx->customer_no }}</p>
                                <p class="text-[12px] text-on-surface-variant">{{ $trx->created_at->format('d M Y • H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-body-sm text-on-surface">-Rp {{ number_format($trx->amount, 0, ',', '.') }}</p>
                                @if($trx->status === 'Sukses')
                                    <span class="inline-flex px-xs py-[2px] bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Sukses</span>
                                @elseif($trx->status === 'Pending')
                                    <span class="inline-flex px-xs py-[2px] bg-yellow-100 text-yellow-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Pending</span>
                                @else
                                    <span class="inline-flex px-xs py-[2px] bg-red-100 text-red-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Gagal</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-md text-on-surface-variant text-body-sm">Belum ada transaksi.</div>
                        @endforelse
                    </div>  
                </div>

                <!-- Promotion Banner Section -->
                <div class="bg-primary-container text-white relative overflow-hidden group cursor-pointer shadow-lg active:scale-95 transition-transform w-full" style="border-radius: 24px; padding: 24px; min-height: 220px; height: auto; display: flex; flex-direction: column; justify-content: center;">
                    <div class="absolute inset-0 bg-cover bg-center mix-blend-overlay opacity-30 group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ asset('images/promo_banner.png') }}')"></div>
                    <div class="relative z-10 w-full">
                        <span class="inline-block px-3 py-1 bg-white/20 rounded-lg text-[10px] font-bold uppercase tracking-widest mb-3">Exclusive Offer</span>
                        <h4 class="text-2xl font-bold leading-tight mb-2">Get 10% Cashback</h4>
                        <p class="text-sm opacity-90 mb-5">On all utility bill payments this weekend. T&amp;C apply.</p>
                        <button class="px-5 py-2.5 bg-white text-primary font-bold rounded-lg text-sm hover:shadow-xl transition-all">Claim Now</button>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Featured News / Market Section -->
        <section class="mt-xxl">
            <div class="flex justify-between items-center mb-lg">
                <h3 class="font-headline-md text-headline-md">Finance Insights</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
                <div class="bg-white dark:bg-gray-900 rounded-[24px] border border-outline-variant/30 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/market_news.png') }}')"></div>
                    <div class="p-md">
                        <span class="text-[10px] font-bold text-primary uppercase">Market News</span>
                        <h5 class="font-bold text-body-md mt-xs mb-sm">5 Tips to Manage Your Monthly Bills Effectively</h5>
                        <p class="text-body-sm text-on-surface-variant line-clamp-2">Learn how the experts automate their payments and save more every month with EasyHand.</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-[24px] border border-outline-variant/30 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/new_feature.png') }}')"></div>
                    <div class="p-md">
                        <span class="text-[10px] font-bold text-secondary uppercase">New Feature</span>
                        <h5 class="font-bold text-body-md mt-xs mb-sm">Introducing Direct Wallet-to-Bank Transfer</h5>
                        <p class="text-body-sm text-on-surface-variant line-clamp-2">Moving money has never been easier. Link your primary bank account and transfer in seconds.</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-[24px] border border-outline-variant/30 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/savings.png') }}')"></div>
                    <div class="p-md">
                        <span class="text-[10px] font-bold text-tertiary uppercase">Savings</span>
                        <h5 class="font-bold text-body-md mt-xs mb-sm">Save Up to 15% with EasyHand Prime</h5>
                        <p class="text-body-sm text-on-surface-variant line-clamp-2">Upgrade your account to Prime and enjoy reduced admin fees on all transaction types.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-filament-panels::page>
