<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Facades\Cart;
use Livewire\Component;

class Header extends Component
{

    /**
     * public variable
     */
    public $cartTotal = 0;
    public $cartTotalPrice = 0;

    /**
     * listeners
     */
    protected $listeners = [
        'addToCart' => 'updateCart',
        'removeCart'=> 'updateCart'
    ];

    /**
     * update cart
     */
    public function updateCart()
    {
        $this->cartTotal = count(Cart::get()['products']);

        $totalPrice = 0;
        foreach(Cart::get()['products'] as $value)
        {
            $harga_set = $value->price * $value->discount / 100;
            $harga_diskon = $value->price - $harga_set;

            $totalPrice += $harga_diskon;

        }
        
        $this->cartTotalPrice = $totalPrice;

        //if cart empty
        if($this->cartTotal == 0) {
            return redirect()->route('root');
        }
    }

    /**
     * mount or construct function
     */
    public function mount()
    {
        $this->cartTotal = count(Cart::get()['products']);
        
        $totalPrice = 0;
        foreach(Cart::get()['products'] as $value)
        {
            $harga_set = $value->price * $value->discount / 100;
            $harga_diskon = $value->price - $harga_set;

            $totalPrice += $harga_diskon;

        }
        
        $this->cartTotalPrice = $totalPrice;

    }

    public function render()
    {
        return view('livewire.frontend.cart.header');
    }
}
