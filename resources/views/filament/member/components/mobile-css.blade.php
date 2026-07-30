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
    }
</style>
