<div class="flex min-h-screen bg-white">
    <!-- Left Side: Branding / Background -->
    <div class="hidden lg:flex lg:w-1/2 bg-slate-800 text-white p-16 flex-col justify-between relative overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-[#b1773a] opacity-20 rounded-full blur-[100px]"></div>
        
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-[#b1773a] mb-12" style="font-family: 'Playfair Display', serif;">EasyHand</h1>
            
            <h2 class="text-5xl font-bold mb-6 leading-tight">Seamless payments,<br>global velocity.</h2>
            <p class="text-lg text-slate-300 max-w-md leading-relaxed">
                Join thousands of businesses managing their finances with the speed and precision of modern SaaS architecture.
            </p>
        </div>

        <!-- Mock Credit Card -->
        <div class="relative z-10">
            <div class="bg-white/20 backdrop-blur-md border border-white/20 p-8 rounded-2xl w-full max-w-md shadow-2xl">
                <div class="flex justify-between items-start mb-12">
                    <div class="w-16 h-10 bg-white/30 rounded-md"></div>
                    <div class="w-8 h-8 rounded-full border border-white/50 flex items-center justify-center">
                        <div class="w-4 h-4 rounded-full border border-white/50"></div>
                    </div>
                </div>
                <div class="space-y-3 mb-8">
                    <div class="h-2 w-32 bg-white/40 rounded-full"></div>
                    <div class="h-2 w-48 bg-white/20 rounded-full"></div>
                </div>
                <div class="flex justify-between items-end">
                    <div class="text-xs tracking-[0.2em] text-white/60 uppercase">Active Account</div>
                    <div class="text-2xl font-semibold">$42,910.00</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-12 lg:p-24 relative">
        <div class="w-full max-w-md mx-auto">
            
            <!-- Mobile Header (Visible only on small screens) -->
            <div class="lg:hidden mb-10 text-center">
                <h1 class="text-3xl font-bold text-[#b1773a]" style="font-family: 'Playfair Display', serif;">EasyHand</h1>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h2>
                <p class="text-gray-500">Enter your credentials to access your account</p>
            </div>

            <!-- Social Logins -->
            <div class="flex gap-4 mb-8">
                <button class="w-1/2 flex items-center justify-center gap-2 border border-gray-200 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-50 transition text-gray-700">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 15.01 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/><path d="M1 1h22v22H1z" fill="none"/></svg>
                    Google
                </button>
                <button class="w-1/2 flex items-center justify-center gap-2 border border-gray-200 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-50 transition text-gray-700">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.04 2.26-.79 3.59-.76 1.03.02 2.01.37 2.76 1.07-2.69 1.64-2.24 5.37.45 6.47-.63 1.91-1.63 3.75-2.88 5.39zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
                    Apple
                </button>
            </div>

            <div class="relative flex py-5 items-center mb-8">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink-0 mx-4 text-gray-400 text-xs font-semibold tracking-widest uppercase">Or Email</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <!-- Filament Form -->
            <div class="[&>form>div>div>div:first-child>div>div]:text-sm [&>form>div>div>div:first-child>div>div]:font-semibold [&>form>div>div>div:first-child>div>div]:text-gray-900">
                <x-filament-panels::form wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                        class="mt-6 [&_button]:bg-[#b1773a] [&_button:hover]:bg-[#9e6931] [&_button]:rounded-lg [&_button]:py-2.5 [&_button]:text-base"
                    />
                </x-filament-panels::form>
            </div>

            <!-- Footer links -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Don't have an account? <a href="#" class="text-[#b1773a] font-bold hover:underline">Register for an account</a>
            </div>
            
        </div>
    </div>
</div>

<style>
    /* Clean up Filament base layout padding/margin */
    .fi-layout { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }
    .fi-main { padding: 0 !important; margin: 0 !important; }
    /* Hide filament default logo if any appears */
    .fi-logo { display: none !important; }
</style>
