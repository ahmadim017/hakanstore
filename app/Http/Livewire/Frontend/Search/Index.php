<?php

namespace App\Http\Livewire\Frontend\Search;

use Livewire\Component;
use App\Product;
use App\Facades\Cart;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 12;

    public function mount(Request $request)
    {
        $this->search = $request->get('q');
        if ($this->search == "") {
            return redirect()->route('root');
        } 
    }

    public function addToCart($productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->emit('addToCart');
        $this->emit('alert',['type' => 'success','message' => 'Product Add To Cart']);
    }
    public function loadMore()
    {
        $this->perPage = $this->perPage +4;
    }
    public function render()
    {
        $products = Product::where('tittle','LIKE','%'. $this->search .'%')->latest()->paginate($this->perPage);
        return view('livewire.frontend.search.index',['products' => $products]);
    }
}
