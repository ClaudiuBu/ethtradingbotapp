<div class="w-full">
    {{-- bar header top --}}
    <div class="flex justify-end p-2 gap-2 shadow-sm"
    :class="{'bg-indigo-600': darkMode === 'dark', 'bg-rose-100': darkMode === 'light'}">

        {{-- admin button --}}
    <button class="rounded border px-1 bg-blue-500">
        @if(Route::current()->getName() == 'main')
        <a href="{{ route('admin') }}" class="flex items-center">
            <span class="material-symbols-outlined text-white">
                admin_panel_settings
            </span>
        </a>
        {{-- if route is /admin --}}
        @elseif(Route::current()->getName() == 'admin')
        <a href="{{ route('main') }}" class="flex items-center">
            <span class="material-symbols-outlined text-white">
                home
            </span>
        </a>
        @endif
    
    </button>
        
    {{-- switch network --}}
    
    {{-- connect wallet --}}
    <button class="rounded border px-1"
    :class="{'bg-white': darkMode === 'dark', 'bg-rose-500': darkMode === 'light'}">
        <span class="text-white">
        Connect Wallet
        </span>
    </button>


    <livewire:toogle-dark-mode />
    </div>
</div>