<div class="bg-gradient-to-b from-base2 to-base1 shadow-xl pt-4">
    <div class="max-w-5xl mx-auto flex justify-between items-center">

        <a href="/" class="pb-4 text-baseText hover:text-white duration-200 ease-in-out">
            <x-application-logo />
        </a>
        
        <div>
            <a href="{{ route('league') }}"
                class="{{ request()->route()->getName() == 'league'? 'bg-baseText text-base1': 'bg-gradient-to-b' }} text-baseText text-lg duration-1000  to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 ease-in-out px-4 pt-4 pb-5 rounded-t-lg shadow-xl">Ligas</a>
        </div>
        @auth

            <div>
                <a href="{{ route('players') }}"
                    class="{{ request()->route()->getName() == 'players'? 'bg-baseText text-base1': 'bg-gradient-to-b' }} text-baseText text-lg duration-1000  to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 ease-in-out px-4 pt-4 pb-5 rounded-t-lg shadow-xl">Buscar jugadores</a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 pb-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="bg-black px-3 py-2 rounded-md hover:scale-105 duration-200 ease-in-out text-white text-md">Iniciar
                sesión</a>
        @endauth
    </div>
</div>
