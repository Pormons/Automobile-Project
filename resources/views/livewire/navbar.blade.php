<nav class=" bg-zinc-700 sticky top-0 z-50 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto py-4 px-0">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-white text-2xl font-semibold whitespace-nowrap dark:text-white">Quantum</span>
        </a>

        <button data-collapse-toggle="navbar-dropdown" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul
                class="flex flex-col items-center font-medium p-4 md:p-0 mt-4 borderrounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 text-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @auth
                    @role('Customer')
                        <li>
                            <a href="{{ route('home') }}"
                            class="block py-2 px-3 text-white hover:bg-zinc-500 rounded d:p-0 dark:text-white  dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transaction') }}"
                            class="block py-2 px-3 text-white hover:bg-zinc-500 rounded d:p-0 dark:text-white  dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                Transactions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}"
                            class="flex flex-row space-x-4 items-center py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:border-0 md:p-0 dark:text-white hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                                <span class="bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center absolute -top-2 -right-2">
                                    {{ $cartCount }}
                                </span>
                            </a>
                        </li>
                        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                                data-dropdown-placement="bottom">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                    <path fill-rule="evenodd"
                                        d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</span>
                                    <span
                                        class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="#" wire:click="signout"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                            out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endrole
                @endauth

                @guest
                    <li>
                        <a href="{{ route('home') }}"
                            class="block py-2 px-3 text-white hover:bg-zinc-500 rounded d:p-0 dark:text-white  dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart') }}"
                        class="flex flex-row space-x-4 items-center py-2 px-3 text-white rounded hover:bg-white-100 md:hover:bg-transparent md:border-0 md:p-0 dark:text-white hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                            <span class="bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center absolute -top-2 -right-2">
                                {{ $cartCount }}
                            </span>
                        </a>
                    </li>
                    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <a href="/Login" type="button"
                            class="text-white bg-zinc-900 hover:bg-zinc-800 focus:ring-4 focus:outline-none font-semibold text-lg rounded-lg px-4 py-2 text-center">
                            Login
                            </button>
                        </a>
                    </div>
                @endguest


            </ul>
        </div>
    </div>
</nav>
