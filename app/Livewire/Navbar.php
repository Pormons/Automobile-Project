<?php

namespace App\Livewire;

use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $cartCount;

    public function mount(CartService $cartService)
    {
        $this->cartCount = $cartService->getCartCount();
    }

    public function render()
    {

        return view('livewire.navbar');
    }

    #[On('update-cart')]
    public function cart(CartService $cartService)
    {
        $this->cartCount = $cartService->getCartCount();
    }

    public function signout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->intended('/');
    }
}
