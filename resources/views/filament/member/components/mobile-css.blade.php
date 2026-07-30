<style>
    /* Mobile-specific overrides for PWA experience */
    @media (max-width: 768px) {
        /* Hide the hamburger menu button in the topbar (Filament v3) */
        .fi-topbar nav > div:first-child > button,
        .fi-topbar button[x-on\:click*="sidebar"],
        .fi-topbar button[x-on\:click*="isOpen"],
        .fi-sidebar-close-btn,
        .fi-sidebar-collapse-btn {
            display: none !important;
        }

        /* Prevent content from being hidden behind bottom nav using a physical spacer */
        .fi-main::after {
            content: "";
            display: block;
            height: 100px;
            width: 100%;
            flex-shrink: 0;
        }
    }
</style>
