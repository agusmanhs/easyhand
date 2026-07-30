<div class="min-h-screen flex w-full">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
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
                        "secondary-container": "#d6e0f4"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
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
                    fontFamily: {
                        "button-text": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Inter"],
                        "label-caps": ["JetBrains Mono"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-effect { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .shadow-soft { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05); }
        .shadow-elevated { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); }
        .fi-layout { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }
        .fi-main { padding: 0 !important; margin: 0 !important; }
        .fi-logo { display: none !important; }
    </style>

    <main class="w-full min-h-screen flex flex-col md:flex-row">
        <!-- Left Side: Branding & Illustration (Hidden on mobile) -->
        <section class="hidden md:flex md:w-1/2 lg:w-3/5 bg-inverse-surface relative overflow-hidden items-center justify-center p-xxl">
            <!-- Background Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-primary-container blur-[120px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-secondary-container blur-[100px]"></div>
            </div>
            
            <!-- Content on Branding Side -->
            <div class="relative z-10 max-w-lg text-inverse-on-surface">
                <div class="mb-lg">
                    <span class="font-headline-md text-[24px] font-bold text-primary-fixed-dim">EasyHand</span>
                </div>
                <h1 class="font-display-lg text-[48px] leading-[56px] tracking-[-0.02em] font-bold mb-md">Seamless payments, global velocity.</h1>
                <p class="font-body-lg text-[18px] text-surface-variant opacity-90 mb-xxl">
                    Join thousands of businesses managing their finances with the speed and precision of modern SaaS architecture.
                </p>
                
                <!-- Featured Card Illustration -->
                <div class="glass-effect rounded-[24px] p-lg shadow-elevated border border-white/10 relative">
                    <div class="flex items-center justify-between mb-lg">
                        <div class="h-10 w-16 bg-white/20 rounded-lg"></div>
                        <span class="material-symbols-outlined text-primary-fixed-dim">contactless</span>
                    </div>
                    <div class="space-y-sm mb-lg">
                        <div class="h-2 w-32 bg-white/30 rounded"></div>
                        <div class="h-2 w-48 bg-white/20 rounded"></div>
                    </div>
                    <div class="flex justify-between items-end">
                        <div class="font-label-caps text-[12px] tracking-[0.05em] font-medium text-white/60">ACTIVE ACCOUNT</div>
                        <div class="font-headline-md text-[24px] font-semibold text-white">$42,910.00</div>
                    </div>
                </div>
            </div>
            <!-- Background Image Integration -->
            <div class="absolute inset-0 z-0 opacity-10 pointer-events-none" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB4FuG9ZaYuHdp_ffqfqpjhLWHmonjzjyHFW5Wp_b-L7mKdKzwwQd0QgeDUulNwTnLAPr5T0mB0oNun6EQ8J8xu7jvX2BX2nMqJeaGqSnsLElNMfkbNZSyYinn1SO961m0Lulbb2CN7GIW9bs7Ifcr6yEl14hL8M9pIMVSxVqx8QV9viVmovX2Tt-kLE2eINtsAubbAufXfHJ7Dckrv8FNyt9jtUvWUbCGre5jfw7RIsMip_YiKgvp2n2Ahsfgy0JVmap5d0SO8Zgo'); background-size: cover; background-position: center;"></div>
        </section>

        <!-- Right Side: Login Form -->
        <section class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center bg-surface px-gutter py-xxl">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="md:hidden mb-xxl flex justify-center">
                    <span class="font-headline-md text-[24px] font-bold text-primary">EasyHand</span>
                </div>
                
                <!-- Back to Home -->
                <div class="mb-lg">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
                        Back to Website
                    </a>
                </div>

                <div class="text-left mb-xl">
                    <h2 class="font-headline-md text-[24px] font-semibold text-on-surface mb-xs">Create an account</h2>
                    <p class="font-body-sm text-[14px] text-on-surface-variant">Join us today and simplify your digital finance.</p>
                </div>

                <!-- Filament Form -->
                <div class="[&>form>div>div>div:first-child>div>div]:text-sm [&>form>div>div>div:first-child>div>div]:font-semibold [&>form>div>div>div:first-child>div>div]:text-on-surface">
                    <x-filament-panels::form wire:submit="register">
                        {{ $this->form }}

                        <x-filament-panels::form.actions
                            :actions="$this->getCachedFormActions()"
                            :full-width="$this->hasFullWidthFormActions()"
                            class="mt-6 [&_button]:bg-primary [&_button:hover]:opacity-90 [&_button]:rounded-xl [&_button]:py-3 [&_button]:text-[15px] [&_button]:shadow-soft"
                        />
                    </x-filament-panels::form>
                </div>
                
                <p class="mt-xxl text-center font-body-sm text-[14px] text-on-surface-variant text-[#554336]">
                    Already have an account? 
                    <a class="text-primary font-bold hover:underline text-[#8d4b00]" href="{{ route('filament.member.auth.login') }}">Login here</a>
                </p>
                
                <!-- Footer Links (Mobile Only) -->
                <div class="md:hidden mt-xxl flex flex-wrap justify-center gap-md font-body-sm text-[14px] text-on-surface-variant opacity-60 text-[#554336]">
                    <a class="hover:text-primary" href="#">Terms</a>
                    <a class="hover:text-primary" href="#">Privacy</a>
                    <a class="hover:text-primary" href="#">Support</a>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Force remove dark mode class from HTML to prevent Filament forms from turning text white on a white background
        document.documentElement.classList.remove('dark');
        
        // Disable mutations that try to re-add dark mode
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'class' && document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                }
            });
        });
        observer.observe(document.documentElement, { attributes: true });

        document.addEventListener('mousemove', (e) => {
            const blobs = document.querySelectorAll('.rounded-full');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            blobs.forEach((blob, index) => {
                const speed = (index + 1) * 20;
                const xOffset = (x - 0.5) * speed;
                const yOffset = (y - 0.5) * speed;
                blob.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
                blob.style.transition = 'transform 0.2s ease-out';
            });
        });
    </script>
</div>
