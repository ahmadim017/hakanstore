<?php

namespace App\Http\Livewire\Console\Products;

use Livewire\Component;
use App\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{

    use WithPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function destroy($id)
    {
        $product = Product::findOrfail($id);

        if ($product) {
            Storage::disk('public')->delete('products/'. $product->image);
            $product->delete();
        } 
        session()->flash('error','Data Product Berhasil dihapus');
        return redirect()->back();
    }

    public function render()
    {
        if ($this->search != "") {
            $product = Product::where('tittle','LIKE','%' . $this->search . '%')->latest()->paginate(10);
        } else {
            $product = Product::latest()->paginate(10);
        }
        return view('livewire.console.products.index',['product' => $product]);
    }
}
