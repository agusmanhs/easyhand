<x-filament-panels::page>
    <x-filament::card>
        @if($this->inquiryData)
            <div class="mb-4">
                <h3 class="text-lg font-bold text-on-surface">Rincian Tagihan</h3>
                <div class="bg-surface-container-low p-4 rounded-xl mt-4 text-body-sm space-y-3 border border-outline-variant/30 shadow-sm">
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span class="text-on-surface-variant">ID Pelanggan</span>
                        <span class="font-semibold text-on-surface">{{ $this->inquiryData['customer_no'] ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span class="text-on-surface-variant">Nama Pelanggan</span>
                        <span class="font-semibold text-on-surface">{{ $this->inquiryData['customer_name'] ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span class="text-on-surface-variant">Rincian</span>
                        <span class="font-semibold text-right text-on-surface">
                            @if(is_array($this->inquiryData['desc'] ?? null) && isset($this->inquiryData['desc']['detail']))
                                @foreach($this->inquiryData['desc']['detail'] as $det)
                                    {{ $det['periode'] ?? '' }}<br>
                                @endforeach
                            @elseif(is_array($this->inquiryData['desc'] ?? null) && isset($this->inquiryData['desc']['item_name']))
                                {{ $this->inquiryData['desc']['item_name'] }}
                            @elseif(is_string($this->inquiryData['desc'] ?? null))
                                {{ $this->inquiryData['desc'] }}
                            @else
                                Tagihan PPOB
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="font-bold text-on-surface">Total Pembayaran</span>
                        <span class="font-bold text-primary text-lg">Rp {{ number_format(($this->inquiryData['selling_price'] ?? 0) + (auth()->user()->markup ?? 500), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 flex gap-3">
                <form wire:submit="submit" class="flex-1">
                    <x-filament::button type="submit" size="lg" class="w-full">
                        Bayar Tagihan
                    </x-filament::button>
                </form>
                <x-filament::button wire:click="cancelInquiry" color="gray" size="lg" class="flex-1 w-full">
                    Batalkan
                </x-filament::button>
            </div>
        @else
            <form wire:submit="submit">
                {{ $this->form }}

                <div class="mt-4">
                    <x-filament::button type="submit" size="lg">
                        {{ $this->isPostpaid() ? 'Cek Tagihan' : 'Beli Sekarang' }}
                    </x-filament::button>
                </div>
            </form>
        @endif
    </x-filament::card>
</x-filament-panels::page>
