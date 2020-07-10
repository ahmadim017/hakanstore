<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Facades\Cart;

class Header extends Component
{
    public $cartTotal = 0;
    public $cartTotalPrice = 0;

    protected $listeners = [
        'addTocart' => 'updateCart',
        'removeCart' => 'updateCart'
    ];

    public function updateCart()
    {
        $this->cartTotal = count(Cart::get()['products']);

        $totalPrice = 0;
        foreach(Cart::get()['products'] as $value)
        {
            $harga_set = $value->price * $value->discount /100;
            $harga_diskon = $value->price - $value->harga_set;

            $totalPrice += $harga_diskon;
        }

        $this->cartTotalPrice = $totalPrice;

        if ($this->cartTotal == 0) {
            return redirect()->route('root');
        }
    }

    public function mount()
    {
        $this->cartTotal = count(Cart::get()['products']);

        $totalPrice = 0;

        foreach(Cart::get()['products'] as $value)
        {
            $harga_set = $value->price * $value->discount /100;
            $harga_diskon = $value->price - $value->harga_set;

            $totalPrice += $harga_diskon;
        }

        $this->cartTotalPrice = $totalPrice;

    }
    public function render()
    {
        return view('livewire.frontend.cart.header');
    }
}
