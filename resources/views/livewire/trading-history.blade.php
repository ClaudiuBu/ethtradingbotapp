<div>

    {{-- Header for trading history --}}
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-lg font-semibold text-gray-700">Bot Trade History Transaction</h2>
        <div class="gap-2">
            <button class="text-sm text-white bg-indigo-600 p-3 rounded-2xl">Today</button>
            <button class="text-sm border-2 text-indigo-600 p-2 rounded-2xl border-indigo-600">Last Week</button>
            <button class="text-sm border-2 text-indigo-600 p-2 rounded-2xl border-indigo-600">Last Month</button>
            <button class="text-sm border-2 text-indigo-600 p-2 rounded-2xl border-indigo-600">20 Jan - 30 Feb</button>
        </div>
    </div>

    {{-- Table for trading history --}}
    <div class="w-full">
        <div class="flex row gap-2 border-b-2 py-2 items-center justify-between">
            {{-- buy with green/sell with red like a button --}}
            <div class=""><span class="text-base p-1 bg-green-500 text-white rounded">Buy</span></div>
            <div class=""><span class="text-sm">12/10/2022 14:23:13</span></div>
            <div class=""><a href="https://etherscan.io/tx/0x7d20da4d1bb0168566c08d53a7dc606693ea691209d01b018c77963ed719b2ad"><span class="text-base">TX</span></a></div>
            <div class=""><a href="https://whatever"><span>EtH/BLA</span></a></div>
            <div class=""><span class="text-base">0.10 ETH</span></div>
            <div class=""><span class="text-base">100000 BLA (0.5%)</span></div>

            {{-- total eth  baed on previous total eth so up or down based on sell or buy--}}
            <div class=""><span class="text-base">0.005 ETH
                </span></div>
                <div class=""><span class="text-base flex items-center justify-start">500 ETH
                    <span class="material-symbols-outlined text-red-600">
                        trending_down
                        </span>
                </span></div>
        </div>

        <div class="flex row gap-2 border-b-2 py-2">
            <div class=""><span class="text-base p-1 bg-red-500 text-white rounded">Sell</span></div>
            <div class=""><span class="text-sm">12/10/2022 14:23:13</span></div>
            {{-- buy with green/sell with red like a button --}}
            <div class=""><a href="https://etherscan.io/tx/0x7d20da4d1bb0168566c08d53a7dc606693ea691209d01b018c77963ed719b2ad"><span class="text-base">TX</span></a></div>
            <div class=""><a href="https://whatever"><span>EtH/BLA</span></a></div>
            <div class=""><span class="text-base">0.10 ETH</span></div>
            <div class=""><span class="text-base">100000 BLA (0.5%)</span></div>

            {{-- total --}}
            <div class=""><span class="text-base">0.005 ETH</span></div>

            <div class=""><span class="text-base flex items-center justify-start">500 ETH
                <span class="material-symbols-outlined text-green-600">
                    trending_up
                    </span>
            </span></div>
        </div>
        <div class="flex row gap-2 border-b-2 py-2">
            {{-- buy with green/sell with red like a button --}}
            <div class=""><span class="text-base p-1 bg-green-500 text-white rounded">Buy</span></div>
            <div class=""><span class="text-sm">12/10/2022 14:23:13</span></div>
            <div class=""><a href="https://etherscan.io/tx/0x7d20da4d1bb0168566c08d53a7dc606693ea691209d01b018c77963ed719b2ad"><span class="text-base">TX</span></a></div>
            <div class=""><a href="https://whatever"><span>EtH/BLA</span></a></div>
            <div class=""><span class="text-base">0.10 ETH</span></div>
            <div class=""><span class="text-base">100000 BLA (0.5%)</span></div>

            {{-- total eth --}}
            <div class=""><span class="text-base">0.005 ETH</span></div>
            <div class=""><span class="text-base flex items-center justify-start">502 ETH
                <span class="material-symbols-outlined text-red-600">
                    trending_down
                    </span>
                </span></div>
        </div>
    </div>
        
</div>
