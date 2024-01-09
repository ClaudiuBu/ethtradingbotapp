<div class="main px-2">
    {{-- main --}}
    <h1 class="font-bold text-xl text-lg mt-5 mb-5"
    :class="{'text-white': darkMode === 'dark', 'text-black': darkMode === 'light'}">
        Trading Bot Dashboard
    </h1>

    {{-- make 3 boxes with circles inside transition --}}
    <div class="flex w-full gap-2">
        <div class="w-3/6 flex gap-2 flex-wrap">
            @include('front.components.infographic')
        </div>
        
        <div class="w-3/6 flex">
            <livewire:trading-history />
        </div>
    </div>

    <div class="flex w-full mt-5 mb-5 gap-1">
        {{-- 4/6 new listings --}}
        <div class="w-4/6">
            <livewire:new-token-listings/>
        </div>
        {{-- 2/6 console service activity/bots activity --}}
        <div class="w-2/6">
            <div class="console w-full">
                <h3>Console</h3>
                <div class="navigation"></div>
                <div class="panel block h-52"
                :class="{'bg-wheat-100': darkMode === 'dark', 'bg-black': darkMode === 'light'}">
                </div>
            </div>
        </div>
    </div>


    {{-- active trades --}}
    <div class="flex w-full mt-5 mb-5">
        <div class="w-full">
            <h2>Active Trades</h2>
            {{-- panel --}}
            <div class="panel block h-52">
                {{-- line --}}
                <div class="w-full h-1 bg-black mt-1"></div>
                <div class="w-full h-1 bg-black mt-1"></div>
            </div>
        </div>
</div>