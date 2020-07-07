<?php

namespace App\Http\Livewire\Console\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
Use App\Product;

class Edit extends Component
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

    public $productId;

    public function mount($id)
    {
        $product = Product::findOrfail($id);
        if ($product) {
            $this->productId    = $product->id;
            $this->tittle        = $product->tittle;
            $this->category_id  = $product->category_id;
            $this->content      = $product->content;
            $this->unit         = $product->unit;
            $this->unit_weight  = $product->unit_weight;
            $this->weight       = $product->weight;
            $this->price        = $product->price;
            $this->discount     = $product->discount;
            $this->keywords     = $product->keywords;
            $this->description  = $product->description;
        }
    }

    public function update()
    {
        $this->validate([
            'tittle' => 'required|min:3',
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

        $product = Product::findOrfail($this->productId);

        if ($product) {
            if ($this->image == NULL) {
                $product->update([
                    'tittle' => $this->tittle,
                    'slug' => Str::slug($this->tittle, '-'),
                    'category_id' => $this->category_id,
                    'content' => $this->content,
                    'weight' => $this->weight,
                    'unit' => $this->unit,
                    'unit_weight' => $this->unit_weight,
                    'price' => $this->price,
                    'discount' => $this->discount,
                    'keywords' => $this->keywords,
                    'description' => $this->description
                ]);

            } else {

              Storage::disk('public')->delete('products/'. $product->image);
              $this->image->store('public/products');
              
              $product->update([
                'tittle' => $this->tittle,
                'image' => $this->image->hashName(),
                'slug' => Str::slug($this->tittle, '-'),
                'category_id' => $this->category_id,
                'content' => $this->content,
                'weight' => $this->weight,
                'unit' => $this->unit,
                'unit_weight' => $this->unit_weight,
                'price' => $this->price,
                'discount' => $this->discount,
                'keywords' => $this->keywords,
                'description' => $this->description
              ]);
            }
            session()->flash('success','Data Product Berhasil diupdate');
            return redirect()->route('console.products.index');
        }
    }
    public function render()
    {
        return view('livewire.console.products.edit',['categories' => Category::latest()->get(),]);
    }
}
