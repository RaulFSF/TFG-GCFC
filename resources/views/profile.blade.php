<x-guest-layout>
    <div class="max-w-5xl mx-auto bg-baseText rounded-xl shadow-xl w-full mt-10 pb-10">
        <div class="mx-10">
            <div class="flex justify-between space-x-4">
                <div class="flex flex-col justify-center items-center max-h-[90vh] card-gradient rounded-b-xl px-6 space-y-6">
                    <div
                        class="flex flex-col justify-center items-center p-4 bg-opacity-25 bg-base3 rounded-xl space-y-4">

                        <div class="rounded-full w-32 h-32 bg-green-300">
                            <img src="{{ asset($user->image_url) }}" alt="imagen de perfil"
                                class="w-full h-full object-cover rounded-full">
                        </div>

                        <div class="flex-col justify-center text-gray-900">
                            <div>
                                <p>Nombre:
                                    <span class="italic">
                                        {{ $user->name }}

                                    </span>
                                </p>
                            </div>
                            <div>
                                <p>Email:
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-col justify-center space-y-2">
                            <div class="text-center w-full rounded-xl select-gradient py-2 text-baseText">
                                {{ $follows }}
                                <span class="italic font-light">
                                    jugadores seguidos
                                </span>
                            </div>
                            <div class="text-center w-full rounded-xl select-gradient py-2 text-baseText px-4">
                                {{ $ratings_count }}
                                <span class="italic font-light">
                                    valoraciones realizadas
                                </span>
                            </div>
                        </div>
                    </div>
                    <button onclick="Livewire.emit('openModal', 'edit-profile-modal')" class="hover:scale-[1.02] duration-200 ease-in-out border-2 border-white bg-base3 text-base2 text-sm px-4 py-2 rounded-xl">Editar perfil</button>
                </div>
                <div class="mt-4">
                    <livewire:followed-players />
                </div>
            </div>
            <div class="mt-6 space-y-2">

                <h2 class="ml-4 italic text-xl">Mis Valoraciones</h2>

                <div class="relative mx-auto z-20">
                    <button type="button" id="prev-button" class="absolute top-14 w-16 -left-12 cursor-pointer">
                        <x-icons.arrow class="rotate-180 w-full h-fit text-base2" />
                    </button>
                    <button type="button" id="next-button" class="absolute top-14 w-16 -right-12">
                        <x-icons.arrow class="w-full h-fit text-base2" />
                    </button>

                    <div class="ratingSlider select-none">
                        @foreach ($ratings as $rating)
                            <div class="h-32">
                                <x-rating-card :rating="$rating" class="h-full"/>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
