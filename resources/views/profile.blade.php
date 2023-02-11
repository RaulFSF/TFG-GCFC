<x-guest-layout>
    <div class="max-w-5xl mx-auto bg-baseText rounded-xl shadow-xl w-full mt-10">
        <div class="mx-10">
            <div class="flex justify-between">
                <div class="flex flex-col justify-center items-center card-gradient rounded-b-xl px-6">
                    <div class="flex flex-col justify-center items-center p-4 bg-opacity-25 bg-base3 rounded-xl space-y-4">

                        <div class="rounded-full w-32 bg-green-300">
                            <img src="{{ asset($user->image_url) }}" alt="imagen de perfil"
                                class="w-full h-full rounded-full">
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

                </div>
                <div>
                    <livewire:followed-players />
                </div>
            </div>
            <div>
                <h2>Valoraciones</h2>
                
                <div>
                    <x-rating-card :rating="$ratings->first()"/>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
