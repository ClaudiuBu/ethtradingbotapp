<div wire:poll.2500ms>
    <div class="flex justify-between mb-5">
        <h2 class="text-lg font-medium color-gray-700"> Placeholder for new listings</h2>

        <div class="flex items-center justify-start gap-2">
            <select wire:model="numberOfLastTokens">
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
            {{-- grid view button --}}
            <button class="text-sm text-white bg-indigo-600 p-1 rounded flex items-center" wire:click="changeListing('grid_view')">
                <span class="material-symbols-outlined">
                    grid_view
                </span>
            </button>
            {{-- list view button --}}
            <button class="text-sm text-white  bg-indigo-600  p-1 rounded flex items-center" wire:click="changeListing('cards')"><span class="material-symbols-outlined">
                cards
                </span></button>
            {{-- tabel view button --}}
            <button class="text-sm text-white bg-indigo-600  p-1 rounded flex items-center" wire:click="changeListing('table_view')">
                <span class="material-symbols-outlined">
                    table_view
                </span>
            </button>
        </div>
    </div>
{{-- Panel --}}
    <div class="flex w-full gap-2">
        {{-- panel --}}
        @foreach($tokens as $token)
            {{-- color code la bg in functie de scor de la red la verde --}}
            
            <div class="card bg-ethereum w-[30%] rounded shadow-lg relative py-3 px-2">
                 <img class="opacity-40 absolute" src="{{ asset('storage/images/eth-logo2.svg') }}" alt="" style="left:0;right:0;top:0;bottom:0;padding:10px;">
                <div class="top flex justify-between relative z-10">
                    <div>
                        {{-- de adaugat ceva aici --}}
                    </div>
                  
                    {{-- numarul de holderi --}}
                    {{-- lista cu ethscan/dextools/contract-ul afisat in popup(formatat)--}}
                    <div class="action-bar flex gap-1">
                        <div x-data="{open=false}">
                            <a @mouseover="open = true" @mouseout="open = false" class="cursor-pointer">
                                <span class="material-symbols-outlined bg-white rounded" style="padding:1px;">
                                    contract
                                    </span>
                                </a>
                        </div>
                        <div x-data="{open:false}">
                            <a @mouseover="open = true" @mouseout="open = false" class="cursor-pointer">
                                <span class="material-symbols-outlined bg-white rounded" style="padding:1px;">
                                    share
                                    </span>
                                </a>
                            <ul x-show="open" class="bg-white shadow-md rounded-md flex flex-col py-1 gap-2 justify-center items-center px-1 ransition transform duration-500 ease-in-out absolute"
                            x-transition:enter="transition ease-out duration-200 transform"
                            x-transition:enter-start="opacity-0 -translate-x-full"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-150 transform"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-full"
                            @mouseenter="open = true" @mouseleave="open = false"
                                >
                                <li><a href=""><img src="{{ asset('storage/images/etherscan-logo.svg') }}" alt="" style="width:25px;" class=""></a></li>
                                <li><a href=""><img src="{{ asset('storage/images/dextools.svg') }}" alt="" style="width:25px;" ></a></li>
                                <li><a href=""><img src="{{ asset('storage/images/uniswap.svg') }}" alt="" style="width:35px;" ></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="relative">
                        <div class="flex items-center justify-center gap-1">
                        {{-- sa pun check-ul de contract verificat --}}   
                        @if($token->contract_verified)
                            <div x-data="{open:false}">
                                <span class="material-symbols-outlined filled-icons text-green-500 cursor-pointer"
                                        @mouseover="open = true"
                                        @mouseout="open = false">
                                    verified
                                </span>
                                <span class="bg-white p-1 rounded text-sm top-[-30px] left-[40px] shadow-md absolute"
                                        x-show="open"
                                        x-transition:enter="transition ease-out duration-200 transform"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150 transform"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-1">
                                        Contractul e verificat!
                                </span>
                            </div>
                        @else
                        <span class="material-symbols-outlined filled-icons text-red-500">pending</span>    
                        @endif
                            <h3 class="text-lg text-center color-ethereum font-semibold">
                            {{ $token->token_name }} 
                            </h3>
                        </div>
                    <span class="text-xs block text-center color-ethereum font-semibold">
                    ({{ $token->token_symbol }})</span></div>
                {{-- <li>Token Price</li> maybe price at the top, ceva arrow cand creste arrow down cand scade --}}
                {{-- body --}}
                <div class="relative mt-2 mb-2">
                    <ul class="flex gap-1 flex-wrap flex-col">
                        <li class="text-xs color-ethereum font-medium">
                            Launched:
                            <span>
                                 {{ $token->formattedDiff }} ago
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Contract Address
                            <span>
                                {{ $token->contract_address }}
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Decimals
                            <span>
                                {{ $token->token_decimals }}
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Supply
                            <span>
                                {{ $token->token_total_supply }}
                            </span>

                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Holders
                            <span>
                                {{ $token->token_holders }}
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Price
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token MarketCap
                            <span>
                                {{ $token->market_cap }}
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Liquidity

                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Token Volume
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Sell Tax 
                            <span>
                                {{ $token->sell_tax }}
                            </span>
                        </li>
                        <li class="text-xs color-ethereum font-medium">
                            Buy Tax
                            <span>
                                {{ $token->buy_tax }}
                            </span>
                        </li>
                    </ul>

                </div>
            </div>
        @endforeach
    </div>  
</div> 