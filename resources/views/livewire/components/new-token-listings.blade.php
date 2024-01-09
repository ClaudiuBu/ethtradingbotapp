<div wire:poll.2500ms>
    <div class="flex justify-between mb-3">
        <h2> Placeholder for new listings</h2>

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
    <div class="flex w-full gap-1">
        {{-- panel --}}
        @foreach($tokens as $token)
            {{-- color code la bg in functie de scor de la red la verde --}}
            
            <div class="card bg-red-300 w-[30%] rounded shadow-md">
                 <img class="" src="{{ asset('storage/images/eth-logo.svg') }}" alt="">
                <div class="top">
                {{-- sa pun check-ul de contract verificat --}}       
                {{-- numarul de holderi --}}
                {{-- lista cu ethscan/dextools/contract-ul afisat in popup(formatat)--}}
                </div>
                <h3 class="text-white font-base text-center">{{ $token->token_name }}</h3>
            </div>
        @endforeach
    </div>  
</div> 

