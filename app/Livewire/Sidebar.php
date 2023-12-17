<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.sidebar');
    }

    public function signOut()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->intended('/');
    }
}
