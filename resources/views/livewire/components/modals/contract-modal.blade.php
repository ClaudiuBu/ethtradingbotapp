
<div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed items-center justify-center" x-data="addCartConfirmation(@this)" x-bind="main" x-cloak>
    {{-- Success is as dangerous as failure. --}}
    <div class="relative bg-white shadow-xl m-auto my-8 sm:my-40 w-10/12 md:w-8/12 lg:w-6/12 rounded-lg" x-bind="modal_confirmation" x-cloak>
        <div class="modal-contract max-h-72">
            <div style="white-space: pre-wrap">
                <p class="text-xs text-white">
                    {{-- {{!! $contract !!}} --}}
                </p>
            </div>
        </div>
    </div>
</div>


