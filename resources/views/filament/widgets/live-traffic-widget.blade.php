<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-lg font-semibold">Live Traffic</h2>
                <p class="text-sm text-gray-500">Global distribution of requests</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700 dark:text-gray-200">Direct Top-up</span>
                    <span class="font-bold">64%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-[#b1773a] h-2.5 rounded-full" style="width: 64%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700 dark:text-gray-200">Bill Payments</span>
                    <span class="font-bold">22%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-gray-400 h-2.5 rounded-full" style="width: 22%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700 dark:text-gray-200">E-Wallet Sync</span>
                    <span class="font-bold">14%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-gray-600 h-2.5 rounded-full" style="width: 14%"></div>
                </div>
            </div>
        </div>

        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg flex items-center gap-3">
            <div class="p-2 bg-white dark:bg-gray-700 rounded shadow-sm">
                <x-heroicon-o-bolt class="w-5 h-5 text-[#b1773a]"/>
            </div>
            <div>
                <p class="text-sm font-semibold">Peak Performance</p>
                <p class="text-xs text-gray-500">Current processing speed: 1.2s</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
