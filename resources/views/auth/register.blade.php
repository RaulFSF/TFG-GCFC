<x-simple>
    <div class="relative w-full h-screen">
        <div class="absolute left-0 bottom-0 saturate-0 bg-cover inset-0 bg-no-repeat w-full h-screen"
            style="background-image: url('{{ asset('storage/inicio.png') }}')"></div>
        <div class="card-gradient bg-cover absolute inset-0 w-full h-screen opacity-40"></div>

        <div class="relative w-fit mx-auto pt-20">
            <div class="max-w-sm p-6 z-10 bg-opacity-80 shadow-xl bg-baseText rounded-xl">

                <h2 class="text-center text-2xl text-gray-900 mb-2">Registrarse como jugador</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ml-4">
                            {{ __('Enviar correo') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-simple>
