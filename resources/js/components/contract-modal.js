document.addEventListener('alpine:init', () => {
    Alpine.data('addCartConfirmation', (livewireComponent) => ({
        open: livewireComponent.entangle('open'),

        main: {
            ':style'() {
                return this.open ? 'background-color:rgba(0,0,0,0.5)' : 'display:none';
            }
        },

        modal_confirmation: {
            'x-transition:enter'() {
                return 'transition ease-out duration-100';
            },

            'x-transtition:enter-start'() {
                return 'transform opacity-0 scale-95';
            },

            'x-transition:enter-end'() {
                return 'transform opacity-100 scale-100';
            },

            'x-transition:leave'() {
                return 'transition ease-in duration-75';
            },

            'x-transition:leave-start'() {
                return 'transform opacity-100 scale-100';
            },

            'x-transition:leave-end'() {
                return 'transform opacity-0 scale-95';
            },

            ['x-on:click.away']($event) {
                this.open = false;
            },

            ['x-on:keydown.window.escape']($event) {
                this.open = false;
            },
        },

        close_button: {
            ['x-on:click']($event) {
                this.open = false;
            }
        }
    }));
});
