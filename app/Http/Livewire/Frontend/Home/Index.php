<?php

namespace App\Http\Livewire\Frontend\Home;

use Livewire\Component;
use App\Slider;
use App\Product;
use App\Facades\Cart;


class Index extends Component
{

    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage = $this->perPage + 6;
    }

    public function addToCart(int $prodcutId)
    {
        Cart::add(Product::where('id', $prodcutId)->first());
        $this->emit('addToCart');

        $this->emit('alert', ['type' => 'success','message' => 'Product Add to Cart.']);
    }
    public function render()
    {
        $products = Product::latest()->paginate($this->perPage);

        return view('livewire.frontend.home.index',['sliders' => Slider::latest()->get(), 'products' => $products]);
    }
}
