<x-filament-panels::page>
    <x-filament::card>
        <form wire:submit="submit">
            {{ $this->form }}

            <div class="mt-4">
                <x-filament::button type="submit" size="lg">
                    Beli Sekarang
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament-panels::page>
