<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2 mb-8">
            @foreach($this->availableProducts as $product)
                @php
                    $markup = auth()->user()->markup ?? 500;
                    $finalPrice = $product->price + $markup;
                @endphp
                <div 
                    @click="state = '{{ $product->id }}'"
                    :class="{ 
                        'border-primary-600 bg-primary-50 ring-2 ring-primary-600 shadow-md': state == '{{ $product->id }}', 
                        'border-gray-200 bg-white hover:border-primary-300 hover:shadow-sm': state != '{{ $product->id }}' 
                    }"
                    class="cursor-pointer border rounded-2xl p-4 transition-all duration-200 relative overflow-hidden flex flex-col justify-between min-h-[100px]"
                >
                    <div class="flex justify-between items-start gap-2">
                        <div class="font-semibold text-sm text-gray-800 line-clamp-2 leading-tight">
                            {{ $product->product_name }}
                        </div>
                        
                        <!-- Checkmark for selected state -->
                        <div x-show="state == '{{ $product->id }}'" class="text-primary-600 flex-shrink-0" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    @if(!$this->isPostpaid())
                        <div class="mt-3 font-bold text-primary-600 text-sm">
                            Rp {{ number_format($finalPrice, 0, ',', '.') }}
                        </div>
                    @else
                        <div class="mt-3 text-gray-500 text-xs italic">
                            Tagihan Pascabayar
                        </div>
                    @endif
                </div>
            @endforeach
            
            @if($this->availableProducts->isEmpty())
                <div class="col-span-full py-10 text-center text-gray-500 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <p class="font-medium text-sm">Masukkan nomor/ID pelanggan yang valid</p>
                    <p class="text-xs mt-1">Produk akan otomatis muncul di sini</p>
                </div>
            @endif
        </div>
        
        <!-- Spacer untuk memisahkan grid produk dengan tombol Beli/Cek Tagihan -->
        <div class="h-6 w-full"></div>
    </div>
</x-dynamic-component>
