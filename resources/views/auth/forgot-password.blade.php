<x-simple>
    <div class="relative w-full h-screen">
        <div class="absolute left-0 bottom-0 saturate-0 bg-cover inset-0 bg-no-repeat w-full h-screen"
            style="background-image: url('{{ asset('storage/inicio.png') }}')"></div>
        <div class="card-gradient bg-cover absolute inset-0 w-full h-screen opacity-40"></div>

        <div class="relative w-fit mx-auto pt-20">
            <div class="max-w-sm p-6 z-10 bg-opacity-80 shadow-xl bg-baseText rounded-xl">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-simple>
