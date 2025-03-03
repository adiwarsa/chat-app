<div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400 mr-2"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                    </path>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Live Chat : {{ auth()->user()->name }}
                </h2>
            </div>
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <span class="flex h-3 w-3 relative mr-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span>{{ count($messages) }} messages</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-[500px]">
        <div id="chat-box" class="flex-1 p-4 overflow-y-auto space-y-4">
            @foreach ($messages as $msg)
                <div class="flex items-end {{ $msg['username'] === $username ? 'justify-end' : '' }}">
                    @if ($msg['username'] !== $username)
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                            <span
                                class="text-sm font-medium text-indigo-800 dark:text-indigo-200">{{ substr($msg['username'], 0, 2) }}</span>
                        </div>
                    @endif

                    <div
                        class="flex flex-col space-y-2 text-sm max-w-xs mx-2 {{ $msg['username'] === $username ? 'order-1 items-end' : 'order-2 items-start' }}">
                        <div
                            class="{{ $msg['username'] === $username ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white' }} px-4 py-2 rounded-lg">
                            <span>{{ $msg['message'] }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $msg['username'] }}</span>
                            <span
                                class="text-xs text-gray-500 dark:text-gray-400">{{ isset($msg['time']) ? $msg['time'] : now()->format('g:i A') }}</span>
                        </div>
                    </div>

                    @if ($msg['username'] === $username)
                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center">
                            <span class="text-sm font-medium text-white">{{ substr($msg['username'], 0, 2) }}</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-900">
            <div class="mb-3">
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Your
                    Name</label>
                <input id="username" type="text" wire:model="username" placeholder="Enter your name" disabled
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" />
            </div>
            <div class="flex items-center">
                <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                    placeholder="Type a message..."
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" />
                <button wire:click="sendMessage" wire:loading.attr="disabled"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200 disabled:opacity-75">
                    <span wire:loading.remove>Send</span>
                    <span wire:loading>
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatBox = document.getElementById('chat-box');
        const usernameInput = document.getElementById('username');

        function scrollToBottom() {
            if (chatBox) {
                setTimeout(() => {
                    chatBox.scrollTop = chatBox.scrollHeight;
                }, 100); 
            }
        }

        const pusher = new Pusher('mykey', {
            wsHost: '127.0.0.1',
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
            cluster: 'mt1',
        });

        const channel = pusher.subscribe('chat');
        
        channel.bind_global(function(eventName, data) {
            console.log("Event Received:", eventName, data);

            if (eventName === "App\\Events\\MessageSent") {
                Livewire.dispatch('message-received')
            }
        });

        Livewire.on('scrollToBottom', () => {
            scrollToBottom();
        });
    });
</script>
