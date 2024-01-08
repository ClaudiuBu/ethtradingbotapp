{{-- TODO: three modes: dark,dim,light with dropdown - as on ethscan --}}
<div x-data="{
      toggleDarkMode() {
        this.darkMode = this.darkMode === 'light' ? 'dark' : 'light'
        localStorage.setItem('darkMode', this.darkMode)
    },
    }">
    <button class="border rounded p-1 transition-all" 
        :class="{'bg-blue-500': darkMode === 'dark', 'bg-yellow-400': darkMode === 'light'}"
        x-on:click="toggleDarkMode()">
            <span class="material-symbols-outlined text-white flex justify-center items-center" 
            x-text="darkMode == 'light' ? 'light_mode' : 'dark_mode'"></span>
    </button>
</div>
