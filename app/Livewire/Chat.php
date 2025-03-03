<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public $messages;
    public $message = '';
    public $username = '';

    protected $rules = [
        'username' => 'required',
        'message' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->username = auth()->user()->name;
        $this->messages = Message::latest()->take(10)->get()->reverse()->values()->toArray();
    }

    public function sendMessage()
    {
        $this->validate();

        $message = Message::create([
            'username' => $this->username,
            'message' => $this->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->messages[] = $message->toArray();
        $this->message = '';
    }

    #[On('message-received')]
    public function messageReceived()
    {
        $this->messages = Message::latest()->take(10)->get()->reverse()->values()->toArray();
        $this->dispatch('scrollToBottom');
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
