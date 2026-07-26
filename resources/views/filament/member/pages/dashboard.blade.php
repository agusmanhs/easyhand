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
            <h1 class="font-headline-md text-headline-md font-bold text-on-surface">Welcome back, Alex!</h1>
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
                            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg mt-xs">Rp 2.450.000</h2>
                        </div>
                        <div class="bg-white/10 p-sm rounded-xl backdrop-blur-md">
                            <span class="material-symbols-outlined text-[32px]">payments</span>
                        </div>
                    </div>
                    <div class="relative z-10 flex gap-md mt-xl">
                        <button class="flex-1 py-md bg-brand-orange text-white rounded-xl font-button-text text-button-text flex items-center justify-center gap-sm hover:brightness-110 active:scale-95 transition-all">
                            <span class="material-symbols-outlined">add_circle</span>
                            Top Up
                        </button>
                        <button class="flex-1 py-md bg-white/20 text-white rounded-xl font-button-text text-button-text flex items-center justify-center gap-sm hover:bg-white/30 active:scale-95 transition-all backdrop-blur-sm border border-white/20">
                            <span class="material-symbols-outlined">send</span>
                            Send Money
                        </button>
                    </div>
                </div>

                <!-- Quick Services Grid -->
                <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-8 lg:grid-cols-4 gap-md">
                    <button class="flex flex-col items-center justify-center p-md bg-white rounded-3xl border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-primary-container/10 text-primary flex items-center justify-center mb-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">smartphone</span>
                        </div>
                        <span class="font-body-sm text-body-sm font-semibold">Pulsa</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-md bg-white rounded-3xl border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-secondary-container/10 text-secondary flex items-center justify-center mb-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">bolt</span>
                        </div>
                        <span class="font-body-sm text-body-sm font-semibold">PLN</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-md bg-white rounded-3xl border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-error-container/10 text-error flex items-center justify-center mb-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">wifi</span>
                        </div>
                        <span class="font-body-sm text-body-sm font-semibold">Data</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-md bg-white rounded-3xl border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-surface-container-highest text-tertiary flex items-center justify-center mb-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">water_drop</span>
                        </div>
                        <span class="font-body-sm text-body-sm font-semibold">PDAM</span>
                    </button>
                </div>
            </section>

            <!-- Recent Transactions (Sidebar Layout on Desktop) -->
            <aside class="lg:col-span-4 flex flex-col gap-lg">
                <div class="bg-white p-lg rounded-[24px] border border-outline-variant/30 shadow-sm flex flex-col h-full max-h-[500px]">
                    <div class="flex justify-between items-center mb-lg">
                        <h3 class="font-headline-md text-headline-md">Recent History</h3>
                        <a class="text-primary font-button-text text-button-text hover:underline" href="#">See All</a>
                    </div>
                    <div class="space-y-lg overflow-y-auto custom-scrollbar pr-xs">
                        <!-- Item 1 -->
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary">smartphone</span>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="font-semibold text-body-sm truncate">Pulsa Indosat - 0812...</p>
                                <p class="text-[12px] text-on-surface-variant">24 Oct 2023 • 14:20</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-body-sm text-on-surface">-Rp 50.000</p>
                                <span class="inline-flex px-xs py-[2px] bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Success</span>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-secondary">bolt</span>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="font-semibold text-body-sm truncate">Token PLN - Alex House</p>
                                <p class="text-[12px] text-on-surface-variant">23 Oct 2023 • 09:15</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-body-sm text-on-surface">-Rp 200.000</p>
                                <span class="inline-flex px-xs py-[2px] bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Success</span>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary-container">account_balance_wallet</span>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="font-semibold text-body-sm truncate">Top Up - BCA Transfer</p>
                                <p class="text-[12px] text-on-surface-variant">22 Oct 2023 • 18:45</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-body-sm text-green-600">+Rp 500.000</p>
                                <span class="inline-flex px-xs py-[2px] bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Success</span>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-error">receipt</span>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="font-semibold text-body-sm truncate">Internet Bill - MyRep</p>
                                <p class="text-[12px] text-on-surface-variant">21 Oct 2023 • 10:00</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-body-sm text-on-surface">-Rp 349.000</p>
                                <span class="inline-flex px-xs py-[2px] bg-yellow-100 text-yellow-800 rounded-md text-[10px] font-bold uppercase tracking-wider">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Promotion Banner Section -->
                <div class="bg-primary-container p-lg rounded-[24px] text-white relative overflow-hidden group cursor-pointer shadow-lg active:scale-95 transition-transform">
                    <div class="absolute inset-0 bg-cover bg-center mix-blend-overlay opacity-30 group-hover:scale-110 transition-transform duration-700" style="background-image: url('{{ asset('images/promo_banner.png') }}')"></div>
                    <div class="relative z-10">
                        <span class="inline-block px-sm py-xs bg-white/20 rounded-lg text-[10px] font-bold uppercase tracking-widest mb-sm">Exclusive Offer</span>
                        <h4 class="font-headline-md text-headline-md leading-tight mb-xs">Get 10% Cashback</h4>
                        <p class="text-body-sm opacity-90">On all utility bill payments this weekend. T&amp;C apply.</p>
                        <button class="mt-md px-md py-sm bg-white text-primary font-bold rounded-lg text-body-sm hover:shadow-xl transition-all">Claim Now</button>
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
                <div class="bg-white rounded-[24px] border border-outline-variant/30 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/market_news.png') }}')"></div>
                    <div class="p-md">
                        <span class="text-[10px] font-bold text-primary uppercase">Market News</span>
                        <h5 class="font-bold text-body-md mt-xs mb-sm">5 Tips to Manage Your Monthly Bills Effectively</h5>
                        <p class="text-body-sm text-on-surface-variant line-clamp-2">Learn how the experts automate their payments and save more every month with EasyHand.</p>
                    </div>
                </div>
                <div class="bg-white rounded-[24px] border border-outline-variant/30 overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/new_feature.png') }}')"></div>
                    <div class="p-md">
                        <span class="text-[10px] font-bold text-secondary uppercase">New Feature</span>
                        <h5 class="font-bold text-body-md mt-xs mb-sm">Introducing Direct Wallet-to-Bank Transfer</h5>
                        <p class="text-body-sm text-on-surface-variant line-clamp-2">Moving money has never been easier. Link your primary bank account and transfer in seconds.</p>
                    </div>
                </div>
                <div class="bg-white rounded-[24px] border border-outline-variant/30 overflow-hidden shadow-sm hover:shadow-md transition-all">
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
