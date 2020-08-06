<?php

namespace App\Http\Livewire\Frontend\Category;

use Livewire\Component;
use App\Category;
use App\Product;
use App\Facades\Cart;
use Illuminate\Http\Request;

class Show extends Component
{

    public $segment;
    public $category_name;
    public $category_image;
    public $perPage = 12;

    public function mount(Request $request)
    {
        $this->segment = $request->segment(2);
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 6;
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->emit('addToCart');
    }
    public function render()
    {
        $category = Category::where('slug', $this->segment)->first();

        if ($category) {
            $this->category_name = $category->name;
            $this->category_image = $category->image;

            $products = Product::where('category_id', $category->id)->latest()->paginate($this->perPage);
        }
        return view('livewire.frontend.category.show',['products' => $products, 'category_image' => $this->category_image,'category_name' => $this->category_name]);
    }
}
