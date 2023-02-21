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
            <div class="flex-col items-center justify-center">
                <label for="name" class="text-xs">Nombre*</label>
                <input type="text" wire:model="name" id="name"
                    class="w-full text-xs text-base2 border border-blue-300 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                @error('name')
                    <span class="error text-red-500 text-sm italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-col items-start">
                <label for="email" class="text-xs">Email*</label>
                <input type="text" wire:model="email" id="email"
                    class="w-full text-xs text-base2 border border-blue-300 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                @error('email')
                    <span class="error text-red-500 text-sm italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-col items-start">
                <label for="avatar" class="text-xs">Imagen*</label>
                <input type="file" wire:model="avatar" id="avatar"
                    class="w-full text-xs text-base2 border border-blue-300 bg-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                @error('avatar')
                    <span class="error text-red-500 text-sm italic">{{ $message }}</span>
                @enderror
            </div>

            @if ($avatar)
                <div class="flex-col space-y-2 mt-4">
                    <p class="text-xs">
                        Imagen subida:
                    </p>
                    <div class="rounded-full w-32 h-32 bg-green-300">
                        <img src="{{ $avatar->temporaryUrl() }}" alt="imagen de perfil"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                </div>
            @else
                <div class="flex-col space-y-2 mt-4">
                    <p class="text-xs">
                        Imagen actual:
                    </p>
                    <div class="rounded-full w-32 h-32 bg-green-300">
                        <img src="{{ asset($user->image_url) }}" alt="imagen de perfil"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                </div>
            @endif

            <button class="hover:scale-[1.02] duration-200 ease-in-out border-2 border-white bg-base3 text-base2 text-sm px-4 py-2 rounded-xl mt-5">Guardar</button>
        </form>
    </div>
</div>
