<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Chat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <style>
            [x-cloak] { display: none !important; }
        </style>
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">Laravel Chat</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/home') }}" class="font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition duration-150 ease-in-out">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition duration-150 ease-in-out">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-150 ease-in-out">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                            Real-time Chat Application
                        </h1>
                        <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-300">
                            Connect with others instantly using our modern chat platform
                        </p>
                    </div>

                    <!-- Chat Component -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <livewire:chat />
                    </div>

                    <!-- Features Section -->
                    <div class="mt-16">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                            <path d="m2 12 5.25 5 2.625-5L12 17l3.375-3 2.625 3L22 12"></path>
                                        </svg>
                                        <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Real-time Messaging</h3>
                                    </div>
                                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                                        Messages are delivered instantly using WebSockets technology, ensuring a seamless chat experience.
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                            <line x1="8" y1="21" x2="16" y2="21"></line>
                                            <line x1="12" y1="17" x2="12" y2="21"></line>
                                        </svg>
                                        <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">Responsive Design</h3>
                                    </div>
                                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                                        Chat from any device with our fully responsive interface that works on desktop, tablet, and mobile.
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-white">User Friendly</h3>
                                    </div>
                                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                                        Simple and intuitive interface makes it easy to start chatting right away without any learning curve.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            &copy; {{ date('Y') }} Laravel Chat. All rights reserved.
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @livewireScripts
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    </body>
</html>
