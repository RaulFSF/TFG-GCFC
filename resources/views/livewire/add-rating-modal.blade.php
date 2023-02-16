<div>
    <div class="p-4 w-full card-gradient">
        <div wire:loading.block wire:target="save"
            class="w-full h-full py-20 flex justify-center items-center space-x-2 bg-baseText rounded-lg shadow-lg">
            <div class="text-center semipolar-spinner w-full mx-auto" :style="spinnerStyle">
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
            </div>
            <div class="mt-2 flex justify-center">
                <span class="text-xl">Guardando...</span>
            </div>
        </div>
        <form wire:submit.prevent="save" wire:loading.remove wire:target="save">
            @csrf
            <div class="flex justify-between space-x-2 items-center">
                <div>
                    <label for="name" class="text-xs">Nombre</label>
                    <input type="text" wire:model="name" id="name"
                    class="disabled w-full text-xs text-base2 border border-blue-300 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">

                </div>
                <div class="flex-col items-center justify-center">
                    <label for="stars" class="text-xs">Estrellas (0-5)</label>
                    <div class="flex justify-center items-center">
                        <input type="number" wire:model="stars" id="stars"
                        class="w-full text-xs text-base2 border border-blue-300 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                    </div>
                    @error('stars')
                        <span class="error text-red-500 text-sm italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex-col items-start">
                <label for="comment" class="text-xs">Comentario</label>
                <textarea type="text" wire:model="comment" id="comment"
                    class="w-full h-20 text-xs text-base2 border border-blue-300 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"> </textarea>
                @error('comment')
                    <span class="error text-red-500 text-sm italic">{{ $message }}</span>
                @enderror
            </div>
            <button class="px-4 py-2 bg-white border-base2 border-2  text-base2 text-sm mt-4 rounded-xl">Guardar</button>
        </form>
    </div>
</div>
