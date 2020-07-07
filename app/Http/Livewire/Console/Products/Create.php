<?php

namespace App\Http\Livewire\Console\Products;

use Livewire\Component;
use App\Product;
use App\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $tittle;
    public $image;
    public $category_id;
    public $content;
    public $unit;
    public $unit_weight;
    public $weight;
    public $price;
    public $discount;
    public $keywords;
    public $description;

    public function store()
    {
        $this->validate([
            'tittle' => 'required|min:3',
            'image' => 'required|image|max:1024',
            'category_id' => 'required',
            'content' => 'required',
            'unit' => 'required',
            'unit_weight' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'keywords' => 'required',
            'weight' => 'required',
            'description' => 'required'
        ]);

        $this->image->store('public/products');

        $product = Product::create([
            'tittle' => $this->tittle,
            'image' => $this->image->hashName(),
            'slug' => Str::slug($this->tittle, '-'),
            'category_id' => $this->category_id,
            'content' => $this->content,
            'unit' => $this->unit,
            'unit_weight' => $this->unit_weight,
            'weight' => $this->weight,
            'price' => $this->price,
            'discount' => $this->discount,
            'keywords' => $this->keywords,
            'description' => $this->description
        ]);
        session()->flash('success','Data Product Berhasil ditambahkan');
        return redirect()->route('console.products.index');
    }
    public function render()
    {
        return view('livewire.console.products.create', ['categories' => Category::latest()->get(),]);
    }
}
