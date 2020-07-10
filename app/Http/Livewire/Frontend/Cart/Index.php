<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Facades\Cart;

class Index extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = Cart::get();

        if (count(Cart::get()['products']) == 0) {
            return redirect()->route('root');
        }
    }

    public function removeCart($productId)
    {
        Cart::remove($productId);
        $this->cart = Cart::get();
        $this->emit('removeCart');

        $this->emit('alert', ['type' => 'success','message' =>'Prodcut remove form Cart']);
    }
    public function render()
    {
        return view('livewire.frontend.cart.index');
    }
}
