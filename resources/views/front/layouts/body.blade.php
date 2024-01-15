<body x-data="{darkMode: localStorage.getItem('darkMode') || localStorage.setItem('darkMode', 'light')}"
        class="antialiased"
        :class="{'bg-indigo-500': darkMode === 'dark', 'bg-white': darkMode === 'light'}">
        {{-- header --}}
        @include('front.layouts.header')

        @if(Route::current()->getName() == 'main')
        @include('front.content')
        {{-- if route is /admin --}}
        @elseif(Route::current()->getName() == 'admin')
            @include('admin.content')
        @endif
    </div>
    @stack('modals')

    <livewire:contract-modal>
    
    @include('front._partials.javascript')
</body>
</html>