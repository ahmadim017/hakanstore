<?php

namespace App\Http\Livewire\Console\Categories;

use Livewire\Component;
use App\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{

    use WithFileUploads;

    public $name;
    public $image;
    public $categoryId;

    public function mount($id)
    {
        $category = Category::find($id);

        if ($category) {
            $this->categoryId = $category->id;
            $this->name = $category->name;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $category = Category::find($this->categoryId);

        if ($category) {
            if ($this->image == null) {

                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name, '-'),
                ]);

            } else {
                Storage::disk('public')->delete('categories/'. $category->image);
                $this->image->store('public/categories');

                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name, '-'),
                    'image' => $this->image->hashName()
                ]);
            }
            session()->flash('success','Data berhasil diupdate');
            return redirect()->route('console.categories.index');
        }
    }
    public function render()
    {
        return view('livewire.console.categories.edit');
    }
}
