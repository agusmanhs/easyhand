<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyHand - All Your Digital Payments in One Place</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        .font-serif-custom { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="antialiased bg-[#fafafa] text-[#1e293b]">

    <!-- Navbar -->
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-4 flex justify-between items-center">
        <div class="flex items-center gap-8">
            <a href="/" class="text-2xl font-serif-custom font-bold text-brand">EasyHand</a>
            <div class="hidden md:flex gap-6 text-sm font-medium text-gray-600">
                <a href="#" class="text-brand border-b-2 border-brand pb-1">Services</a>
                <a href="#" class="hover:text-brand transition">Pricing</a>
                <a href="#" class="hover:text-brand transition">Help</a>
                <a href="#" class="hover:text-brand transition">About</a>
            </div>
        </div>
        <div class="flex items-center gap-4 text-sm font-medium">
            @auth
                <a href="{{ url('/admin') }}" class="text-brand hover:text-brand-dark transition">Dashboard</a>
            @else
                <a href="{{ route('filament.admin.auth.login') }}" class="text-brand hover:text-brand-dark transition">Login</a>
                <a href="{{ route('filament.admin.auth.login') }}" class="bg-brand text-white px-5 py-2 rounded-md hover:bg-brand-dark transition shadow-sm">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <div class="inline-block bg-orange-100 text-brand text-xs font-semibold px-3 py-1 rounded-full mb-6">NEW PRODUCT V3</div>
            <h1 class="text-5xl md:text-6xl font-serif-custom font-bold leading-tight text-gray-900 mb-6">
                All Your Digital <span class="text-brand">Payments</span> in One Place
            </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                The ultimate fintech companion for high-speed transactions. Pay bills, buy credits, and manage your digital wallet with enterprise-grade security.
            </p>
            <div class="flex gap-4">
                <a href="#" class="bg-brand text-white px-8 py-3 rounded-md hover:bg-brand-dark transition shadow-md font-medium">Get Started</a>
                <a href="#" class="border border-gray-300 text-gray-700 px-8 py-3 rounded-md hover:bg-gray-50 transition font-medium">View Demo</a>
            </div>
        </div>
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-tr from-orange-100 to-transparent rounded-2xl transform translate-x-4 translate-y-4 -z-10"></div>
            <img src="https://images.unsplash.com/photo-1616077168079-7e09a677fb2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="App Preview" class="rounded-2xl shadow-2xl object-cover w-full h-[400px]">
        </div>
    </section>

    <!-- Stats -->
    <div class="border-y border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200 text-center">
                <div>
                    <div class="text-3xl font-serif-custom font-bold text-brand mb-1">500k+</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Active Users</div>
                </div>
                <div>
                    <div class="text-3xl font-serif-custom font-bold text-brand mb-1">12k</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Transactions/s</div>
                </div>
                <div>
                    <div class="text-3xl font-serif-custom font-bold text-brand mb-1">4.9</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">User Rating</div>
                </div>
                <div>
                    <div class="text-3xl font-serif-custom font-bold text-brand mb-1">1500+</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">B2B Partners</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <h2 class="text-3xl md:text-4xl font-serif-custom font-bold text-gray-900 mb-4">Seamless Digital Services</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mb-16">Access a complete ecosystem of digital products. Fast, reliable, and integrated into your daily workflow.</p>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Pulsa</div>
            </div>
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Data</div>
            </div>
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">PLN Token</div>
            </div>
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">BPJS</div>
            </div>
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">PDAM</div>
            </div>
            <!-- Service Item -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Internet</div>
            </div>
            <!-- Additional rows... -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">E-Wallet</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Game</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">TV Cable</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Tickets</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-brand group-hover:text-white transition text-brand">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">Installments</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer group">
                <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-gray-100 transition text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div class="text-sm font-semibold text-gray-800">View All</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-[#f0f4f8] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tech" class="rounded-2xl shadow-xl w-full h-[350px] object-cover">
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-serif-custom font-bold text-gray-900 mb-8">Engineered for <span class="text-brand">Performance</span></h2>
                
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-brand">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Lightning Fast</h3>
                            <p class="text-gray-600 text-sm">Transactions processed in milliseconds. No more waiting for confirmation loops.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-brand">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Military-Grade Security</h3>
                            <p class="text-gray-600 text-sm">End-to-end encryption and multi-factor authentication protect every cent.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-brand">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Trusted Globally</h3>
                            <p class="text-gray-600 text-sm">Over 5,000 businesses trust our gateway for their daily transaction needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <h2 class="text-3xl font-serif-custom font-bold text-center text-gray-900 mb-10">Frequently Asked Questions</h2>
        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-indigo-50/50 rounded-lg p-5 flex justify-between items-center cursor-pointer hover:bg-indigo-50 transition">
                <span class="font-medium text-gray-800">How secure is my data with EasyHand?</span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <!-- FAQ 2 -->
            <div class="bg-indigo-50/50 rounded-lg p-5 flex justify-between items-center cursor-pointer hover:bg-indigo-50 transition">
                <span class="font-medium text-gray-800">What are the transaction fees?</span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <!-- FAQ 3 -->
            <div class="bg-indigo-50/50 rounded-lg p-5 flex justify-between items-center cursor-pointer hover:bg-indigo-50 transition">
                <span class="font-medium text-gray-800">Can I integrate EasyHand with my business?</span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-gray-900 rounded-[2.5rem] p-12 md:p-20 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <h2 class="text-3xl md:text-5xl font-serif-custom font-bold text-white mb-6 relative z-10">Ready to transform your payments?</h2>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto relative z-10">Join thousands of users who have simplified their digital financial life with EasyHand.</p>
            <a href="{{ route('filament.admin.auth.login') }}" class="inline-block bg-brand text-white font-medium px-8 py-3 rounded-md hover-bg-brand transition shadow-lg relative z-10">Create Free Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between mb-12">
                <div class="max-w-xs mb-8 md:mb-0">
                    <a href="/" class="text-2xl font-serif-custom font-bold text-brand block mb-4">EasyHand</a>
                    <p class="text-sm text-gray-500">The future of digital fintech. Secure, fast, and incredibly simple.</p>
                </div>
                <div class="flex gap-16 text-sm">
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Company</h4>
                        <ul class="space-y-2 text-gray-500">
                            <li><a href="#" class="hover:text-brand transition">About Us</a></li>
                            <li><a href="#" class="hover:text-brand transition">Careers</a></li>
                            <li><a href="#" class="hover:text-brand transition">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Products</h4>
                        <ul class="space-y-2 text-gray-500">
                            <li><a href="#" class="hover:text-brand transition">Personal Wallet</a></li>
                            <li><a href="#" class="hover:text-brand transition">Business API</a></li>
                            <li><a href="#" class="hover:text-brand transition">PPOB Portal</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Support</h4>
                        <ul class="space-y-2 text-gray-500">
                            <li><a href="#" class="hover:text-brand transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-brand transition">Security</a></li>
                            <li><a href="#" class="hover:text-brand transition">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
                <p>&copy; 2026 EasyHand Fintech. All rights reserved.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gray-600 transition">Terms of Service</a>
                    <a href="#" class="hover:text-gray-600 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-600 transition">Cookie Settings</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
