<?php

namespace App\Http\Livewire\Frontend\Home;

use Livewire\Component;
use App\Product;
use App\Facades\Cart;
use Livewire\WithPagination;
use App\Category;
use Illuminate\Http\Request;

class Show extends Component
{
    use WithPagination;

    public $product;
    public $perPage = 12;
    public $categorys;
    public $slug;

    public function loadmore()
    {
        $this->perPage = $this->perPage + 4;
    }

    public function mount($id)
    {
        $this->product = Product::findOrfail($id);
        $product = Product::findOrfail($id);
        $this->categorys = $product->category_id;
    }

    public function addToCart(int $prodcutId)
    {
        Cart::add(Product::where('id', $prodcutId)->first());
        $this->emit('addToCart');

        $this->emit('alert', ['type' => 'success','message' => 'Product Add to Cart.']);
    }

    public function render()
    {
        $category = Category::where('id', $this->categorys)->first();
        $this->slug = $category->slug;
        $products  = Product::where('category_id', $this->categorys)->latest()->take(6)->paginate($this->perPage);
        return view('livewire.frontend.home.show',['products' => $products]);
    }
}
