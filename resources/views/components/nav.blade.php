<div x-data="{ openMenu: false }" :class="openMenu ? 'overflow-hidden' : 'overflow-visible'"
    class="bg-gradient-to-b from-base2 to-base1 shadow-xl pt-4 px-4 ">
    <div class="max-w-5xl mx-auto flex justify-between items-center">

        <a href="/" class="pb-4 text-baseText hover:text-white duration-200 ease-in-out">
            <x-application-logo />
        </a>

        <div class="hidden md:block">
            <a href="{{ route('league') }}"
                class="{{ request()->route()->getName() == 'league'? 'bg-baseText text-base1': 'bg-gradient-to-b' }} text-baseText text-lg duration-1000  to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 ease-in-out px-4 pt-4 pb-5 rounded-t-lg shadow-xl">Ligas</a>
        </div>
        @auth

            @if (Auth::user()->role != 'player')
                <div class="hidden md:block">
                    <a href="{{ route('players') }}"
                        class="{{ request()->route()->getName() == 'players'? 'bg-baseText text-base1': 'bg-gradient-to-b' }} text-baseText text-lg duration-1000  to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 ease-in-out px-4 pt-4 pb-5 rounded-t-lg shadow-xl">Jugadores</a>
                </div>
            @endif

            <div class="hidden md:flex sm:items-center sm:ml-6 pb-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex space-x-2 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                <img src="{{ asset(Auth::user()->image_url) }}" alt=""
                                    class="rounded-full w-8 h-8 object-cover">
                            </div>
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

                        @if (Auth::user()->role === 'player')
                            <x-dropdown-link :href="route('player.profile.view', ['id' => auth()->user()->player->id])">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @else
                            <x-dropdown-link :href="route('own.profile.view')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Editar contraseña') }}
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
            <div class="hidden md:block">
                <a href="{{ route('login') }}"
                    class="active:scale-100 bg-gradient-to-b text-baseText text-lg duration-1000 to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 px-3 py-2 rounded-md hover:scale-105 ease-in-out">Iniciar
                    sesión</a>
            </div>
        @endauth
        <button class="flex md:hidden flex-col items-center align-middle text-baseText"
            x-on:click="openMenu = !openMenu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav class="sm:hidden fixed top-0 right-0 bottom-0 left-0 backdrop-blur-sm z-10"
        :class="openMenu ? 'visible' : 'invisible'" x-cloak>

        <ul class="absolute top-0 right-0 bottom-0 w-10/12 py-4 bg-white drop-shadow-2xl z-10 transition-all"
            :class="openMenu ? 'translate-x-0' : 'translate-x-full'">

            @auth
                <li class="border-b border-inherit pb-4">
                    <div class="flex justify-center items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex space-x-2 items-center px-3 py-2 border bg-gradient-to-b text-white border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        <img src="{{ asset(Auth::user()->image_url) }}" alt=""
                                            class="rounded-full w-8 h-8 object-cover">
                                    </div>
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                @if (Auth::user()->role === 'player')
                                    <x-dropdown-link :href="route('player.profile.view', ['id' => auth()->user()->player->id])">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link :href="route('own.profile.view')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                @endif

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Editar contraseña') }}
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

                </li>
            @else
                <li class="border-b border-inherit pb-4">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('login') }}"
                            class="bg-gradient-to-b text-baseText text-lg px-3 py-2 rounded-md hover:scale-105">Iniciar
                            sesión</a>
                    </div>
                </li>

            @endauth

            <li class="border-b border-inherit">
                <a href="{{ route('league') }}" class="block p-4">Ligas</a>
            </li>

            @auth
                @if (Auth::user()->role != 'player')
                    <li class="border-b border-inherit">
                        <a href="{{ route('players') }}" class="block p-4">Jugadores</a>
                    </li>
                @endif
            @endauth
        </ul>

        <button class="absolute top-0 right-0 bottom-0 left-0" x-on:click="openMenu = !openMenu"></button>

    </nav>
</div>
