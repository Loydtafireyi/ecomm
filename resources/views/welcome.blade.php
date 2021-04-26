<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <main>
                <div id="app">
                   
                    <div class="px-4 py-5 mx-auto border-b sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center">
                            <router-link to="/" aria-label="Company" title="Company" class="inline-flex items-center mr-8">
                                <svg class="w-8 text-purple-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                                <rect x="3" y="1" width="7" height="12"></rect>
                                <rect x="3" y="17" width="7" height="6"></rect>
                                <rect x="14" y="1" width="7" height="6"></rect>
                                <rect x="14" y="11" width="7" height="12"></rect>
                                </svg>
                                <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Ecommerce</span>
                            </router-link>
                            <ul v-if="loggedIn" class="flex items-center hidden space-x-8 lg:flex">
                                <li><router-link to="/" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Products</router-link></li>
                                <li><router-link to="/wallet" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Wallet</router-link>
                                </li>
                                <li><router-link to="/orders" aria-label="Product pricing" title="Product pricing" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Transction History</router-link>
                                </li>
                            </ul>
                            </div>

                                <!-- Logout -->
                                <div  v-if="loggedIn" class="hidden sm:flex sm:items-center sm:ml-6">
                                    <router-link to="/logout"  class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Logout</router-link>
                                </div>
                            
                                <ul  v-if="!loggedIn" class="flex items-center hidden space-x-8 lg:flex">
                                    <li><router-link to="/login" aria-label="Sign in" title="Sign in" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Sign in</router-link></li>
                                    <li>
                                        <router-link
                                        to="/register"
                                        class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 bg-purple-400 rounded shadow-md hover:bg-purple-700 focus:shadow-outline focus:outline-none"
                                        aria-label="Sign up"
                                        title="Sign up"
                                        >
                                        Sign up
                                        </router-link>
                                    </li>
                                </ul>

                            
                            <!-- Mobile menu -->
                            <div class="lg:hidden">
                            <button aria-label="Open Menu" title="Open Menu" class="p-2 -mr-1 transition duration-200 rounded focus:outline-none focus:shadow-outline hover:bg-deep-purple-50 focus:bg-deep-purple-50">
                                <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M23,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,13,23,13z"></path>
                                <path fill="currentColor" d="M23,6H1C0.4,6,0,5.6,0,5s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,6,23,6z"></path>
                                <path fill="currentColor" d="M23,20H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,20,23,20z"></path>
                                </svg>
                            </button>
                            <!-- Mobile menu dropdown 
                            <div class="absolute top-0 left-0 w-full">
                                <div class="p-5 bg-white border rounded shadow-sm">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                    <a to="/" aria-label="Company" title="Company" class="inline-flex items-center">
                                        <svg class="w-8 text-purple-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                                        <rect x="3" y="1" width="7" height="12"></rect>
                                        <rect x="3" y="17" width="7" height="6"></rect>
                                        <rect x="14" y="1" width="7" height="6"></rect>
                                        <rect x="14" y="11" width="7" height="12"></rect>
                                        </svg>
                                        <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Company</span>
                                    </a>
                                    </div>
                                    <div>
                                    <button aria-label="Close Menu" title="Close Menu" class="p-2 -mt-2 -mr-2 transition duration-200 rounded hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                        <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
                                        <path
                                            fill="currentColor"
                                            d="M19.7,4.3c-0.4-0.4-1-0.4-1.4,0L12,10.6L5.7,4.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l6.3,6.3l-6.3,6.3 c-0.4,0.4-0.4,1,0,1.4C4.5,19.9,4.7,20,5,20s0.5-0.1,0.7-0.3l6.3-6.3l6.3,6.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3 c0.4-0.4,0.4-1,0-1.4L13.4,12l6.3-6.3C20.1,5.3,20.1,4.7,19.7,4.3z"
                                        ></path>
                                        </svg>
                                    </button>
                                    </div>
                                </div>
                                <nav>
                                    <ul class="space-y-4">
                                    <li><a to="/" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Product</a></li>
                                    <li><a to="/" aria-label="Our product" title="Our product" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Features</a></li>
                                    <li><a to="/" aria-label="Product pricing" title="Product pricing" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Pricing</a></li>
                                    <li><a to="/" aria-label="About us" title="About us" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">About us</a></li>
                                    <li><a to="/" aria-label="Sign in" title="Sign in" class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-purple-400">Sign in</a></li>
                                    <li>
                                        <a
                                        to="/"
                                        class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 bg-purple-400 rounded shadow-md hover:bg-purple-700 focus:shadow-outline focus:outline-none"
                                        aria-label="Sign up"
                                        title="Sign up"
                                        >
                                        Sign up
                                        </a>
                                    </li>
                                    </ul>
                                </nav>
                                </div>
                            </div>
                            -->
                            </div>
                        </div>
                    </div>

                    <router-view></router-view>
                </div>
            </main>
        </div>
    </body>
</html>
