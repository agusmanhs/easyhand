<style>
    .fi-logo-light { display: block; }
    .fi-logo-dark { display: none; }
    html.dark .fi-logo-light { display: none !important; }
    html.dark .fi-logo-dark { display: block !important; }
</style>
<div class="flex items-center">
    <!-- Light Mode Logo -->
    <img src="{{ asset('images/easyhand-full-logo.png') }}" alt="easyhand" class="fi-logo-light h-10 w-auto object-contain" />
    <!-- Dark Mode Logo -->
    <img src="{{ asset('images/easyhand-logo-dark.png') }}" alt="easyhand" class="fi-logo-dark h-10 w-auto object-contain" />
</div>
